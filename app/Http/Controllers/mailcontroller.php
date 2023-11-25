<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MyMail;
use Illuminate\Support\Facades\Mail;

class mailcontroller extends Controller
{
    public function sendEmail()
    {


        $to = 'grnpati143@gmail.com';
        $subject = 'message';
        $messageContent = 'hello';

        // You can pass data to the Blade view using the second parameter
        $data = [
            'subject' => $subject,
            'messageContent' => $messageContent,
        ];

        // Use the 'view' method to render the Blade view
        $content = view('name', $data)->render();

        // Send the email with the rendered content
        Mail::raw($content, function ($mail) use ($to, $subject) {
            $mail->to($to)
                ->subject($subject);
        });

        return response()->json(['message' => 'Email sent successfully']);

    }
}
