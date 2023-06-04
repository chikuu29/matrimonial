<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    public function addUserDataFirstApi(Request $res){
        
        $data = json_decode(file_get_contents("php://input"));
        
        
        //dd($data);
        $forwhich =  !isset($data->forwhich) ?'' : $data->profiletype;
        $UserId = 'PATRABIBAHA'.rand(1000,9999);
        $email = !isset($data->email) ? '' : $data->email;
        $phoneno = !isset($data->phoneno) ? '': $data->phoneno;
        $password = !isset($data->password) ? '' : md5($data->password);
        $gender = !isset($data->gender) ? '' : $data->gender;
        $status  = !isset($data->status) ? '' : $data->status;
        

        if( $email == '' || $phoneno == '' || $password == '' || $status == '' ){
            $user_arr = array(
                "status"=> false,
                "success"=> false,
                "message"=> "enter a valid data",
            );
        }

        if($status == 1){
            $user = DB::table('user_info')->insert([
                'UserId'=>$UserId,
                'email'=>$email,
                //'password'=>$password,
                'phoneno'=>$phoneno,
                'status' =>1,
                'deleted' => 1,
            ]);
            $authuser = DB::table('auth_user')->insert([
                'userId'=>$UserId,
                'email'=>$email,
                'password'=>$password,
                'phone_no'=> $phoneno
            ]);
             
            if($user > 0 && $authuser > 0 ){
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
