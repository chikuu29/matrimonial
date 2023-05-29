<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Exception;

class addItemControler extends Controller
{
    public function socialMediaLink(){
        $data = json_decode(file_get_contents("php://input"));

        $facebook_link = !isset($data->facebook_link) ?'' : $data->facebook_link; 
        $whatsapp_no = !isset($data->whatsapp_no) ?'' : $data->whatsapp_no;
        $twitter_link =  !isset($data->twitter_link) ?'' : $data->twitter_link;
        $linkedin_link = !isset($data-> youtub_link) ?'' : $data-> youtub_link;
        $linkedin_link = !isset($data-> linkedin_link) ?'' : $data-> linkedin_link;

        dd($data);

       //try{

            $Data = DB::table('social_media_links')->where('id',2)->update([
                    'facebook_link' => $facebook_link ,
                    'whatsapp_no' => $whatsapp_no,
                    'twitter_link' => $twitter_link,
                    'linkedin_link' => $linkedin_link,
                    'youtub_link' => $linkedin_link

            ]);

            if($Data > 0 ) {
                $user_arr = array(
                    "status"=> true,
                    "success"=> true,
                    "message"=> "Data Inserted Successfully !",
                );
            }else{
                $user_arr = array(
                    "status"=> false,
                    "success"=> false,
                    "message"=> "Data NOT Inserted !",
                );
            }

       // }catch(Exception $e){
            $user_arr = array(
                "status"=> false,
                "success"=> false,
                "message"=> "Exception Error",
            );
      //  }

        return json_encode($user_arr);
    }
}
