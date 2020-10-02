<?php

namespace App\Libraries;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\VerifyCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\ClientException;

class PhoneLib
{
    public static function checkValidPhoneNumber($phone)
    {
        if (!$phone) return false;
        // $isZero = mb_substr($phone, 0, 1) == '0';
        // $isPlus = mb_substr($phone, 0, 4) == '+855';
        // $is855 = mb_substr($phone, 0, 3) == '855';
        // if ($isZero) {
            $preg = preg_replace('/[^0-9a-zA-Z]/', '', $phone);
            return $preg;
        // }
        // else if ($isPlus || $is855) {
        //     $str = str_replace(['855', '+855'], '0', $phone);
        //     $str = preg_replace('/[^0-9a-zA-Z]/', '', $str);
        //     return $str;
        // }
        return false;
    }

    public static function reverseToInternationalNumber($phone)
    {
        $isZero = mb_substr($phone, 0, 1) == '0';
        $is855 = mb_substr($phone, 0, 3) == '855';
        if ($isZero) {
            $phone = substr($phone, 1);
            $phone = '+855'.$phone;
        }
        else if ($is855) {
            $phone = '+'.$phone;
        }
        return $phone;
    }

    public static function setValidateRule($phone)
    {
        preg_match(config('const.phone_lib.intl_tel_input_regex'), $phone, $isValidNumber);
        if ($isValidNumber) {
            return true;
        }
        // $isZero = mb_substr($phone, 0, 1) == '0';
        // $isPlus = mb_substr($phone, 0, 4) == '+855';
        // $is855 = mb_substr($phone, 0, 3) == '855';
        // preg_match('/[a-zA-Z]/', $phone, $isContainWord);
        // if ($isContainWord) return false;
        // if ($isZero) return true;
        // if ($isPlus) return true;
        // if ($is855) return true;
        return false;
    }

    public static function laravelJsonError($validate, $laravelValidator = true, $status = 422)
    {
        return response()->json([
            "message" => "The given data was invalid.",
            "errors" => $laravelValidator ? $validate->errors() : $validate
        ], $status);
    }

    // public static function isValidVerifyCode($phone, $code)
    public static function isInvalidVerifyCode($phone, $code) // rename function to reflict on code login
    {
        $find = VerifyCode::where('phone', $phone)
        ->where('code', $code)
        ->whereNotNull('code')
        ->whereNotNull('phone')
        ->first();

        if (!$find) {
            return self::laravelJsonError([
                'verify_code' => [trans('phone_lib.invalid_verify_code')]
            ], false);
        }

        if ($find->code_expire < Carbon::now()->toDateTimeString()) {
            return PhoneLib::laravelJsonError([
                'verify_code' => [trans('phone_lib.invalid_verify_code_expire')]
            ], false);
        }

        VerifyCode::where('phone', $phone)
        ->update([
            'retry_times' => 0,
            'code' => null,
            'message' => null,
            'code_expire' => null,
            'retry_in' => null
        ]);
        // return true;
        return false;
    }

    /**
     * Check request verify code is the phone need to be waitting
     *
     * @param string $phone: must be validate by checkValidPhoneNumber()
     *
     * @return mix|boolean
     */
    public static function isInWaiting($phone, $disableJson = false)
    {
        $verifyCode = VerifyCode::where('phone', $phone)->whereNotNull('phone')->first();

        if ($verifyCode) {

            $delayWhenRetryTimesOverLimit = PhoneLib::delayWhenRetryTimesOverLimit($verifyCode);
            if ($delayWhenRetryTimesOverLimit) {
                return $delayWhenRetryTimesOverLimit;
            }

            if ($verifyCode->retry_in > Carbon::now()) {
                $array = [
                    'phone' => [trans('phone_lib.request_too_fast_please_wait')],
                    'retry_in' => $verifyCode->retry_in,
                    'retry_in_second' => Carbon::now()->DiffInSeconds($verifyCode->retry_in),
                ];
                if ($disableJson) {
                    return $array;
                } else {
                    return self::laravelJsonError($array, false);
                }
            }
        }

        return false;
    }

