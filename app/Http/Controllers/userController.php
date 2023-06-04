<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    public function addUserDataFirstApi(Request $res){
        
        $data = json_decode(file_get_contents("php://input"));
        $profiletype =  !isset($data->profiletype) ? 'myself' : $data->profiletype;
        $userId = 'PATRABIBAHA'.rand(1000,9999);
        $email = !isset($data->email) ? '' : $data->email;
        $phone = !isset($data->phone) ? '': $data->phone;
        $password = !isset($data->password) ? '' : md5($data->password);
        $gender = !isset($data->gender) ? '' : $data->gender;
        // $status  = !isset($data->status) ? '' : $data->status;
        if(empty($profiletype) || empty($email)  || empty($phone) || empty($password) || empty($gender)){
            $user_arr = array(
                "status"=> false,
                "success"=> false,
                "message"=> "Please Fill All Data",
            );
        }
          $getAuthUserCount = DB::table('auth_user')
          ->where('auth_email', $email)
          ->where('auth_phone_no', $phone)
          ->count();
        if($getAuthUserCount == 0){
            $user = DB::table('user_info')->insert([
                'user_id'=>$userId,
                'user_gender'=>$gender,
                'status' =>1,
                'deleted' => 1,
            ]);
            $authuser = DB::table('auth_user')->insert([
                'auth_ID'=>$userId,
                'auth_email'=>$email,
                'auth_password'=>$password,
                'auth_phone_no'=> $phone
            ]);
        
            if($user > 0 && $authuser > 0 ){
                $user_arr = array(
                    "status"=> true,
                    "success"=> true,
                    "profileID"=>$userId,
                    "message"=> "Data Inserted Successfully !",
                );
            }else{
                $user_arr = array(
                    "status"=> false,
                    "success"=> false,
                    "message"=> "Data not Inserted Successfully !",
                );
            }
        }else{
            $user_arr = array(
                "status"=> false,
                "success"=> false,
                "message"=> "Enter Email and Phone no already exist!",
            );
        }
        return json_encode($user_arr);


    }

    public function addUserDataSecondApi(Request $res){
        
        $data = json_decode(file_get_contents("php://input"));
        
        
        //dd($data);
        $name =  !isset($data->name) ?'' : $data->name; // :'';
        $dob = !isset($data->dob) ?'' : $data->dob;
        if($name == '' || $dob == '' ){
            $user_arr = array(
                "status"=> false,
                "success"=> false,
                "message"=> "enter a valid data",
            );
        }

        // if($status == 1){
            $user = DB::table('user_info')->insert([
                'name' => $name,
                'dob'=>$dob,
            ]);
            $authuser = DB::table('auth_user')->insert([
                'name'=> $name
            ]);

             
            if($user > 0 && $authuser>0 ){
                $user_arr = array(
                    "status"=> true,
                    "success"=> true,
                    "message"=> "Data Inserted Successfully !",
                );
            }else{
                $user_arr = array(
                    "status"=> false,
                    "success"=> false,
                    "message"=> "Data not Inserted Successfully !",
                );
            }
        // }

        return json_encode($user_arr);


    }
    
}