<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class dynaController extends Controller
{
    public function dynaQuay()
    {
        $data = json_decode(file_get_contents("php://input"));
        $query = $data->query;
        $match = array("CREATE", "DROP", "UPDATE", "DELETE", 'INSERT', 'TRUNCATE', 'ALTER');
        $pattern = '/\b(' . implode('|', $match) . ')\b/i';
        $found = preg_match($pattern, $query);
        if ($found) {
            $user_arr = array(
                "status" => false,
                "success" => false,
                "message" => "We Accept Only Select Query",
            );
        } else {
        try {
                $dataoftable = DB::select($query);
                if (count($dataoftable) > 0) {
                    $user_arr = array(
                        "status" => true,
                        "success" => true,
                        "message" => (object) $dataoftable,
                    );
                } else {
                    $user_arr = array(
                        "status" => false,
                        "success" => false,
                        "message" => (object) [],
                    );
                }
            } catch (Expeption $e) {
                $user_arr = array(
                    "status" => false,
                    "success" => false,
                    "message" => (object)$e,
                );
            }
        }
        return json_encode($user_arr);
    }
}