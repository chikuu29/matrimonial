<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MyMail;
use Illuminate\Support\Facades\Mail;

class mailcontroller extends Controller
{
    public function sendEmail()
    {
        $fadata['name'] = 'gyana';

       Mail::send('name',$fadata,function($message) use ($fadata) {
        $message->from('choicemarriage.com','choicemarriage');
        $message->to('grnpati143@gmail.com','gyana')->subject($fadata['name']);
       });

        return response()->json(['message' => 'Email sent successfully']);

    }
}
