<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class filterController extends Controller
{
    public function matches()
    {
        $data = json_decode(file_get_contents("php://input"));
        $user_id = isset($data->user_id) ? $data->user_id : '';
        if ($user_id == '') {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => "Please enter required parametes",
            );
        } else {

            // try {

            // $user_partnerpreference = DB::table('user_partnerpreference')->where('user_ID', $user_id)->get();
            //$user_height = $user_partnerpreference[0]->user_height;
            // dd($user_partnerpreference);
            $user = DB::table('user_info')->where('user_ID', $user_id)->get('user_gender');
            //dd($user);
            $gender = $user[0]->user_gender == "male" ? 'female' : 'male';
            //dd($gender);
            $user_activities = DB::table('user_activities')->where('user_id', $user_id)->get('user_block_list');
            if (count($user_activities) > 0) {
                $user_block_list = $user_activities[0]->user_block_list;


                $elements = explode(',', $user_block_list);

                // Enclose each element in double quotes
                $quotedElements = array_map(function ($element) {
                    return '"' . $element . '"';
                }, $elements);

                // Join the elements with commas
                $outputString = implode(",", $quotedElements);

            } else {
                $outputString = '""';
            }

            // echo $outputString;





            // dd($user_block_list);
            // dd("SELECT * FROM user_info  
            // LEFT JOIN user_religion ON user_info.user_id = user_religion.user_ID 
            // LEFT JOIN user_locations ON user_info.user_id = user_locations.user_ID 
            // LEFT JOIN user_family ON user_info.user_id = user_family.user_ID 
            // LEFT JOIN user_physical_details ON user_info.user_id = user_physical_details.user_ID
            // LEFT JOIN user_about ON user_info.user_id = user_about.user_ID
            // LEFT JOIN user_diet_hobbies ON user_info.user_id = user_diet_hobbies.user_ID
            // LEFT JOIN user_education_occupations ON user_info.user_id = user_education_occupations.user_ID
            // WHERE user_info.user_gender = '$gender'  AND user_info.user_status = 'Approved'  AND (user_info.user_id NOT IN ($outputString)) ;");

            $alldata = DB::select("SELECT * FROM user_info  
            LEFT JOIN user_religion ON user_info.user_id = user_religion.user_ID 
            LEFT JOIN user_locations ON user_info.user_id = user_locations.user_ID 
            LEFT JOIN user_family ON user_info.user_id = user_family.user_ID 
            LEFT JOIN user_physical_details ON user_info.user_id = user_physical_details.user_ID
            LEFT JOIN user_about ON user_info.user_id = user_about.user_ID
            LEFT JOIN user_diet_hobbies ON user_info.user_id = user_diet_hobbies.user_ID
            LEFT JOIN user_education_occupations ON user_info.user_id = user_education_occupations.user_ID
            WHERE user_info.user_gender = '$gender'  AND user_info.user_status = 'Approved'   AND  user_info.user_id NOT IN ($outputString) ;");
            // dd("SELECT * FROM user_info  
            // LEFT JOIN user_religion ON user_info.user_id = user_religion.user_ID 
            // LEFT JOIN user_locations ON user_info.user_id = user_locations.user_ID 
            // LEFT JOIN user_family ON user_info.user_id = user_family.user_ID 
            // LEFT JOIN user_physical_details ON user_info.user_id = user_physical_details.user_ID
            // LEFT JOIN user_about ON user_info.user_id = user_about.user_ID
            // LEFT JOIN user_diet_hobbies ON user_info.user_id = user_diet_hobbies.user_ID
            // LEFT JOIN user_education_occupations ON user_info.user_id = user_education_occupations.user_ID
            // WHERE user_info.user_gender = '$gender'  AND user_info.user_status = 'Approved'  AND user_info.user_id NOT IN ($user_block_list) ;");

            if (count($alldata) > 0) {
                $user_arr = array(
                    "status" => true,
                    "success" => true,
                    "data" => $alldata,
                    "message" => count($alldata) . ' records Match'
                );
            } else {
                $user_arr = array(
                    "status" => false,
                    "success" => false,
                    "message" => "No Match Found",
                );
            }
            // } catch (Exception $e) {
            //     $user_arr = array(
            //         "status" => false,
            //         "success" => false,
            //         "message" => "No Match Found",
            //     );
            // }

        }
        return json_encode($user_arr);
    }

    public function matchesforindivisual()
    {
        $data = json_decode(file_get_contents("php://input"));

        $user_id = isset($data->user_id) ? $data->user_id : '';
        if ($user_id == '') {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => "Please enter required parametes",
            );
        } else {

            // try {

            $user_partnerpreference = DB::table('user_partnerpreference')->where('user_ID', $user_id)->get();
            $user_height = $user_partnerpreference[0]->user_height;
            $user_religion = $user_partnerpreference[0]->user_religion;
            $user_country = $user_partnerpreference[0]->user_country;
            $user_marital_status = $user_partnerpreference[0]->user_marital_status;
            $user_city = $user_partnerpreference[0]->user_city;
            $user_employed_In = $user_partnerpreference[0]->user_employed_In;
            $user_occupation = $user_partnerpreference[0]->user_occupation;
            $user_mother_toungh = $user_partnerpreference[0]->user_mother_toungh;
            $user_max_anual_income = $user_partnerpreference[0]->user_max_anual_income;
            $user_min_anual_income = $user_partnerpreference[0]->user_min_anual_income;

            $user = DB::table('user_info')->where('user_ID', $user_id)->get('user_gender');

            $gender = $user[0]->user_gender == "male" ? 'female' : 'male';

            $alldata = DB::select("SELECT * FROM user_info  
            LEFT JOIN user_religion ON user_info.user_id = user_religion.user_ID 
            LEFT JOIN user_locations ON user_info.user_id = user_locations.user_ID 
            LEFT JOIN user_family ON user_info.user_id = user_family.user_ID 
            LEFT JOIN user_physical_details ON user_info.user_id = user_physical_details.user_ID
            LEFT JOIN user_about ON user_info.user_id = user_about.user_ID
            LEFT JOIN user_diet_hobbies ON user_info.user_id = user_diet_hobbies.user_ID
            LEFT JOIN user_education_occupations ON user_info.user_id = user_education_occupations.user_ID
            WHERE
            ( user_religion.user_religion = '$user_religion' 
            OR  user_info.user_marital_status = '$user_marital_status'
            OR  user_education_occupations.user_employed_In = '$user_employed_In'
            OR  user_education_occupations.user_occupation = '$user_occupation'
            OR  user_info.user_mother_toungh = '$user_mother_toungh'
            OR  user_education_occupations.user_anual_income BETWEEN '$user_min_anual_income' AND '$user_max_anual_income')
            AND
            ( user_info.user_gender = '$gender' AND user_info.user_status = 'Approved' AND user_info.deleted = 1 AND user_info.status = 1  )
            
            ;");


            if (count($alldata) > 0) {
                $user_arr = array(
                    "status" => true,
                    "success" => true,
                    "data" => $alldata,
                    "message" => count($alldata) . ' records Match'
                );
            } else {
                $user_arr = array(
                    "status" => false,
                    "success" => false,
                    "message" => "No Match Found",
                );
            }
            // } catch (Exception $e) {
            //     $user_arr = array(
            //         "status" => false,
            //         "success" => false,
            //         "message" => "No Match Found",
            //     );
            // }

        }
        return json_encode($user_arr);
    }
    public function matchPersent()
    {
        $data = json_decode(file_get_contents("php://input"));
        // dd($data);
        $loginuserid = isset($data->loginuserid) ? $data->loginuserid : '';
        $preferenceuserid = isset($data->preferenceuserid) ? $data->preferenceuserid : '';

        try {

            $user_partnerpreference = DB::table('user_partnerpreference')->where('user_ID', $loginuserid)->get();
            // dd($user_partnerpreference);
            $user_height = $user_partnerpreference[0]->user_height;
            $user_religion = $user_partnerpreference[0]->user_religion;
            $user_country = $user_partnerpreference[0]->user_country;
            $user_marital_status = $user_partnerpreference[0]->user_marital_status;
            $user_city = $user_partnerpreference[0]->user_city;
            $user_employed_In = $user_partnerpreference[0]->user_employed_In;
            $user_occupation = $user_partnerpreference[0]->user_occupation;
            $user_mother_toungh = $user_partnerpreference[0]->user_mother_toungh;
            $user_max_anual_income = $user_partnerpreference[0]->user_max_anual_income;
            $user_max_anual_income = $user_partnerpreference[0]->user_min_anual_income;

            $income = array($user_max_anual_income, $user_max_anual_income);

            $user_physical_details = DB::table('user_physical_details')->where('user_ID', $preferenceuserid)->where('user_height', $user_height)->exists();
            $user_religion = DB::table('user_religion')->where('user_ID', $preferenceuserid)->where('user_caste', $user_religion)->exists();
            $user_education_occupations = DB::table('user_education_occupations')->where('user_ID', $preferenceuserid)->where('user_employed_In', $user_employed_In)->exists();
            $user_education_occupations1 = DB::table('user_education_occupations')->where('user_ID', $preferenceuserid)->where('user_occupation', $user_occupation)->exists();
            $user_info = DB::table('user_info')->where('user_ID', $preferenceuserid)->where('user_mother_toungh', $user_mother_toungh)->exists();
            $user_education_occupations2 = DB::table('user_education_occupations')->where('user_ID', $preferenceuserid)->whereBetween('user_anual_income', $income)->toSql();
            // dd($user_education_occupations2);
            if ($user_physical_details) {
                $one = 1;
            } else {
                $one = 0;
            }
            if ($user_religion) {
                $two = 1;
            } else {
                $two = 0;
            }
            if ($user_education_occupations) {
                $three = 1;
            } else {
                $three = 0;
            }
            if ($user_education_occupations1) {
                $foure = 1;
            } else {
                $foure = 0;
            }
            if ($user_info) {
                $five = 1;
            } else {
                $five = 0;
            }
            if ($user_education_occupations2) {
                $six = 1;
            } else {
                $six = 0;
            }
            $persent = ($one + $two + $three + $foure + $five + $six) / 6 * 100;
            $user_arr = array(
                "status" => true,
                "success" => true,
                "matches_Count" => round($persent),
            );
        } catch (Exception $e) {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "matches_Count" => 0,
            );
        }
        return json_encode($user_arr);
    }

    public function getplandata(Request $res)
    {
        $data = json_decode(file_get_contents("php://input"));
       // dd($data);

        if ($data == []) {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => 'Come with verifyde sorse',
                "data" => [],
            );
        } else {
            $loginuserid = $data->loginuserid;
            if ($loginuserid == '' || $loginuserid == null) {
                $user_arr = array(
                    "status" => false,
                    "success" => false,
                    "message" => 'Come with verifyde sorse',
                    "data" => [],
                );
            } else {
                $PLANACTIVEORNOT = DB::table('user_info')->where('user_id', $loginuserid)->where('user_membership_plan_active', 1)->where('deleted', 1)->where('status', 1)->exists();
                if ($PLANACTIVEORNOT) {
                    $getdata = DB::table('user_plan_deatils')->where('user_id', $loginuserid)->get('user_plan_id');
                    $membership_plan_id = $getdata[0]->user_plan_id;
                    $plandeatils = DB::table('membership_plan')->where('membership_plan_id', $membership_plan_id)->get();
                    if (count($getdata) > 0) {
                        $user_arr = array(
                            "status" => true,
                            "success" => true,
                            "message" => 'Done',
                            "data" => $plandeatils,
                        );
                    } else {
                        $user_arr = array(
                            "status" => false,
                            "success" => false,
                            "message" => 'Contact to admin',
                            "data" => [],
                        );
                    }
                } else {
                    $user_arr = array(
                        "status" => false,
                        "success" => false,
                        "message" => 'Contact to admin',
                        "data" => [],
                    );
                }
            }
        }
        return json_encode($user_arr);
    }



}