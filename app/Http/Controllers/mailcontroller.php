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
    public function sendData(Request $res)
    {
		$input =  $data = json_decode(file_get_contents("php://input"), true);

		//return $input['ids'];
		$ids = (($input['ids'] == '') ? [] : $input['ids'] );
		$sendid = (($input['sendid'] == null) ? '' : $input['sendid'] );
		//return $sendid;
	     $alluserusers = DB::table('user_info')->whereIn('Id',$ids)->get();
		 $senddata = DB::table('user_info')->where('user_id',$sendid)->get();
		// return $senddata;
         $fadata['name'] = $senddata[0]->user_fname;
         $fadata['user_email'] = $senddata[0]->user_email;
		 $fadata['Alluser'] =  $alluserusers;
		 $fadata['Subject'] =  'Find Your Matches';
		 $fadata['imageurl'] = 'https://admin.choicemarriage.com/api/storage/';
		//return $fadata;

       Mail::send('mail.sendmatchs',$fadata,function($message) use ($fadata) {
        $message->from('info@choicemarriage.com','choicemarriage');
        $message->to($fadata['user_email'],$fadata['name'])->subject($fadata['Subject']);
       });


        return response()->json(['message' => 'Email sent successfully']);

    }
}
