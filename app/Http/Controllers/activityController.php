<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class activityController extends Controller
{
    public function getLoginCount(){
        $data = DB::table('login_activity')->select('user_id', DB::raw("count(*) as count"))->groupBy('user_id')->get();
        if(count($data) > 0){
            $user_arr = array(
                "status" => true,
                "success" => true,
                "data" => $data,
                "message" => count($data) . ' records Match'
            );
        }else{
            $user_arr = array(
                "status" => false,
                "success" => false,
                "data" => [],
                "message" => 0 . ' records Match'
            );
        }
        return json_encode($user_arr);
    }
}
