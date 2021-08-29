<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'admin','middleware' => ['web']],function(){
    Route::get('/','Api\AdminController@dashboard')->name('admin.dashboard');
    Route::get('/file','Api\AdminController@file')->name('admin.file');
    Route::resources([
        'teacher'=>'Api\TeacherController',
        'criteria'=>'Api\CriteriaController',
        'major'=>'Api\MajorController',
        'account'=> 'AccountController',
        'user'=>'Api\UserController',
        'bhxh'=>'Api\BhxhController',
        'salary'=>'Api\SalaryController',
        'salary_level'=>'Api\SalaryLevelController',
    ]);
    
});