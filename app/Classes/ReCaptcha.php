<?php

namespace App\Classes;

class ReCaptcha{

    public function getResponse($request){
        $token = $request->input("g-recaptcha-response");
        $pKey = $request->input('configData')["recapchav3_private"];
        if(!empty($token)){
            $Response= file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$pKey."&response=".$token);
            $Return = json_decode($Response);
            if($Return->success > 0.0){
                 return true;
            }
        }
        return false;
    }
}
?>