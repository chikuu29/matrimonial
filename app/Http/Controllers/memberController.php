<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class memberController extends Controller
{
    public function memberpaln(Request $res){
        $data = json_decode(file_get_contents("php://input"),true);

        $addarray = array(
            'membership_plan_id'=>time().rand(100,999)
        );
         
        // print_r($input);
        // return ;
        $finalarray = array_merge($data['value'],$addarray);
        // print_r($finalarray);
        // return ;
        try{
            $inputdata = DB::table('membership_plan')->insert($finalarray);
            if($inputdata > 0){
                $user_arr = array(
                    "status" => true,
                    "success" => true,
                    "message" => "Data Inserted Successfully !",
                );
            }else{
                $user_arr = array(
                    "status" => false,
                    "success" => false,
                    "message" => "Data Not Inserted !",
                );
            }

        }catch(Exception $e){
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => "Error".$e,
            );
        }
        return json_encode($user_arr);
        // dd($finalarray);
        // dd($input['value']['type']);
        
    }
    public function getAllData(){
        $data = json_decode(file_get_contents("php://input"));
        $id = !isset($data->id) || $data->id == null ? '' : $data->id;
        if($id == ''){
            $alldata = DB::table('membership_plan')->get();
            if(count($alldata) > 0){
                $user_arr = array(
                    "status" => true,
                    "success" => true,
                    "message" => $alldata,
                );
            }else{
                $user_arr = array(
                    "status" => false,
                    "success" => false,
                    "message" => [],
                );
            }
        }else{
            $alldata = DB::table('membership_plan')->where('Id',$id)->get();
            if(count($alldata) > 0){
                $user_arr = array(
                    "status" => true,
                    "success" => true,
                    "message" => $alldata,
                );
            }else{
                $user_arr = array(
                    "status" => false,
                    "success" => false,
                    "message" => [],
                );
            }
        } 
        return json_encode($user_arr);
    }
}
