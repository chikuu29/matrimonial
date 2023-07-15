<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class filterController extends Controller
{
    public function matches()
    {
        $data = json_decode(file_get_contents("php://input"));
        $userId = isset($data->userId) ? $data->userId : '';
        if ($userId == '') {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => (object) [],
            );
        } else {

            $user_partnerpreference = DB::table('user_partnerpreference')->where('user_ID', $userId)->get();
            $user_height = $user_partnerpreference[0]->user_height;
           // dd($user_partnerpreference);
            $user = DB::table('user_info')->where('user_ID', $userId)->get('user_gender');
            //dd($user);
            $gender = $user[0]->user_gender == "male" ? 'female' : 'male' ;
              //  dd($gender);
            $alldata = DB::select("SELECT * FROM user_info  
            LEFT JOIN user_religion ON user_info.user_id = user_religion.user_ID 
            LEFT JOIN user_locations ON user_info.user_id = user_locations.user_ID 
            LEFT JOIN user_family ON user_info.user_id = user_family.user_ID 
            LEFT JOIN user_physical_details ON user_info.user_id = user_physical_details.user_ID
            LEFT JOIN user_about ON user_info.user_id = user_about.user_ID
            LEFT JOIN user_diet_hobbies ON user_info.user_id = user_diet_hobbies.user_ID
            LEFT JOIN user_education_occupations ON user_info.user_id = user_education_occupations.user_ID
            WHERE user_info.user_gender = '$gender' AND user_physical_details.user_height = '$user_height' ;");
            dd("SELECT * FROM user_info  
            LEFT JOIN user_religion ON user_info.user_id = user_religion.user_ID 
            LEFT JOIN user_locations ON user_info.user_id = user_locations.user_ID 
            LEFT JOIN user_family ON user_info.user_id = user_family.user_ID 
            LEFT JOIN user_physical_details ON user_info.user_id = user_physical_details.user_ID
            LEFT JOIN user_about ON user_info.user_id = user_about.user_ID
            LEFT JOIN user_diet_hobbies ON user_info.user_id = user_diet_hobbies.user_ID
            LEFT JOIN user_education_occupations ON user_info.user_id = user_education_occupations.user_ID
            WHERE user_info.user_gender = '$gender' AND user_physical_details.user_height = '$user_height' ;");


















            // $user_partnerpreference = DB::table('user_partnerpreference')->where('user_ID', $userId)->get();
            // $hightmatch = DB::table('user_physical_details')->where('user_height', $user_partnerpreference[0]->user_height)->get();
            // $user_religion = DB::table('user_religion')->where('user_religion', $user_partnerpreference[0]->user_religion)->get();
            // // $cast = DB::table('user_religion')->where('user_religion',$user_partnerpreference[0]->user_religion)->get();
            // $user_country = DB::table('user_locations')->where('user_country', $user_partnerpreference[0]->user_country)->where('user_state', $user_partnerpreference[0]->user_state)->where('user_city', $user_partnerpreference[0]->user_city)->get();
            // $user_marital_status = DB::table('user_info')->where('user_marital_status', $user_partnerpreference[0]->user_marital_status)->get();
            // $user_employed_In = DB::table('user_education_occupations')->where('user_employed_In',$user_partnerpreference[0]->user_employed_In)->get();
            // $user_occupation = DB::table('user_education_occupations')->where('user_occupation',$user_partnerpreference[0]->user_occupation)->get();
            // $user_mother_toungh = DB::table('user_info')->where('user_mother_toungh',$user_partnerpreference[0]->user_mother_toungh)->get();
            // $user_max_anual_income = DB::table('user_education_occupations')->whereBetween('user_anual_income',array($user_partnerpreference[0]->user_min_anual_income,$user_partnerpreference[0]->user_max_anual_income))->get();
            // $user_arr = array(
            //     "status" => false,
            //     "success" => false,
            //     "hightmatch" =>$hightmatch,
            //     "user_religion" => $user_religion,
            //     "user_country" => $user_country,
            //     "user_marital_status" => $user_marital_status,
            //     "user_employed_In" => $user_employed_In,
            //     "user_occupation" => $user_occupation,
            //     "user_mother_toungh" => $user_mother_toungh,
            //     "user_max_anual_income" => $user_max_anual_income
            // );
        }

        return json_encode($user_arr);

    }
}