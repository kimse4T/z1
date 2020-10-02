<?php

namespace App\Libraries\SalesForce;

use App\Libraries\Uploads\UploadLib;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\ClientException;

class SalesForceLib
{
    public function login($removeSoapUrl = false)
    {
        $client = new \GuzzleHttp\Client([
            // 'verify' => false // enable this for error curl certificate on window
        ]);
        try {
            $xml = '<?xml version="1.0" encoding="utf-8" ?>
            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:partner.soap.sforce.com">
                <soapenv:Header>
                </soapenv:Header>
                <soapenv:Body>
                    <urn:login>
                        <urn:username>'.config('const.salesforce.username').'</urn:username>
                        <urn:password>'.config('const.salesforce.password').'</urn:password>
                    </urn:login>
                </soapenv:Body>
            </soapenv:Envelope>';
           
            $response = $client->post(config('const.salesforce.auth_url'), [
                'headers' => [
                    'Content-Type' => 'text/xml',
                    'SOAPAction' => 'login'
                ],
                'body' => $xml,
            ]);
            // dd($response);
            $body = $response->getBody();
    
            if ($response->getStatusCode() == '200' && $body) {
                // $body = json_decode($body);
                // return $body;
                // dd($body);
                $xmlObject = simplexml_load_string($body);
                // dd($xml->asXml());
                // $json = json_encode($xml->asXml());
                // dd($json);
                // $array = json_decode($json,TRUE);
                // dd($array);
                $xmlObject->registerXPathNamespace( 'soapenv', 'http://schemas.xmlsoap.org/soap/envelope/' );
                $body = $xmlObject->xpath( '//soapenv:Body' );
                // dd($body);
    
                //Encode the SimpleXMLElement object into a JSON string.
                $jsonString = json_encode($body[0]->loginResponse->result);
    
                //Convert it back into an associative array for
                //the purposes of testing.
                $jsonArray = json_decode($jsonString, true);
                // return $jsonArray;
                $serverUrl = $jsonArray['serverUrl'] ?? false;

                if ($removeSoapUrl) {
                    $serverUrl = $this->removeSoapFromUrl($jsonArray['serverUrl']) ?? false;
                }

                $accessToken = $jsonArray['sessionId']  ?? false;
                
                if ($serverUrl && $accessToken) {
                    return [
                        $serverUrl ?? '',
                        $accessToken  ?? '',
                    ];
                }
            }
        }
        catch (ClientException $e) {
            \Log::error($e);
        } 
        catch (\GuzzleHttp\Exception\RequestException $e) {
            \Log::error($e);
        }
        catch (\Throwable $th) {
            \Log::error($th);
        }
        return false;
    }

    public function removeSoapFromUrl($url)
    {
        return substr($url,0,strpos($url, 'Soap')-1);
    }

