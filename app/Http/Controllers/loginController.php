<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class loginController extends Controller
{
    public function adminLogin()
    {

        $data = json_decode(file_get_contents("php://input"));

        $user = $data->userId;
        $password = $data->password;

        try {


            $logindata = DB::table('admin')->where('UserId', $user)->get();
            if (count($logindata) > 0) {
                if ($password == $logindata[0]->Password) {

                    $user_arr = array(
                        "status" => true,
                        "success" => true,
                        "id" => $logindata[0]->UserId,
                        "name" => $logindata[0]->name,
                        "message" => "Login Successfully !",
                    );

                } else {
                    $user_arr = array(
                        "status" => false,
                        "success" => false,
                        "id" => '',
                        "name" => '',
                        "message" => "Password not match !",
                    );
                }
            } else {

                $user_arr = array(
                    "status" => false,
                    "success" => false,
                    "id" => '',
                    "name" => '',
                    "message" => "User Id not match !",
                );
            }
        } catch (Exception $e) {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "id" => '',
                "name" => '',
                "message" => "Something Wrong Happened!",
            );

        }

        return json_encode($user_arr);
    }

    public function userLogin(){
         $data = json_decode(file_get_contents("php://input"));
        //dd($data);
        $user = isset($data->userID) ? $data->userID : '' ;
        $password = isset($data->password) ? $data->password : '' ;
        //dd($user);
        if($user == '' || $user == null || $password == '' || $password == null ){
            $user_arr = array(
                "status" => false,
                "success" => false,
                "id" => '',
                "name" => '',
                "message" => "Enter proper Data",
            );
        }

        try {

            $logindata = DB::table('auth_user')->orwhere('auth_ID', $user)->orWhere('auth_email',$user)->orWhere('auth_phone_no',$user)->get();
           // dd($logindata);
            if (count($logindata) > 0) {
                if (md5($password) == $logindata[0]->auth_password) {

                    $user_arr = array(
                        "status" => true,
                        "success" => true,
                        "profile_id"=>$logindata[0]->auth_ID,
                        "profile_name"=>$logindata[0]->name,
                        "profile_email"=>$logindata[0]->auth_email,
                        "profile_phone"=>$logindata[0]->auth_phone_no
                    );
                } else {
                    $user_arr = array(
                        "status" => false,
                        "success" => false,
                        "id" => '',
                        "name" => '',
                        "message" => "Password not match !",
                    );
                }
            } else {

                $user_arr = array(
                    "status" => false,
                    "success" => false,
                    "id" => '',
                    "name" => '',
                    "message" => "User Id not match !",
                );
            }
        } catch (Exception $e) {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "id" => '',
                "name" => '',
                "message" => "Something Wrong Happened!",
            );

        }

        return json_encode($user_arr);
    }


}