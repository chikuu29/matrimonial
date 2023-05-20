<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;
class loginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function adminLogin(){

         $data = json_decode(file_get_contents("php://input"));

         $user = $data->userId;
         $password= $data->password;
        // $payload = auth()->payload();
         
        try{

        
        $logindata = DB::table('Admin')->where('UserId',$user)->get();
        $result = DB::table('Admin')->where('UserId',$user)->get(['Id','name','UserId']);
        if(count($logindata)>0 ){
            if($password == $logindata[0]->Password){
                $state = 200;
                $msg = 'login successfully';
                $result = $result;
            }else{
                $state = 400;
                $msg = 'Password not match';
                $result = [];
            }
        }else{
            $state = 400;
            $msg = 'Userid not match';
            $result = $logindata;
        } 
    }catch(Exception  $e){
            $state = 500;
            $msg = 'Something Wrong Happened';
            $result = $logindata;
    }

        return array('status'=>$state , 'masssage' => $msg ,'result' => $result);
    }
}
