<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Method: POST,GET,OPTIONS');
// header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type , Access-Control-Allow-Method , Authorization , X-Requested-with');
// header('Content-Type: application/json');

$http_origin = $_SERVER['HTTP_ORIGIN'];
$allowed_domains = array(
    'http://localhost:4200'

);

if (in_array(strtolower($http_origin), $allowed_domains)) {

    header("Access-Control-Allow-Origin: $http_origin");
    header('Access-Control-Allow-Method: POST,GET,OPTIONS');
    header('Content-Type: application/json');
    // header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type , Access-Control-Allow-Method , Authorization , X-Requested-with');
}
if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Authorization, Content-Type,Accept, Origin");
    header("HTTP/1.1 200");
    exit(0);
}


$router->post('adminLogin','loginController@adminLogin');
