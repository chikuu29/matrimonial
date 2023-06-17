<?php
// header('Access-Control-Allow-Origin: *');

// header("Access-Control-Allow-Headers:http://localhost:4200/");
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

$router->post("/adminLogin","loginController@adminLogin");
$router->post("/addUserDataFirstApi","userController@addUserDataFirstApi");
$router->post("/addUserDataSecondApi","userController@addUserDataSecondApi");
$router->post("/socialMediaLink","addItemControler@socialMediaLink");
$router->post("/getsocialMediaLink","addItemControler@getsocialMediaLink");
$router->post("/country","addItemControler@country");
$router->post("/state","addItemControler@state");
$router->post("/fetch","dynamic_Crud_controller@fetch");
$router->post("/save","dynamic_Crud_controller@save");
$router->post("/update","dynamic_Crud_controller@update");
$router->post("/insertData","dynamic_Crud_controller@insertData");
$router->post("/auth","loginController@userLogin");
$router->post("/getprofile","userController@fatchAllaDataByUserId");
$router->post("/zodiacs","addItemControler@zodiacs");
$router->post("/nakshatra","addItemControler@nakshatra");
$router->post("/upload","userController@uploadImage");
$router->post("/annual_income","addItemControler@annual_income");
$router->post("/memberpaln","memberController@memberpaln");
$router->post("/getAllData","memberController@getAllData");