    public function getPdf($submitCase)
    {
        // to get pdf must have salesforce_id and case is closed won
        if (empty($submitCase->salesforce_id) || !$submitCase->IsCaseApproved) {
            return false;
        }

        $login = $this->login();

        if ($login && isset($login[0]) && isset($login[1])) {
            // dd($login[1]);
            if(optional($submitCase->valuation)->salesforce_id){
                $url = "{$this->removeSoapFromUrl($login[0])}/apexrest/ValuationReport/{$submitCase->valuation->salesforce_id}";
            }else{
                $url = '';
            }
            
            try {
                $context = stream_context_create([
                    'http' => [
                        'header'  => "Authorization: Bearer ".$login[1],
                        'method'  => 'GET'
                    ]
                ]);

                // $getContent = chunk_split(file_get_contents(
                //     $url, 
                //     false, 
                //     $context
                // ));
                $getContent = file_get_contents(
                    $url, 
                    false, 
                    $context
                );
                // dd($getContent);
                if (!$getContent) {
                    return false;
                }
                
                // $pdfDecode = base64_decode($getContent);
                $pdfDecode = $getContent;

                $setPath = 'uploads/pdf/'.date('Ym');
                $fileName = \Str::uuid().'.pdf';
                // $fileName = '.pdf';
                $fullPath = $setPath. '/' . $fileName;

                $upload = Storage::disk('uploads')->put(
                    $fullPath,
                    $pdfDecode
                );

                if ($upload) {
                    // remove old pdf
                    UploadLib::clearSingleThumbnail(
                        'uploads', 
                        optional($submitCase->valuation)->pdf_link
                    );
                    $submitCase->valuation()->update([
                        'pdf_link' => $fullPath
                    ]);
                
                    return response()->streamDownload(function () use ($pdfDecode) {
                        echo $pdfDecode;
                    }, $fileName)
                    ->send()
                    ;
                    // return $pdfDecode;
                }
                    // return response()->download($fullPath);
                    // dd($uploads);
                    // return response()->download();
                    // return response()->streamDownload(function () use ($url, $context) {
                    //     echo base64_decode(chunk_split(file_get_contents($url, false, $context)));
                    // }, 'test.pdf')
                    // // ->sendContent()
                    // ->send()
                    // ;

                    // return response()->streamDownload(function () use ($url, $context) {
                    //     return  file_get_contents($url, false, $context);
                    // }, 'test.pdf')
                    // // ->sendContent()
                    // ->send()
                    // ;

                    // $path = 'uploads/pdf/'.date('Ym');
                    // $fullFileName = $path.'/asdasd.pdf';
                    // if (!is_dir($path)) mkdir($path, 0777, true);

                    // dd(base64_decode($pdfContent));
                    // $upload = file_put_contents($fullFileName, $pdfContent);
                    // $this->uploadFileFromBlobString($pdfContent, 'test_valuation_report.pdf', './pdf');
                    // $pdfContent = base64_decode($pdfContent);
                    // // dd($pdfContent);
                    // /pdf/'.date('Ym').'/asdasd.pdf
                    // $upload  = Storage::disk('uploads')->putFile('uploads', '');
                
                    
                    // dd($uploads);
                    // if ($upload) {
                    //     return $upload;
                    // }
                // }
            }
            catch (ClientException $e) {
                // dd($e);
                \Log::error($e);
            } 
            catch (\GuzzleHttp\Exception\RequestException $e) {
                // dd($e);
                \Log::error($e);
            }
            catch (\Throwable $th) {
                // dd($th);
                \Log::error($th);
            }
        }

        return false;
    }

    /**
     * @param string $url
     * @param string $token
     * @param boolean $isBase64
     * 
     * @return binary_content
     */
    public function getFileContent($url, $isBase64 = false)
    {
        $fileBinary = false;

        $login = $this->login();

        if ($login && isset($login[0]) && isset($login[1])) {
            $context = stream_context_create([
                'http' => [
                    'header'  => "Authorization: Bearer ".$login[1],
                    'method'  => 'GET'
                ]
            ]);
    
            if ($isBase64) {
                // TO DO LIST
                // $getContent = chunk_split(file_get_contents(
                //     $url, 
                //     false, 
                //     $context
                // ));
                // $pdfDecode = base64_decode($getContent);
            } else {
                $fileBinary = file_get_contents(
                    $url, 
                    false, 
                    $context
                );
            }
        }
        

        return $fileBinary;
    }

    public function getImageJsonResponse($salesforceId)
    {
        $login = $this->login(true);

        if ($login && isset($login[0]) && isset($login[1])) {
            $url = "{$login[0]}/apexrest/z1_attachments/{$salesforceId}";

            $client = new \GuzzleHttp\Client([
                // 'verify' => false // enable this for error curl certificate on window
            ]);
            try {
                $response = $client->get($url, [
                    'headers' => [
                        "Authorization"=> "Bearer ".$login[1],
                        'Accept' => 'application/json'
                    ],
                ]);

                $body = json_decode($response->getBody(), true);

                if ($response->getStatusCode() == '200' && $body) {
                    return $body;
                }
            }
            catch (ClientException $e) {
                // dd($e);
                \Log::error($e);
            } 
            catch (\GuzzleHttp\Exception\RequestException $e) {
                // dd($e);
                \Log::error($e);
            }
            catch (\Throwable $th) {
                // dd($th);
                \Log::error($th);
            }
        }

        return false;
    }

