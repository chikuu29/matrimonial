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


}