<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\addItemController; // Ensure you import the controller at the top




// header("Access-Control-Allow-Headers:http://localhost:4200/");





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



Route::group(['middleware' => 'jwt.auth'], function () {

    Route::post('/annual_income', 'addItemControler@annual_income');
    Route::post("/fetch", "dynamic_Crud_controller@fetch");
    Route::post("/save", "dynamic_Crud_controller@save");
    Route::post("/delete", "dynamic_Crud_controller@delete");
    Route::post("/update", "dynamic_Crud_controller@update");
    Route::post("/getDataFormQuery", "dynaController@dynaQuay");
    Route::post("/makeActinForMultipulData", "dynamic_Crud_controller@makeActinForMultipulData");

    Route::post("/insertData", "dynamic_Crud_controller@insertData");
    Route::post("/getprofile", "userController@fatchAllaDataByUserId");
    Route::post("/zodiacs", "addItemControler@zodiacs");
    Route::post("/nakshatra", "addItemControler@nakshatra");
    Route::post("/upload", "userController@uploadImage");
    Route::post("/memberpaln", "memberController@memberpaln");
    Route::post("/getAllData", "memberController@getAllData");
    Route::post("/privacypolicy", "addItemControler@privacypolicy");
    Route::post("/contactus", "addItemControler@contactus");
    Route::post("/termandcondition", "addItemControler@termandcondition");
    Route::post("/aboutus", "addItemControler@aboutus");
    Route::post("/userActivation", "userController@userActivation");
    Route::post("/profileValidation", "userController@profileValidation");
    Route::post("/getDataFormQuery", "dynaController@dynaQuay");
    Route::post("/matches", "filterController@matches");
    Route::post("/matchesforindivisual", "filterController@matchesforindivisual");
    Route::post("/matchPersent", "filterController@matchPersent");
    Route::post("/getplandata", "filterController@getplandata");
    Route::post("/getUserPlan", "memberController@getMembersheepPlan");
    Route::post("/callCalculation", "planCalculationController@callCalculation");
    Route::post("/sendMessageCalculation", "planCalculationController@sendMessageCalculation");
    Route::post("/horscopeCalculation", "planCalculationController@horscopeCalculation");
    Route::post("/contactViewOtherCalculation", "planCalculationController@contactViewOtherCalculation");
    Route::post("/logoUplode", "uplodeController@logoUplode");
    Route::post("/homeLogoUplode", "uplodeController@homeLogoUplode");
    Route::post("/bannerUplode", "uplodeController@bannerUplode");
    Route::post("/cast_matches", "filterController@matchByCast");
    Route::post("/premium_matches", "filterController@premimusMatches");
    Route::post("/getLoginCount", "activityController@getLoginCount");
    Route::post("/getLikeCount", "activityController@getLikeCount");
    Route::post("/secondPass", "forgetPasswordController@secondPass");
    Route::post("/firstPass", "forgetPasswordController@firstPass");
    Route::post("/passwordresetbyadmin", "forgetPasswordController@passwordresetbyadmin");
    Route::post("/updateEditedPlanDetails", "memberController@updateEditedPlanDetails");
    Route::post("/getUserBlockList", "activityController@getUserBlockList");
    Route::post("/waterMark", "uplodeController@waterMark");
    Route::post("/barCode", "uplodeController@barCode");
    Route::post("/profileView", "planCalculationController@profileView");
    Route::post("/sendEmail", "mailcontroller@sendEmail");
    Route::post("/getAllDataById", "userController@getAllDataById");
    Route::post("/filterData", "filterController@filterData");
    Route::post("/sendData", "mailcontroller@sendData");
    Route::post("/successStory", "successStoryConlroller@successStory");
});
Route::get("/setting", "AppController@settings");

Route::post("/adminLogin", "AuthController@adminLogin");
Route::post("/auth", "AuthController@userLogin");
Route::post("/addUserDataFirstApi", "userController@addUserDataFirstApi");
Route::post("/addUserDataSecondApi", "userController@addUserDataSecondApi");
