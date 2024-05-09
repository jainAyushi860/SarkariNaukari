<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Mail;
use Mail;
use App\Mail\smtpemail;

class emailController extends Controller
{
     public function sendEmail(){
        $mailData = [
            'title' => 'Mail from jayushi073@gmail.com',
            'body' => 'This is for testing email using smtp.'
        ];
         
        Mail::to('jayushi073@gmail.com')->send(new smtpemail($mailData));
           
        dd("Email is sent successfully.");
     }
}
