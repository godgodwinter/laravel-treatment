<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Shipu\MuthoFun\Facades\MuthoFun;;
use Twilio\Rest\Client;
use Exception;

class smscontroller extends Controller
{

    public function index()
    {
        $receiverNumber = "+6285736862399";
        $message = "This is testing from Testing.com";

        try {

            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");


            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number,
                'body' => $message]);

            dd('SMS Sent Successfully.');

        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }
}
