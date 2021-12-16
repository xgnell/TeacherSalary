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


// Giảng viên đăng nhập - đăng xuất
Route::get('/login', 'Api\HomeController@login')->name('home.login');
Route::post('/login', 'Api\HomeController@post_login')->name('home.login');
Route::get('/logout', 'Api\HomeController@logout')->name('home.logout');

// Giảng viên
Route::group(['middleware' => ['teacher']], function() {
    Route::get('/', 'Api\HomeController@index')->name('home');
    Route::get('/contact', 'Api\Homecontroller@contact')->name('contact');
    Route::get('/mysalary', 'Api\Homecontroller@mysalary')->name('mysalary');
    Route::get('/staff', 'Api\Homecontroller@staff')->name('staff');
    Route::post('/change-password', 'Api\Homecontroller@change')->name('home.change');
    Route::post('/post_contact', 'Api\Homecontroller@post_contact')->name('home.contact');
    Route::get('/history', 'Api\Homecontroller@history')->name('home.history');
    Route::post('/detail_kpi', 'Api\Homecontroller@detail_kpi')->name('home.detail');
});


// Admin đăng nhập - đăng xuất
Route::group(['prefix' => 'admin'], function() {
    Route::get('/login', 'Api\AdminController@login')->name('login');
    Route::post('/login', 'Api\AdminController@post_login')->name('login');
    Route::get('/logout', 'API\AdminController@logout')->name('logout');
});

// Admin
Route::group(['prefix' => 'admin','middleware' => ['auth']], function() {
    Route::get('/','Api\AdminController@dashboard')->name('admin.dashboard');
    Route::get('/file','Api\AdminController@file')->name('admin.file');

    Route::resources([
        'teacher'           =>  'Api\TeacherController',
        'kpi'               =>  'Api\KpiController',
        'major'             =>  'Api\MajorController',
        'account'           =>  'Api\AccountController',
        'admin'             =>  'Api\UserController',
        'insurance'         =>  'Api\InsuranceController',
        'insurance_period'  =>  'Api\InsurancePeriodController',
        'teacher_insurance' =>  'Api\TeacherInsuranceController',
        'salary'            =>  'Api\SalaryController',
        'salary_level'      =>  'Api\SalaryLevelController',
    ]);
    
    // Salary
    Route::post('/salary_create','Api\SalaryController@add')->name('salary.add');
    Route::get('/salary_filter/{slug}','Api\SalaryController@filter')->name('salary.filter');
    Route::post('/salary_edit','Api\SalaryController@editt')->name('salary.editt');
    Route::post('/salary_update','Api\SalaryController@updated')->name('salary.updated');

    // History salary
    Route::get('/history_salary','Api\HistorySalaryController@create')->name('history_salary.create');
    Route::post('/history_salary/store','Api\HistorySalaryController@store')->name('history_salary.store');
    Route::post('/history_salary/edit','Api\HistorySalaryController@edit')->name('history_salary.edit');
    Route::post('/history_salary/update','Api\HistorySalaryController@update')->name('history_salary.update');
    Route::get('/history_filter/{slug}','Api\HistorySalaryController@filter')->name('history_salary.filter');
    Route::post('/history_add','Api\HistorySalaryController@add')->name('history_salary.add');
    Route::get('/history_index','Api\HistorySalaryController@index')->name('history_salary.index');
    Route::get('/history_salary/show_by_month', 'Api\HistorySalaryController@show_by_month')->name('history_salary.show_by_month');
    Route::post('/history_salary/paid', 'Api\HistorySalaryController@paid')->name('history_salary.paid');
    Route::get('/history_salary/showPaid', 'Api\HistorySalaryController@showPaid')->name('history_salary.showPaid');
    
    
    Route::get('/export', 'Api\TeacherController@export')->name('export');
    Route::get('/kpi_highest', 'Api\AdminController@kpi_highest')->name('admin.highest');
});


Route::get('/history_kpi/show_by_month', 'Api\HistoryKpiController@show_by_month')->name('history_kpi.show_by_month');
Route::resource('history_kpi', 'Api\HistoryKpiController')->except([
    'show',
]);

Route::get('/history_teaching_hours/show_by_month', 'Api\HistoryTeachingHoursController@show_by_month')->name('history_teaching_hours.show_by_month');
Route::resource('history_teaching_hours', 'Api\HistoryTeachingHoursController')->except([
    'show',
]);








