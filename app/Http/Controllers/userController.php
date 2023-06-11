<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function FastRoute\TestFixtures\empty_options_cached;

class userController extends Controller
{
    public function addUserDataFirstApi(Request $res)
    {

        $data = json_decode(file_get_contents("php://input"));
        $profiletype =  !isset($data->profiletype) ? 'myself' : $data->profiletype;
        $userId = 'PATRABIBAHA' . rand(1000, 9999);
        $email = !isset($data->email) ? '' : $data->email;
        $phone = !isset($data->phone) ? '' : $data->phone;
        $password = !isset($data->password) ? '' : md5($data->password);
        $gender = !isset($data->gender) ? '' : $data->gender;

        $fname =  !isset($data->fname) ? '' : $data->fname; // :'';
        $lname =  !isset($data->lname) ? '' : $data->lname; // :'';
        $dob = !isset($data->dob) ? '' : $data->dob;
        // $profileID = !isset($data->profileID) ? '' : $data->profileID;
        // $status  = !isset($data->status) ? '' : $data->status;
        if (empty($profiletype) || empty($email)  || empty($phone) || empty($password) || empty($gender)) {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => "Please Fill All Data",
            );
        }
        $getAuthUserCount = DB::table('auth_user')
            ->where('auth_email', $email)
            ->where('auth_phone_no', $phone)
            ->count();
        if ($getAuthUserCount == 0) {
            $user = DB::table('user_info')->insert([
                'user_id' => $userId,
                'user_profileType'=>$profiletype,
                'user_gender' => $gender,
                'user_email'=>$email,
                'user_fname' => $fname,
                'user_lname' => $lname,
                'user_dob' => $dob,
                'status' => 1,
                'deleted' => 1,
            ]);
            $authuser = DB::table('auth_user')->insert([
                'auth_ID' => $userId,
                'auth_email' => $email,
                'auth_password' => $password,
                'auth_phone_no' => $phone,
                'auth_name' => $fname . " " . $lname
                
            ]);

            if ($user > 0 && $authuser > 0) {
                $user_arr = array(
                    "status" => true,
                    "success" => true,
                    "profileID" => $userId,
                    "message" => "Data Inserted Successfully !",
                );
            } else {
                $user_arr = array(
                    "status" => false,
                    "success" => false,
                    "message" => "Data not Inserted Successfully !",
                );
            }
        } else {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => "Enter Email and Phone no already exist!",
            );
        }
        return json_encode($user_arr);
    }

    public function addUserDataSecondApi(Request $res)
    {

        $data = json_decode(file_get_contents("php://input"));

        $fname =  !isset($data->fname) ? '' : $data->fname; // :'';
        $lname =  !isset($data->lname) ? '' : $data->lname; // :'';
        $dob = !isset($data->dob) ? '' : $data->dob;
        $profileID = !isset($data->profileID) ? '' : $data->profileID;

        if (empty($fname) || empty($lname) || empty($dob)) {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => "Please Fill All Details",
            );
        } else {
        }
        $user = DB::table('user_info')->where('user_id', $profileID)
            ->update([
                'user_fname' => $fname,
                'user_lname' => $lname,
                'user_dob' => $dob,
            ]);
        $authuser = DB::table('auth_user')->where('auth_ID', $profileID)
            ->update([
                'auth_name' => $fname . " " . $lname
            ]);

        if ($user > 0 && $authuser > 0) {
            $user_arr = array(
                "status" => true,
                "success" => true,
                "message" => "Congratulation! your account setup done",
            );
        } else {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => "Data not Inserted Successfully !",
            );
        }
        return json_encode($user_arr);
    }

    public function fatchAllaDataByUserId(Request $res){
        $data = $res->all();
        $userid = isset($data['userid']) ? $data['userid'] : '';

        try{
            $user_info=DB::table('user_info')->where('user_id',$userid)->first();
            $user_education_occupations=DB::table('user_education_occupations')->where('user_ID',$userid)->first();
            $user_religion=DB::table('user_religion')->where('user_ID',$userid)->first();            
            $user_arr = array(
                "status" => true,
                "success" => true,
                "user_info" => $user_info != null ? $user_info : [],
                "user_education_occupations"=>$user_education_occupations != null ? $user_education_occupations : [],
                "user_religion" => $user_religion != null ? $user_religion : (object)[],
            );


        }catch(Exception $e){
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => "Error".$e
            );
        }

        return json_encode($user_arr);

    }
}
