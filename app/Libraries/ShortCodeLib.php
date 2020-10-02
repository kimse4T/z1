<?php

namespace App\Libraries;

class ShortCodeLib
{
    public static function pregMatchAll($template, $pregMatchAll = '/\{{(.+?)\}}/')
    {
        preg_match_all($pregMatchAll, $template, $input);
        return $input;
    }
    protected static function replaceShortcode($code, $replace, $template)
    {
        return str_replace('{{'.$code.'}}', $replace, $template);
    }
   
    
    
    
    
  
   
// //  makeSubmitContractSignPdf
//     public static function makeSubmitContractSignPdf($request, $html, $contractId)
//     {
//         // Action to remove or keep <img> tag and OldHtml to next Process
//         $html = self::compileImage($request, $html);
//         //  Action to add new signature image to html & pdf or nothing change
//         $html = self::compileSignature($request, $html);
//         //  Add User Signature to Pdf
//         $html = self::compileInput($request, $html['html'], $html['pdf']);
//         $pdf = null;
//         $explodeUserSign = explode('{{user_signature}}', $html['pdf']);
//         $countEx = count($explodeUserSign) - 1;
//         foreach($explodeUserSign as $k => $v):
//             $pdf .= $v;
//             if ($countEx > $k) $pdf .= self::makeUserSignatureHtml($k, $contractId);
//         endforeach;
//         $html = $html['html'];

//         // Add contact id card to pdf
//         $pdf = $pdf.self::getIdCard($contractId);

//         return compact('pdf', 'html');
//     }
    
    
    // // Backend format template to pdf
    // public static function removeCode($html, $setting = false)
    // {
    //     $replace = config('settings.replace_shortcode');
    //     if ($setting != false) $replace = $setting;
    //     $str = '<span class="underscore-block">'.$replace.'</span>';
    //     $html = self::removeSignature($html);
    //     $html = self::removeUserSignature($html);
    //     return str_replace('{{input}}', $str, $html);
    // }
    
    
    // protected static function reBuild($explode)
    // {
    //     $html = null;
    //     foreach($explode as $k => $v):
    //         $html .= $v;
    //     endforeach;
    //     return $html;
    // }
    

    /**
     * @param string $template
     * @param AnnoucementReceive Model $entry
     * 
     * @return string
     */
    public static function repalceToUserName($template, $entry)
    {
        // User Model must has Accessor UserName
        $userName = optional($entry->user)->UserName;

        return self::replaceShortcode('user_name', $userName, $template);
    }

    /**
     * @param string $template
     * @param AnnoucementReceive Model $entry
     * 
     * @return string
     */
    public static function convertAnncounementMessage($template, $entry)
    {
        $pregMatchAll = self::pregMatchAll($template);
        $newTemplate = $template;
        foreach($pregMatchAll[1] as $k => $code):
            $newTemplate = self::repalceToUserName($newTemplate, $entry);
        endforeach;
        return $newTemplate;
    }
    
}