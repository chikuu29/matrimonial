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

        $email = !isset($data->email) ? '' : $data->email;
        $phone = !isset($data->phone) ? '' : $data->phone;
        $password = !isset($data->password) ? '' : md5($data->password);
        $gender = !isset($data->gender) ? '' : $data->gender;

        $fname = !isset($data->fname) ? '' : $data->fname; // :'';
        $lname = !isset($data->lname) ? '' : $data->lname; // :'';
        $dob = !isset($data->dob) ? '' : $data->dob;
        $iddata = DB::table('prefix_id')->get('prefix_id_name');
        $id = $iddata[0]->prefix_id_name;
        $userId = $id . chr(64 + rand(0, 26)) . rand(0, 9) . chr(64 + rand(0, 26)) . rand(0, 9) . chr(64 + rand(0, 26)) . rand(1000, 9999);
        if (empty($profiletype) || empty($email) || empty($phone) || empty($password) || empty($gender)) {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => "Please Fill All Data",
            );
        }
        $getAuthUserCount = DB::table('auth_user')
            ->where('auth_email', $email)
            ->orWhere('auth_phone_no', $phone)
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
                    "message" => "Congratulation! Your Registration Done",
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
            $user_plan_deatils = DB::table('user_plan_deatils')->where('user_id', $userid)->get();
            $user_horoscope_deatils = DB::table('user_horoscope')->where('user_id', $userid)->get()->first();
            //dd( @$user_profile_images[0]);
            if (@$user_info->user_has_complete_profile == 1 && @$user_education_occupations->completed == 1 && @$user_religion->completed == 1 && @$user_about->completed == 1 && @$user_diet_hobbies->completed == 1 && @$user_family->completed == 1 && @$user_locations->completed == 1 && @$user_physical_details->completed == 1  && @$user_profile_images[0]->completed == 1 && @$user_horoscope_deatils[0]->completed) {
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
                    "user_profile_images" => $user_profile_images != null ? $user_profile_images : (object)[],
                    "user_partnerpreference" => $user_partnerpreference != null ? $user_partnerpreference : [],
                    "user_profile_status" => "Completed",
                    "user_plan_deatils" => $user_plan_deatils != null ? $user_plan_deatils : [],
                    "user_horoscope_deatils"=>$user_horoscope_deatils != null ? $user_horoscope_deatils : []
                );
            } else {
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
                    "user_partnerpreference" => $user_partnerpreference != null ? $user_partnerpreference : [],
                    "user_profile_images" => $user_profile_images != null ? $user_profile_images : [],
                    "user_profile_status" => "Not Completed",
                    "user_plan_deatils" => $user_plan_deatils != null ? $user_plan_deatils : [],
                    "user_horoscope_deatils"=>$user_horoscope_deatils != null ? $user_horoscope_deatils : []
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

            // $user_info = DB::table('user_info')->where('user_id', $id)->update([
            //     'user_profile_image' => $d
            // ]);
            $profile_image_table = DB::table('user_profile_images')->insert([
                'completed' => 1,
                'user_ID' => $id,
                'user_feature_images' => $d,
                'user_profile_images' => $d
            ]);
            // $user_info > 0 &&
            if ($profile_image_table > 0) {
                $user_arr = array(
                    "success" => true,
                    "message" => "File Uploaded Successfully",
                    "data" => $d
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

    public function userActivation(Request $res)
    {
       // dd();
        $data = $res->all();
        $id = isset($data['id']) ? $data['id'] : '';

        $plan = DB::table('membership_plan')->where('membership_plan_default', 1)->get();

        $edited_plan_details = DB::table('edited_plan_details')->insert([
            'user_id' => $id,
            'photoviwe' => $plan[0]->membership_plan_no_of_photo,
            'sendmessage' => $plan[0]->membership_plan_of_send_message,
            'horscope' => $plan[0]->membership_plan_no_of_horscope,
            'contact_view' => $plan[0]->membership_plan_no_of_contact,
            'contact_view_other' => $plan[0]->membership_plan_show_contact_number_other,
            'chating' => $plan[0]->membership_plan_chating
        ]);
        if ($edited_plan_details) {

            $userdeatils = DB::table('user_info')->where('user_id', $id)->get();
            $user_plan_deatils = DB::table('user_plan_deatils')->where('user_id', $id)->exists();


            if ($user_plan_deatils) {
                $user_arr = array(
                    "status" => false,
                    "success" => false,
                    "message" => 'Defult Plan Added',
                );
            } else {
                $Date = date('Y-m-d h:i:s');
                $valid = date('Y-m-d h:i:s', strtotime($Date . ' +' . $plan[0]->membership_plan_validity_date . 'days'));
                $insertdata = DB::table('user_info')->where('user_id', $id)->update([
                    'user_membership_plan_type' => $plan[0]->membership_plan_type,
                    'user_ready_for_active_account' => 0,
                    'user_membership_plan_active' => 1,
                    'user_status' => 'Approved'
                ]);
                $insertdatain_user_plan_deatils = DB::table('user_plan_deatils')->insert([
                    'user_id' => $id,
                    'user_email' => $userdeatils[0]->user_email,
                    'user_plan_type' => $plan[0]->membership_plan_type,
                    'user_plan_id' => $plan[0]->membership_plan_id,
                    'plan_ending_date' => $valid
                ]);

                if ($insertdata > 0 && $insertdatain_user_plan_deatils > 0) {
                    $user_arr = array(
                        "status" => true,
                        "success" => true,
                        "message" => 'Update Successfully! ',
                    );
                } else {
                    $user_arr = array(
                        "status" => false,
                        "success" => false,
                        "message" => 'Not Update Successfully! ',
                    );
                }
            }
        }else{
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => 'Not Update Successfully! ',
            );
        }
        return json_encode($user_arr);
    }
    public function profileValidation(Request $res)
    {
        $data = $res->all();

        $id = isset($data['id']) ? $data['id'] : '';
        $profile_image_table = DB::table('user_profile_images')->where('user_ID', $id)->get();

        $user_info = DB::table('user_info')->where('user_id', $id)->update([
            'user_profile_image' => $profile_image_table[0]->user_profile_images
        ]);
        if ($user_info > 0) {
            $user_arr = array(
                "success" => true,
                "message" => "Approvaled",
            );
        } else {
            $user_arr = array(
                "success" => false,
                "message" => "Not Approvaled",
            );
        }
        return json_encode($user_arr);
    }
}