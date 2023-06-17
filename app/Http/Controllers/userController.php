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
        $profiletype = !isset($data->profiletype) ? 'myself' : $data->profiletype;
        $userId = 'PATRABIBAHA' . rand(1000, 9999);
        $email = !isset($data->email) ? '' : $data->email;
        $phone = !isset($data->phone) ? '' : $data->phone;
        $password = !isset($data->password) ? '' : md5($data->password);
        $gender = !isset($data->gender) ? '' : $data->gender;

        $fname = !isset($data->fname) ? '' : $data->fname; // :'';
        $lname = !isset($data->lname) ? '' : $data->lname; // :'';
        $dob = !isset($data->dob) ? '' : $data->dob;
        // $profileID = !isset($data->profileID) ? '' : $data->profileID;
        // $status  = !isset($data->status) ? '' : $data->status;
        if (empty($profiletype) || empty($email) || empty($phone) || empty($password) || empty($gender)) {
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
                'user_profileType' => $profiletype,
                'user_gender' => $gender,
                'user_email' => $email,
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

        $fname = !isset($data->fname) ? '' : $data->fname; // :'';
        $lname = !isset($data->lname) ? '' : $data->lname; // :'';
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

    public function fatchAllaDataByUserId(Request $res)
    {
        $data = $res->all();
        $userid = isset($data['userid']) ? $data['userid'] : '';

        try {
            $user_info = DB::table('user_info')->where('user_id', $userid)->first();
            $user_education_occupations = DB::table('user_education_occupations')->where('user_ID', $userid)->first();
            //dd($user_education_occupations);
            $user_religion = DB::table('user_religion')->where('user_ID', $userid)->first();
            $user_about = DB::table('user_about')->where('user_ID', $userid)->first();
            $user_diet_hobbies = DB::table('user_diet_hobbies')->where('user_ID', $userid)->first();
            $user_family = DB::table('user_family')->where('user_ID', $userid)->first();
            $user_locations = DB::table('user_locations')->where('user_ID', $userid)->first();
            $user_physical_details = DB::table('user_physical_details')->where('user_ID', $userid)->first();
            $user_partnerpreference = DB::table('user_partnerpreference')->where('user_ID', $userid)->first();
            $user_profile_images = DB::table('user_profile_images')->where('user_ID', $userid)->get();
            //dd( @$user_profile_images[0]);
            if(@$user_info->user_has_complete_profile == 1 && @$user_education_occupations->completed == 1 && @$user_religion->completed  == 1 && @$user_about->completed == 1 && @$user_diet_hobbies->completed == 1 && @$user_family->completed == 1 && @$user_locations->completed  == 1 && @$user_physical_details->completed  == 1 && @$user_partnerpreference->completed  == 1 && @$user_profile_images[0]->completed == 1){

                $user_arr = array(
                    "status" => true,
                    "success" => true,
                    "user_info" => $user_info != null ? $user_info : [],
                    "user_education_occupations" => $user_education_occupations != null ? $user_education_occupations : [],
                    "user_religion" => $user_religion != null ? $user_religion : (object) [],
                    "user_about" => $user_about != null ? $user_about : [],
                    "user_diet_hobbies" => $user_diet_hobbies != null ? $user_diet_hobbies : [],
                    "user_family" => $user_family != null ? $user_family : [],
                    "user_locations" => $user_locations != null ? $user_locations : [],
                    "user_physical_details" => $user_physical_details != null ? $user_physical_details : [],
                    "user_profile_images" => $user_profile_images != null ? $user_profile_images : [],
                    "user_partnerpreference"=>$user_partnerpreference != null ? $user_partnerpreference : [],
                    "user_profile_status" => "Completed",
                );

            }else{
                $user_arr = array(
                    "status" => true,
                    "success" => true,
                    "user_info" => $user_info != null ? $user_info : [],
                    "user_education_occupations" => $user_education_occupations != null ? $user_education_occupations : [],
                    "user_religion" => $user_religion != null ? $user_religion : (object) [],
                    "user_about" => $user_about != null ? $user_about : [],
                    "user_diet_hobbies" => $user_diet_hobbies != null ? $user_diet_hobbies : [],
                    "user_family" => $user_family != null ? $user_family : [],
                    "user_locations" => $user_locations != null ? $user_locations : [],
                    "user_physical_details" => $user_physical_details != null ? $user_physical_details : [],
                    "user_partnerpreference"=>$user_partnerpreference != null ? $user_partnerpreference : [],
                    "user_profile_images" => $user_profile_images != null ? $user_profile_images : [],
                    "user_profile_status" => "Not Completed",
                );
            }

           
        } catch (Exception $e) {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => "Error" . $e
            );
        }

        return json_encode($user_arr);
    }

    public function uploadImage(Request $request)
    {

        $alldata = $request->all();
        // print_r($alldata);
        $id = $alldata['q']; 
        if ($request->hasFile('uploadfile')) {
            $file = $request->file('uploadfile');
            $imagedata = $_FILES['uploadfile']['name'];
            $temp = $_FILES['uploadfile']['tmp_name'];
            $datainarryform = array();
            for ($i = 0; $i < count($imagedata); $i++) {
                $imgstoreindatabase[$i] = $i . time() . '.' . $_FILES['uploadfile']['name'][$i];
                $a[$i] = str_replace($_FILES['uploadfile']['name'][$i], 'jpg', $imgstoreindatabase[$i]);
                $c = move_uploaded_file($temp[$i], storage_path() . '/' . $a[$i]);
                array_push($datainarryform, $a[$i]);
            }
            $d = implode(',', $datainarryform);

            $user_info = DB::table('user_info')->where('user_id', $id)->update([
                'user_profile_image' => $d
            ]);
            $profile_image_table = DB::table('user_profile_images')->insert([
                'completed'=>1,
                'user_ID' => $id,
                'user_feature_images' => $d,
                'user_profile_images' => $d
            ]);
            if ($user_info > 0 && $profile_image_table > 0) {
                $user_arr = array(
                    "success" => true,
                    "message" => "File Uploaded Successfully",
                    "data"=>$d
                );
            } else {
                $user_arr = array(
                    "success" => false,
                    "message" => "Unable to Store Data"
    
                );
            }

            return json_encode($user_arr);
        }
    }


}
