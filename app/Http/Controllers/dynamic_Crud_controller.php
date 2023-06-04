<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dynamic_Crud_controller extends Controller
{
    public function fetch()
    {
        // {
        //     "table":"country_table",
        //     "projection":["*"],
        //     "whereConditions":[
        //         ["country_name", "INDIA"]
        
        //     ]
        // } fetch data parametr formate 
        $data = json_decode(file_get_contents("php://input"));
        $whereConditions = isset($data->whereConditions) ? $data->whereConditions : [] ;
        $table = isset($data->table) ? $data->table : '' ;
        $projection = isset($data->projection) ? $data->projection : []; 

        if (empty($table)) {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => 'You Provid Empty data',
                'data' => []
            );
        } else {

            if (empty($projection)) {
                $fatchdata = DB::table($table)->get($projection);
            } else {
                $fatchdata = DB::table($table)->where($whereConditions)->get($projection);
            }

            //if (count($fatchdata) > 0) {
                $user_arr = array(
                    "status" => true,
                    "success" => true,
                    "message" => 'Total Fetch Data ' . count($fatchdata),
                    "data" => $fatchdata
                );
            //} 
            // else {
            //     $user_arr = array(
            //         "status" => false,
            //         "success" => false,
            //         "message" => 'Total Fetch Data ' . count($fatchdata),
            //         "data" => []
            //     );
            // }
        }
        return json_encode($user_arr);

    }

    // public function save()
    // {
    //     $data = json_decode(file_get_contents("php://input"));
    //     $inserteddata = isset($data->inserteddata) ? $data->inserteddata : [];
    //     $table = isset($data->table) ? $data->table : '' ;
    //    // dd(gettype($inserteddata));
    //     if ($inserteddata == '' || $table == '') {
    //         $user_arr = array(
    //             "status" => false,
    //             "success" => false,
    //             "message" => "You Provid Empty data",
    //         );
    //     }
    //     if ($inserteddata != '') {
    //         $query = DB::table($table)->insert($inserteddata)->toSql();
    //         dd($query);
    //         if ($query > 0) {
    //             $user_arr = array(
    //                 "status" => true,
    //                 "success" => true,
    //                 "message" => "Data Inserted Successfully !",
    //             );
    //         } else {
    //             $user_arr = array(
    //                 "status" => false,
    //                 "success" => false,
    //                 "message" => "Data not Inserted Successfully !",
    //             );
    //         }
    //     } else {
    //         $user_arr = array(
    //             "status" => false,
    //             "success" => false,
    //             "message" => "pramiters Are Empity",
    //         );
    //     }
    //     return json_encode($user_arr);


    // }

    public function insertData(Request $request)
    {
        dd($request->all());
        $table = $request->input('table');
        $insertedData = $request->input('insertedData');

        // Perform database insert operation using the $insertedData
        DB::table($table)->insert($insertedData);

        return response()->json(['message' => 'Data inserted successfully']);
    }
    public function update()
    {
        $data = json_decode(file_get_contents('php:://input'));
        $id = empty($data->id) ? '' : $data->id;
        $table = empty($data->table) ? '' : $data->table;
        $updeteddata = empty($data->updeteddata) ? '' : $table->updeteddata;

        if ($id == '' || $table == '' || $updeteddata == '') {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => 'You Provid Empty data',
            );
        } else {
            $query = DB::table($table)->where('Id', $id)->update([
                $updeteddata
            ]);
            if ($query > 0) {
                $user_arr = array(
                    "status" => true,
                    "success" => true,
                    "message" => 'Data Updted Successfully! ',
                );
            } else {
                $user_arr = array(
                    "status" => false,
                    "success" => false,
                    "message" => 'Data Not Updted Successfully! ',
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