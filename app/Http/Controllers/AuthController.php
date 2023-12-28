<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class AuthController extends Controller
{
    public function adminLogin(Request $request)
    {
        // Validate user credentials (e.g., username and password)
        // ...
        $requestedData = $request->all();
        // $data = json_decode(file_get_contents("php://input"));

        try {
            $user = $requestedData['userId'];
            $password = $requestedData['password'];
            $logindata = DB::table('admin')->where('UserId', $user)->get();
            if (count($logindata) > 0) {
                if ($password == $logindata[0]->Password) {
                    // Define the expiration time for the token (e.g., 1 hour from now)
                    // $expiration = Carbon::now()->addHours(24)->timestamp;
                    $expiration = Carbon::now()->addHours(12)->timestamp;
                    // If credentials are valid, generate JWT
                    $key = env('JWT_SECRET');  // Secret key from .env or configuration
                    $payload = [
                        'user_id' => $user,
                        'password' => $password,
                        'role' => "admin",
                        'exp' => $expiration,
                        'loginFrom' => "ADMIN"
                    ];
                    $algorithm = 'HS256';
                    $jwt = JWT::encode($payload, $key, $algorithm);
                    // return response()->json(['token' => $jwt]);
                    $user_arr = array(
                        "status" => true,
                        "success" => true,
                        "id" => $logindata[0]->UserId,
                        "name" => $logindata[0]->name,
                        "exp" => $expiration,
                        "token" => $jwt,
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
        } catch (\Exception $e) {

            return response()->json(['error' => 'Token not provided'], 401);
        }

        return json_encode($user_arr);
    }
}
