<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MyMail;
use Illuminate\Support\Facades\Mail;

class mailcontroller extends Controller
{
    public function sendEmail()
    {
        $data = []; // Empty array

      $data =  Mail::send('name', $data, function($message)
        {
            $message->to('grnpati143@gmail.com', 'Jon Doe')->subject('Welcome!');
        });
        dd($data);

        return response()->json(['message' => 'Email sent']);
    }
}
