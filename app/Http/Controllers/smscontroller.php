<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Shipu\MuthoFun\Facades\MuthoFun;;
use Twilio\Rest\Client;
use Exception;

class smscontroller extends Controller
{
    public function index(){

        function sendsms($to,$msg){
            //init SMS gateway, look at android SMS gateway
            $idmesin = getenv("SMSGATE_IDMESIN");
            $pin = getenv("SMSGATE_PIN");

            // create curl resource
            $ch = curl_init();

            // set url
            curl_setopt($ch, CURLOPT_URL, "https://sms.indositus.com/sendsms.php?idmesin=$idmesin&pin=$pin&to=$to&text=$msg");

            //return the transfer as a string
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            // $output contains the output string
            $output = curl_exec($ch);

            // close curl resource to free up system resources
            curl_close($ch);
            return($output);
            }
            $sending=sendsms("085736862399","Selamat datang Lee");
            dd('test');
    }

    // public function index()
    // {
    //     $receiverNumber = "+6285736862399";
    //     $message = "This is testing from Testing.com";

    //     try {

    //         $account_sid = getenv("TWILIO_SID");
    //         $auth_token = getenv("TWILIO_TOKEN");
    //         $twilio_number = getenv("TWILIO_FROM");


    //         $client = new Client($account_sid, $auth_token);
    //         $client->messages->create($receiverNumber, [
    //             'from' => $twilio_number,
    //             'body' => $message]);

    //         dd('SMS Sent Successfully.');

    //     } catch (Exception $e) {
    //         dd("Error: ". $e->getMessage());
    //     }
    // }
}
