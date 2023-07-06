<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dynamic_Crud_controller extends Controller
{
    public function fetch(Request $request)
    {
        // {
        //     "table":"country_table",
        //     "projection":["*"],
        //     "whereConditions":{
        //     "country_name", "INDIA"
        //     }
        //  }  
        // } fetch data parametr formate 
        $requestedData = $request->all();
        $whereConditions = isset($requestedData['whereConditions']) ? $requestedData['whereConditions'] : [];
        $table = isset($requestedData['table']) ? $requestedData['table'] : '';
        $projection = isset($requestedData['projection']) ? $requestedData['projection'] : [];
        if (empty($table)) {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => 'You Provid Empty data',
                'data' => []
            );
        } else {
            if (count($whereConditions) == 0) {
                $fatchdata = DB::table($table)->get($projection);
            } else {
                $fatchdata = DB::table($table)->where($whereConditions)->get($projection);
            }
            $user_arr = array(
                "status" => true,
                "success" => true,
                "message" => 'Total Fetch Data ' . count($fatchdata),
                "data" => $fatchdata
            );
            
        }
        return json_encode($user_arr);
    }

    public function save(Request $request)
    {
        // {
        //     "table":"country_table",
        //     "data":[],
        // } save data parametr format

        $requestedData = $request->all();
        // $data = json_decode(file_get_contents("php://input"), true);
        $data =  $requestedData['data'];
        $table = isset($requestedData['table']) ? $requestedData['table'] : '';
        if (empty($data)) {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => "No Data Updated",
            );
        }
       
        $saveQuery = DB::table($table)->insert($data);
        if ($saveQuery > 0) {
            $user_arr = array(
                "status" => true,
                "success" => true,
                "message" => "Save Successfully !",
            );
        } else {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => "No Data Save",
            );
        }

        return json_encode($user_arr);
    }

    public function update(Request $request)
    {
        // {
        //     "table":"country_table",
        //     "data":[],
        //     "whereConditions":[
        //         ["country_name", "INDIA"]
        //     ]
        // } Upadte data parametr formate 
        // $requestedData = json_decode(file_get_contents("php://input"));
        $requestedData = $request->all();
        $whereConditions = isset($requestedData['whereConditions']) ? $requestedData['whereConditions'] : [];
        $table = isset($requestedData['table']) ? $requestedData['table'] : '';;
        $data = $requestedData['data'];
        if (count($whereConditions) == 0 || $table == '') {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => 'You Provid Empty data',
            );
        } else {
            // print_r($data);
            // return;
            $updateQuery = DB::table($table)->where($whereConditions)->update(
                $data
            );
            if ($updateQuery > 0) {
                $user_arr = array(
                    "status" => true,
                    "success" => true,
                    "message" => 'Update Successfully! ',
                );
            } else {
                $user_arr = array(
                    "status" => false,
                    "success" => false,
                    "error" => $updateQuery,
                    "message" => 'No Data Updated',
                );
            }
        }
        return json_encode($user_arr);
    }

    public function delete()
    {
        $data = json_decode(file_get_contents('php:://input'));
        $id = empty($data->id) ? '' : $data->id;
        $table = empty($data->table) ? '' : $data->table;

        if ($id == '' || $table == '') {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => 'You Provid Empty data',
            );
        } else {
            $query = DB::table($table)->where('Id', $id)->delete();
            if ($query > 0) {
                $user_arr = array(
                    "status" => true,
                    "success" => true,
                    "message" => 'Data Inserted Successfully!',
                );
            } else {
                $user_arr = array(
                    "status" => false,
                    "success" => false,
                    "message" => 'Data Not Inserted Successfully!',
                );
            }
        }

        return json_encode($user_arr);
    }
}
