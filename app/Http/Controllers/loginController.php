<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;

class loginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function adminLogin()
    {

        $data = json_decode(file_get_contents("php://input"));
        $user = $data->userId;
        $password = $data->password;
        // $payload = auth()->payload();
        try {


            $logindata = DB::table('Admin')->where('UserId', $user)->get();
            // $result = DB::table('Admin')->where('UserId',$user)->get(['Id','name','UserId']);
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
