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
        $UserId = 'PATRABIBAHA'.substr($name,0,3).rand(1000,9999);
        $email = !isset($data->email) ? '' : $data->email;
        $phoneno = !isset($data->phoneno) ? '': $data->phoneno;
        $password = !isset($data->password) ? '' : md5($data->password);
        $status  = !isset($data->status) ? '' : $data->status;

        if($name == '' || $email == '' || $phoneno == '' || $password == '' || $status == '' ){
            $user_arr = array(
                "status"=> false,
                "success"=> false,
                "message"=> "enter a valid data",
            );
        }

        if($status == 1){
            $user = DB::table('user')->insert([
                'UserId'=>$UserId,
                'email'=>$email,
                'password'=>$password,
                'phoneno'=>$phoneno,
                'status' =>1,
                'deleted' => 1,
            ]);
             
            if($user > 0){
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

        if($status == 1){
            $user = DB::table('user')->insert([
                'name' => $name,
                'dob'=>$dob,
            ]);
             
            if($user > 0){
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
    
}
