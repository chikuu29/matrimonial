<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class planCalculationController extends Controller
{
    public function callCalculation(Request $res)
    {
        $data = $res->all();
        $userid = isset($data['userid']) ? $data['userid'] : '';
        $edited_plan_details = DB::table('edited_plan_details')->where('User_id', $userid)->first();
        if ($edited_plan_details->contact_view > 0) {
            $substractiondata = $edited_plan_details->contact_view - 1;
            //dd($substractiondata);
            $data = DB::table('edited_plan_details')->where('User_id', $userid)->update([
                "contact_view" => $substractiondata
            ]);
            if ($data) {
                $user_arr = array(
                    "status" => true,
                    "success" => true,
                    "message" => "Done"
                );
            } else {
                $user_arr = array(
                    "status" => false,
                    "success" => false,
                    "message" => "Not Done"
                );
            }
        } else {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => "Used"
            );
        }
        return json_encode($user_arr);
    }
    public function sendMessageCalculation(Request $res)
    {
        $data = $res->all();
        $userid = isset($data['userid']) ? $data['userid'] : '';
        $edited_plan_details = DB::table('edited_plan_details')->where('User_id', $userid)->first();
        if ($edited_plan_details->sendmessage > 0) {
            $substractiondata = $edited_plan_details->sendmessage - 1;
            //dd($substractiondata);
            $data = DB::table('edited_plan_details')->where('User_id', $userid)->update([
                "sendmessage" => $substractiondata
            ]);
            if ($data) {
                $user_arr = array(
                    "status" => true,
                    "success" => true,
                    "message" => "Done"
                );
            } else {
                $user_arr = array(
                    "status" => false,
                    "success" => false,
                    "message" => "Not Done"
                );
            }
        } else {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => "Used"
            );
        }
        return json_encode($user_arr);
    }
    public function horscopeCalculation(Request $res)
    {
        $data = $res->all();
        $userid = isset($data['userid']) ? $data['userid'] : '';
        $edited_plan_details = DB::table('edited_plan_details')->where('User_id', $userid)->first();
        if ($edited_plan_details->horscope > 0) {
            $substractiondata = $edited_plan_details->horscope - 1;
            //dd($substractiondata);
            $data = DB::table('edited_plan_details')->where('User_id', $userid)->update([
                "horscope" => $substractiondata
            ]);
            if ($data) {
                $user_arr = array(
                    "status" => true,
                    "success" => true,
                    "message" => "Done"
                );
            } else {
                $user_arr = array(
                    "status" => false,
                    "success" => false,
                    "message" => "Not Done"
                );
            }
        } else {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => "Used"
            );
        }
        return json_encode($user_arr);
    }
    public function contactViewOtherCalculation(Request $res)
    {
        $data = $res->all();
        $userid = isset($data['userid']) ? $data['userid'] : '';
        $edited_plan_details = DB::table('edited_plan_details')->where('User_id', $userid)->first();
        //dd($edited_plan_details->contact_view_other > 0);
        if ($edited_plan_details->contact_view_other > 0) {
            $substractiondata = $edited_plan_details->contact_view_other - 1;
            //dd($substractiondata);
            $data = DB::table('edited_plan_details')->where('User_id', $userid)->update([
                "contact_view_other" => $substractiondata
            ]);
            if ($data) {
                $user_arr = array(
                    "status" => true,
                    "success" => true,
                    "message" => "Done"
                );
            } else {
                $user_arr = array(
                    "status" => false,
                    "success" => false,
                    "message" => "Not Done"
                );
            }
        } else {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => "Used"
            );
        }
        return json_encode($user_arr);
    }

}