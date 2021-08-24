<?php


namespace App\Http\Controllers;


use App\Models\Setting;

class EasyPayHelper
{

    function mmdeposit ($amount,$phone,$reference,$reason)
    {
        $setting = Setting::find(1);

        $httpMethod = "POST";
        $data = [
            'username' => $setting->payment_username,
            'password' => $setting->payment_password,
            'action' => "mmdeposit",
            'amount' => $amount,
            'currency' => "UGX",
            'phone' => $phone,
            'reference' => $reference,
            'reason' => $reason
        ];
        return $this->makeHTTPRequest("https://www.easypay.co.ug/api/", $headers=[], $data,  $httpMethod);
    }


    function mmpayout ($amount,$phone)
    {

        $setting = Setting::find(1);

        $httpMethod = "POST";
        $data = [
            'username' => $setting->payment_username,
            'password' => $setting->payment_password,
            'action' => "mmpayout",
            'amount' => $amount,
            'currency' => "UGX",
            'phone' => $phone
        ];
        return $this->makeHTTPRequest("https://www.easypay.co.ug/api/", $headers=[], $data,  $httpMethod);
    }

    function checkbalance ()
    {
        $setting = Setting::find(1);

        $httpMethod = "POST";
        $data = [
            'username' => $setting->payment_username,
            'password' => $setting->payment_password,
            'action' => "checkbalance"
        ];
        return $this->makeHTTPRequest("https://www.easypay.co.ug/api/", $headers=[], $data,  $httpMethod);
    }

    private function makeHTTPRequest ($url = '', $headers = [], $data = [], $httpMethod = "GET")
    {
        $data = json_encode($data);
        $headerToSend = ["Content-Type:application/json"];

        foreach ($headers as $key => $value) {
            $headerToSend[] = "$key:$value";
        }

        $curl = curl_init();


        $curlArray = array(
            CURLOPT_URL => $url,
            CURLE_TOO_MANY_REDIRECTS => true,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_CUSTOMREQUEST => "$httpMethod",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => $headerToSend,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        );

        curl_setopt_array($curl, $curlArray);

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

}