    public static function delayWhenRetryTimesOverLimit($verifyCode, $retryInMinute = 60, $disableJson = false)
    {
        $limitRetry = config('const.phone_lib.retry_times') ?? 5;

        // $findVerifyCode = VerifyCode::where('phone', $phone)->whereNotNull('phone')->first();

        if ($verifyCode) {
            $retry_time = $verifyCode->retry_times + 1;
            if ($retry_time >= $limitRetry) {
                Log::error($retry_time);
                // $verifyCode = VerifyCode::updateOrCreate([ // Update or create record by phone
                //     'phone' => $verifyCode->phone
                // ], [
                //     'retry_in' => Carbon::now()->addMinutes($retryInMinute)->toDateTimeString(),
                //     'server_json' => json_encode(request()->server()),
                //     'retry_times' => NULL
                // ]);

                return PhoneLib::AllowSendSms($verifyCode->phone, 5, $retryInMinute, true);
                // $array = [
                //     'phone' => [trans('phone_lib.request_too_fast_please_wait')],
                //     'retry_in' => $verifyCode->retry_in,
                //     'retry_in_second' => Carbon::now()->DiffInSeconds($verifyCode->retry_in),
                // ];
                // if ($disableJson) {
                //     return $array;
                // } else {
                //     return self::laravelJsonError($array, false);
                // }
            }
        }

        return false;
    }

    /**
     * Send any sms message
     *
     * @param string $phone: must be validate by checkValidPhoneNumber()
     * @param string $message
     * @param string $code
     * @param integer $setMinute
     * @param integer $retryInMinute
     *
     * @return VerifyCode Model
     */
    public static function sendAnySms($phone, $message = NULL, $code = NULL, $setMinute = 5, $retryInMinute = 1)
    {
        // check if it need to wait for next request
        $isInWaiting = PhoneLib::isInWaiting($phone);
        if ($isInWaiting) {
            return $isInWaiting;
        }

        return PhoneLib::AllowSendSms($phone, $setMinute, $retryInMinute);

        // if (!$code) { // Set default code
        //     if (env('APP_ENV') === 'production') {
        //         $code = self::myRandom(4);
        //     } else {
        //         $code = 1234;
        //     }

        // }

        // if (!$message) { // Set default message
        //     $message = $code." គឺជាលេខកូដផ្ញើសាររបស់អ្នក \n".$code." is your Verification Code ";
        // }

        // $verifyCode = VerifyCode::updateOrCreate([ // Update or create record by phone
        //     'phone' => $phone
        // ], [
        //     'code' => $code,
        //     'message' => $message,
        //     'code_expire' => Carbon::now()->addMinutes($setMinute)->toDateTimeString(),
        //     'retry_in' => Carbon::now()->addMinutes($retryInMinute)->toDateTimeString(),
        //     'server_json' => json_encode(request()->server()),
        //     'retry_times' => \DB::raw('retry_times + 1')
        // ]);

        // // self::mekongNetProvider($phone, $message);
        // self::sendSmsByProvider($phone, $message, 'plasgate');

        // return $verifyCode;
    }

    public static function AllowSendSms($phone, $setMinute, $retryInMinute, $setRetryTimeToNull=false)
    {

            if (env('APP_ENV') === 'production') {
                $code = self::myRandom(4);
            } else {
                $code = 1234;
            }

            $message = $code." គឺជាលេខកូដផ្ញើសាររបស់អ្នក \n".$code." is your Verification Code ";


        $verifyCode = VerifyCode::updateOrCreate([ // Update or create record by phone
            'phone' => $phone
        ], [
            'code' => $code,
            'message' => $message,
            'code_expire' => Carbon::now()->addMinutes($setMinute)->toDateTimeString(),
            'retry_in' => Carbon::now()->addMinutes($retryInMinute)->toDateTimeString(),
            'server_json' => json_encode(request()->server()),
            'retry_times' => $setRetryTimeToNull == true ? 0 : DB::raw('retry_times + 1')
        ]);

        Log::error([$phone, $setMinute, $retryInMinute, $setRetryTimeToNull, $verifyCode]);

        // self::mekongNetProvider($phone, $message);
        self::sendSmsByProvider($phone, $message, 'plasgate');

        return $verifyCode;
    }

