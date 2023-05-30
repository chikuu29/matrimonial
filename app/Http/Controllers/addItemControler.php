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

        $facebook_link = $data->fb=='' ? '' : $data->fb; 
        $whatsapp_no = !isset($data->wh) ?'' : $data->wh;
        $twitter_link =  !isset($data->tw) ?'' : $data->tw;
        $youtub_link = !isset($data->yo) ?'' : $data->yo;
        $linkedin_link = !isset($data->li) ?'' : $data->li;

       // dd($facebook_link);
        
       try{

            $social_media_links = DB::table('social_media_links')->where('id',1)->update([
                    'facebook_link' => $facebook_link ,
                    'whatsapp_no' => $whatsapp_no,
                    'twitter_link' => $twitter_link,
                    'linkedin_link' => $linkedin_link,
                    'youtub_link' => $youtub_link,
                    //'updatedon' => date();

            ]);
           
           
            //dd($social_media_links);

            if($social_media_links > 0 ) {
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

       }catch(Exception $e){
            $user_arr = array(
                "status"=> false,
                "success"=> false,
                "message"=> "Exception Error",
            );
      }

        return json_encode($user_arr);
    }

    public function getsocialMediaLink(){

        try{

            $data = DB::table('social_media_links')->get();

            if(count($data) == 1){
                $user_arr = array(
                    "status"=> true,
                    "success"=> true,
                    "message"=> "data  found!",
                    "result" => $data
                );
            }else{
                $user_arr = array(
                    "status"=> false,
                    "success"=> false,
                    "message"=> "data not found!",
                    "result" =>[]
                );
            }



        }catch(Exeption $e){
            $user_arr = array(
                "status"=> false,
                "success"=> false,
                "message"=> "Exception",
                "result" =>[]
            );
        }

        return json_encode($user_arr);
    }

    public function country(){
        $data = json_decode(file_get_contents("php://input"));
        
        $status  = !(isset($data->status)) ? '' : $data->status;

        if($status == 21){
            $country = !(isset($data->country)) ? '' : $data->country;
            $countryinsert = DB::table('country_table')->insert([
                'country_name' => $country,
            ]);
            if($countryinsert > 0){
                $user_arr = array(
                    "status"=> true,
                    "success"=> true,
                    "message"=> "Data Inserted Successfully !",
                );
            }else{
                $user_arr = array(
                    "status"=> false,
                    "success"=> false,
                    "message"=> "Data not Inserted !",
                );
            }
        }
        if($status == 211){
            $countryalldata = DB::table('country_table')->get();
            if(count($countryalldata) > 0){
                $user_arr = array(
                    "status"=> true,
                    "success"=> true,
                    "message"=>$countryalldata ,
                );
            }else{
                $user_arr = array(
                    "status"=> false,
                    "success"=> false,
                    "message"=> [],
                );
            }
        }
        return json_encode($user_arr);
    }
}
