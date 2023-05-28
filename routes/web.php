<?php
header('X-Frame-Options: *');
header('Access-Control-Allow-Origin: *');
 //@var \Laravel\Lumen\Routing\Router $router;


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
// if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
//     header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
//     header("Access-Control-Allow-Headers: Authorization, Content-Type,Accept, Origin");
//     header("HTTP/1.1 200");
//     exit(0);
// }
$router->post("/adminLogin","loginController@adminLogin");