    public static function retryInSecond($phone){
        $verifyCode = VerifyCode::where('phone', $phone)->whereNotNull('phone')->first();
        return Carbon::now()->DiffInSeconds($verifyCode->retry_in);
    }

    private static function myRandom($size = 6)
    {
        $d = '';
        for ($i=0; $i < $size; $i++) { $d .= mt_rand(1,9); }
        return $d;
    }

    public static function sendSmsByProvider($phone, $message, $provider = 'plasgate', $senderName = false)
    {
        // switch($provider) {
        //     case "mekongnet":
        //         return self::mekongNetProvider($phone, $message);
        //     break;

        //     case "plasgate":
        //         return self::plasgateProvider($phone, $message, $senderName);
        //     break;
        // }
        return true;

    }

    // Provider
    public static function mekongNetProvider($phone, $message)
    {
        $client = new \GuzzleHttp\Client([ // Create Http request instance
            'allow_redirects' => false,
            // 'timeout'  => 5.14,
            'timeout'  => 15,
        ]);
        try {
            self::logSms($phone, $message);
            $response = $client->post('https://romlous.flexidatacenter.com/api/request-any/mekongnet', [
                'form_params' => [
                    'phone' => $phone,
                    'message' => $message
                ],
            ]);
            $body = $response->getBody();

            if ($response->getStatusCode() == '200' && $body) {
                // $body = json_decode($body);
                // return $body;
            }
            // return false;
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
    }

    public static function plasgateProvider($phone, $message, $senderName = false)
    {
        $username = config('const.phone_lib.plasgate_username');
        $password = config('const.phone_lib.plasgate_password');
        $from = config('const.phone_lib.plasgate_sender_name');

        if ($senderName) {
            $from = $senderName;
        }

        self::isInvalidProviderInformation(!$username || !$password || !$from);

        $client = new Client([
            // 'base_uri' => 'http://tool.plasgate.com:11040/cgi-bin/',
            'base_uri' => 'https://tool.plasgate.com:11041/cgi-bin/',

            'verify' => public_path('3d81529c-ae30-47a0-a595-def3cb884c3c/plasgate-ca-bundle.crt')
        ]);
        // dd($from);
        try {
            self::logSms($phone, $message, $from);
            // Create request to server using POST method
            // Data is sent via form application/x-www-form-urlencoded
            $response = $client->request('POST', 'sendsms', [
                'form_params' => [
                    'gw-username' => $username,
                    'gw-password' => $password,
                    'gw-from' => $from,
                    // 'gw-username' => 'vtrustkhapi',
                    // 'gw-password' => '!V^12*pA',
                    // 'gw-from' => 'SMS Info',
                    // 'gw-to' => '855888088007',
                    // 'gw-text' => 'Hi reaksmey it test sms'
                    'gw-to' => str_replace('+', '', trim($phone)),
                    'gw-text' => trim($message)
                ]
            ]);

            $body = $response->getBody();

            if ($response->getBody() || $response->getStatusCode() == '202') {
                return true;
            }
            return false;
            // if ($response->getStatusCode() == '200' && $body) {
            //     // $body = json_decode($body);
            //     // return $body;
            // }
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
        // Check the status of the request. Status 202 should also be ok as our server will handle the send later on.
        // echo $response->getStatusCode();

        // dd($response->getStatusCode());
        // echo json_encode($response->getBody());
    }

    protected static function isInvalidProviderInformation($condition)
    {
        if ($condition) {
            throw new \Exception("SMS Provider credential is missing");
        }
    }

    public static function logSms($phone, $message, $provider = '')
    {
        $data = [
            'url' => url()->full(),
            "request" => request()->all(),
            "phone" => $phone,
            "message" => $message,
            "provider" => $provider
        ];
        // dd($data);
        Log::channel('sms')->info($data);

    }
}
