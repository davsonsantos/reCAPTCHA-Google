<?php

/**
 * reCAPTXHA [ HELPER ]
 * Classe para criar um campo de validação recaptcha
 * @copyright (c) 2018, Davson N. Santos - DAVTECH - SOLUÇÕES INTELIGENTES
 */
class reCAPTCHA {

    private $SiteKey = SITE_KEY;
    private $SecretKey = SECRET_KEY;

    public function formItem() {
        return "<div class='g-recaptcha' data-sitekey='{$this->SiteKey}'></div> <script src='https://www.google.com/recaptcha/api.js'></script>";
    }

    public function getUrl($Param) {
        
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_POST => TRUE,
            CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
            CURLOPT_POSTFIELDS => [
                'secret' => $this->SecretKey,
                'response' => $Param['g-recaptcha-response'],
                'remoteip' => $_SERVER['REMOTE_ADDR']
            ]
        ]);

        $response = json_decode(curl_exec($curl));
        curl_close($curl);
        
        return $response;
    }

}
