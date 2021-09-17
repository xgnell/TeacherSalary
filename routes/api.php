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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/', function () {
//     return view('user.index');
// }); 


Route::group(['middleware' => ['teacher']],function(){
    Route::get('/','Api\HomeController@index')->name('home');
    Route::get('/contact','Api\Homecontroller@contact')->name('contact');
    Route::get('/mysalary','Api\Homecontroller@mysalary')->name('mysalary');
    Route::get('/staff','Api\Homecontroller@staff')->name('staff');
    Route::post('/change-password','Api\Homecontroller@change')->name('home.change');
});


Route::get('/home-login','Api\HomeController@login')->name('home.login');
Route::post('/home-login','Api\HomeController@post_login')->name('home.login');
Route::get('/home-logout','Api\HomeController@logout')->name('home.logout');
// 
Route::group(['prefix' => 'admin','middleware' => ['auth']],function(){
    Route::get('/','Api\AdminController@dashboard')->name('admin.dashboard');
    Route::get('/file','Api\AdminController@file')->name('admin.file');
    Route::resources([
        'teacher'=>'Api\TeacherController',
        'kpi'=>'Api\KpiController',
        'history_kpi' => 'Api\HistoryKpiController',
        'major'=>'Api\MajorController',
        'account'=> 'Api\AccountController',
        'admin'=>'Api\UserController',
        'insurance'=>'Api\InsuranceController',
        'insurance_period' => 'Api\InsurancePeriodController',
        'teacher_insurance' => 'Api\TeacherInsuranceController',
        'salary'=>'Api\SalaryController',
        'salary_level'=>'Api\SalaryLevelController',
    ]);
    Route::post('/salary_create','Api\SalaryController@add')->name('salary.add');
    Route::get('/salary_filter/{slug}','Api\SalaryController@filter')->name('salary.filter');
    Route::post('/salary_edit','Api\SalaryController@editt')->name('salary.editt');
    Route::post('/salary_update','Api\SalaryController@updated')->name('salary.updated');


    Route::get('/history_salary','Api\HistorySalaryController@create')->name('history_salary.create');
    Route::post('/history_salary/store','Api\HistorySalaryController@store')->name('history_salary.store');
    Route::get('/history_filter/{slug}','Api\HistorySalaryController@filter')->name('history_salary.filter');
    Route::post('/history_add','Api\HistorySalaryController@add')->name('history_salary.add');
    Route::get('/history_index','Api\HistorySalaryController@index')->name('history_salary.index');
    
    // kpi
    // Route::get('/kpi/{id}','Api\KpiController@view')->name('kpi');
    // Route::get('/kpi/edit/{id}','Api\KpiController@edit')->name('kpi.edit');
    // Route::post('/kpi/add','Api\KpiController@add')->name('kpi.add');
    // Route::post('/kpi/update/{id}','Api\KpiController@update')->name('kpi.update');
});


Route::get('admin/login','Api\AdminController@login')->name('login');
Route::post('admin/login','Api\AdminController@post_login')->name('login');
Route::get('admin/logout','AdminController@logout')->name('logout');




