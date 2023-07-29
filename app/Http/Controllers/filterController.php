<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class filterController extends Controller
{
    public function matches()
    {
        $data = json_decode(file_get_contents("php://input"));
        $user_id = isset($data->user_id) ? $data->user_id : '';
        if ($user_id == '') {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => "Please enter required parametes",
            );
        } else {

            $user_partnerpreference = DB::table('user_partnerpreference')->where('user_ID', $user_id)->get();
            $user_height = $user_partnerpreference[0]->user_height;
           // dd($user_partnerpreference);
            $user = DB::table('user_info')->where('user_ID', $user_id)->get('user_gender');
            //dd($user);
            $gender = $user[0]->user_gender == "male" ? 'female' : 'male' ;
                //dd($gender);
            $alldata = DB::select("SELECT * FROM user_info  
            LEFT JOIN user_religion ON user_info.user_id = user_religion.user_ID 
            LEFT JOIN user_locations ON user_info.user_id = user_locations.user_ID 
            LEFT JOIN user_family ON user_info.user_id = user_family.user_ID 
            LEFT JOIN user_physical_details ON user_info.user_id = user_physical_details.user_ID
            LEFT JOIN user_about ON user_info.user_id = user_about.user_ID
            LEFT JOIN user_diet_hobbies ON user_info.user_id = user_diet_hobbies.user_ID
            LEFT JOIN user_education_occupations ON user_info.user_id = user_education_occupations.user_ID
            WHERE user_info.user_gender = '$gender';");
            if(count($alldata) > 0){
                $user_arr = array(
                    "status" => true,
                    "success" => true,
                    "data" => $alldata,
                    "message"=>count($alldata) . ' records Match'
                );
            }else{
                $user_arr = array(
                    "status" => false,
                    "success" => false,
                    "message" => "No Match Found",
                );
            }

        }
        return json_encode($user_arr);
    }
}