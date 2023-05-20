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

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: POST,GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type , Access-Control-Allow-Method , Authorization , X-Requested-with');
header('Content-Type: application/json');


$router->post('adminLogin','loginController@adminLogin');
