<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Twilio\Rest\Client;

class otpController extends Controller
{
  // public function smsPage(){
  //   return view('sms');
  // }
    public function sendOTP(Request $request)
    {

$reciever_phone = $request->mobile_number;
$title = 'hello laravel';


try{
        $sid    = getenv("TWILIO_SID");
        $token  = getenv("TWILIO_AUTH_TOKEN");
        $sendernumber  = getenv("TWILIO_PHONE_NUMBER");

        $client = new Client($sid, $token);
    $message = $client->messages->create($reciever_phone,[
              "from" => $sendernumber,
              "body" => $title
            ]);

          dd("message send successfully");
          return $message->sid;
        // return response()->json(['message' => 'OTP sent successfully']);
          }
          catch (Exception $e){
            dd("Error:". $e);
          }
    }  
}




