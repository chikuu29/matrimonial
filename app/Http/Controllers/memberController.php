<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class memberController extends Controller
{
    public function memberpaln(Request $res)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if ($data == null) {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => "Where is your data!",
            );
        } else {

            $addarray = array(
                'membership_plan_id' => time() . rand(100, 999)
            );

            // print_r($input);
            // return ;
            //dd( $data );
            $finalarray = array_merge($data['value'], $addarray);
            try {
                $inputdata = DB::table('membership_plan')->insert($finalarray);
                $type = DB::table('type')->where('name', $finalarray['membership_plan_type'])->update([
                    "used" => 1
                ]);
                if ($inputdata > 0) {
                    $user_arr = array(
                        "status" => true,
                        "success" => true,
                        "message" => "Data Inserted Successfully !",
                    );
                } else {
                    $user_arr = array(
                        "status" => false,
                        "success" => false,
                        "message" => "Data Not Inserted !",
                    );
                }

            } catch (Exception $e) {
                $user_arr = array(
                    "status" => false,
                    "success" => false,
                    "message" => "Error" . $e,
                );
            }
        }
        return json_encode($user_arr);
        // dd($finalarray);
        // dd($input['value']['type']);


    }
    public function getAllData()
    {
        $data = json_decode(file_get_contents("php://input"));
        $id = !isset($data->id) || $data->id == null ? '' : $data->id;
        if ($id == '') {
            $alldata = DB::table('membership_plan')->get();
            if (count($alldata) > 0) {
                $user_arr = array(
                    "status" => true,
                    "success" => true,
                    "message" => $alldata,
                );
            } else {
                $user_arr = array(
                    "status" => false,
                    "success" => false,
                    "message" => [],
                );
            }
        } else {
            $alldata = DB::table('membership_plan')->where('Id', $id)->get();
            if (count($alldata) > 0) {
                $user_arr = array(
                    "status" => true,
                    "success" => true,
                    "message" => $alldata,
                );
            } else {
                $user_arr = array(
                    "status" => false,
                    "success" => false,
                    "message" => [],
                );
            }
        }
        return json_encode($user_arr);
    }
    function getMembersheepPlan(Request $res)
    {
        // dd($res->all());
        if ($res->all() == null) {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => "Where is your data!",
            );
        } else {
            $input = $res->all();
            try {
                
                $userId = $input['userId'];
                $avtiveplan = DB::table('user_plan_deatils')->where('user_id', $userId)->where('active_status', 1)->first();
                $curentplanid = $avtiveplan->user_plan_id;
                $plan = DB::table('membership_plan')->where('membership_plan_id', $curentplanid)->first();
                $plan_start_date = $avtiveplan->plan_stating_date;
                $plan_end_date = $avtiveplan->plan_ending_date;
                $plan_type = $avtiveplan->user_plan_type;
                $expire = DB::table('user_plan_deatils')->where('user_id', $userId)->where('active_status', 0)->get();
                date_default_timezone_set('Asia/Kolkata');
                $curenttim = date("Y-m-d h:i:s");
                $curentdateinstring = strtotime($curenttim);
                $expirydate = strtotime($plan_end_date);
                $plan_expire_in_days = $expirydate - $curentdateinstring;
                // dd($plan_expire_in_days);
                //dd();
                $user_arr = array(
                    "status" => false,
                    "success" => false,
                    "message" => "Done",
                    "profile_id" => $userId,
                    "current_active_plan" => $avtiveplan,
                    "currect_active_plan_id" => $avtiveplan->user_plan_id,
                    "plan_history" => $expire,
                    "plan_start_date" => $plan_start_date,
                    "plan_end_date" => $plan_end_date,
                    "plan_type" => $plan_type,
                    "currect_active_plan_information" => $plan,
                    "plan_expire_in_days" => (round($plan_expire_in_days / 86400))
                );
    
            } catch (\Throwable $th) {
                $user_arr = array(
                    "status" => false,
                    "success" => false,
                    "message" => "Where is your data!",
                    "ERROR" => $th
                );
            }
           
        }

        return json_encode($user_arr);
    }
}