    public function downloadImageJob($record, $json, $data)
    {
        switch ($data['type']) {
            case "single":
                $this->downloadSingleJob($record, $json, $data);
            break;

            case "multiple":
                $this->downloadMultipleJob($record, $json, $data);
            break;
        }
    }

    public function downloadSingleJob($record, $json, $data)
    {
        $getFile = isset($json[0]) ? $json[0] : false;
        
        // store old file to delete when success upload
        $oldFile = $record->{$data['column']};

        if ($getFile) {
            $extension = mb_strtolower($getFile['fileextension']) ?? null;

            $fileName = \Str::uuid().'.'.$extension;
            
            $fullPath = $data['diskPath']. '/' . $fileName;

            $getContent = $this->getFileContent($getFile['versiondata']);

            // if can't get content to uploads to false
            if ($getContent) {
                $upload = $this->uploadFile($extension, $getContent, $fullPath, $data['disk'], $data['thumbnail']);
            } else {
                $upload = false;
            }

            if ($upload) {
                $this->singleUpdate($record, $data, $fullPath, $oldFile);
            }
        } else {
            $this->singleUpdate($record, $data, NULL, $oldFile);
        }
    }

    protected function singleUpdate($record, $data, $value, $oldFile)
    {
        $update = $this->updateRawWithoutTimestamp($record, $data['column'], $value);
        if ($update) {
            if ($oldFile) {
                if (is_array($oldFile)) { // clear multiple when it array else single clear
                    UploadLib::clearMultiThumbnail($oldFile, $data['disk']);
                } else {
                    UploadLib::clearSingleThumbnail($data['disk'], $oldFile);
                }
            }
        }
    }

    public function downloadMultipleJob($record, $json, $data)
    {
        // store old file to delete when success upload
        $oldFile = $record->{$data['column']};

        if (is_array($json) && count($json)) {
            $files = [];

            $startUpload = false;

            foreach($json as $key => $getFile):
                
                // condition to upload by sf_index_start when it should start or skip 
                if ($data['sf_index_select']) {
                    $startUpload = false;
                    if ($key >= $data['sf_index_start']) {
                        $startUpload = true;
                    }
                } else {
                    $startUpload = true;
                }

                if ($startUpload) {
                    $extension = mb_strtolower($getFile['fileextension']) ?? null;

                    $fileName = \Str::uuid().'.'.$extension;
                    
                    $fullPath = $data['diskPath']. '/' . $fileName;
    
                    $getContent = $this->getFileContent($getFile['versiondata']);
    
                    // if can't get content to uploads to false
                    if ($getContent) {
                        $upload = $this->uploadFile($extension, $getContent, $fullPath, $data['disk'], $data['thumbnail']);
                    } else {
                        $upload = false;
                    }
    
                    if ($upload) {
                        $files[] = $fullPath;
                    }
                }
                
            endforeach;
            $this->singleUpdate($record, $data, json_encode($files), $oldFile);
        } else {
            // we delete our file as well when saleforce is empty
            $this->singleUpdate($record, $data, NULL, $oldFile);
        }
    }

    protected function updateRawWithoutTimestamp($record, $column, $value)
    {
        return \DB::table(with(new $record)->getTable())
        ->where('id', $record->id)
        ->update([
            $column => $value,
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }

    protected function uploadFile($extension, $getContent, $fullPath, $disk, $thumbnail)
    {
        // upload original file
        $upload = Storage::disk($disk)->put(
            $fullPath,
            $getContent
        );

        if ($upload) {
            if ($thumbnail) {
                // create thumbnail
                UploadLib::fileAllowToCreateThumbnail($extension, $disk, $fullPath);
            }

            return $upload;
        }

        return false;
    }
}