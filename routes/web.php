<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resources([

    'projects' => 'ProjectController',
    'roles' => 'RoleController',
    'users' => 'UserController',
    'timesheets' => 'TimesheetController',
    'teamprojects' => 'TeamProjectController',
    'modules' => 'ModuleController',
    'jobs' => 'JobController',
    'userInfo' => 'UserInfoController',


]);

Route::post('/projects/create','ProjectController@store');

Route::post('/roles/create','RoleController@store');

Route::post('/users/create','UserController@store');

Route::post('/timesheets/create','TimesheetController@store');

Route::post('/teamprojects/create','TeamProjectController@store');

Route::post('/modules/create','ModuleController@store');
Route::get('/back','ProjectController@back');


// Completed Project

Route::get('/completedProject','ProjectController@completedProject');




// Team Project

Route::get('/team/creates/{project}','TeamProjectController@creates');

Route::get('/team/creates/{project}/project','TeamProjectController@stores');

Route::post('/team/creates/{project}/project','TeamProjectController@stores');

Route::get('/team/{project}','TeamProjectController@indexes');

Route::get('/team/{project}/edit','TeamProjectController@editTeamProject');

Route::put('/team/{project}','TeamProjectController@updateTeamProject');

// Module

Route::get('/module/{module}','ModuleController@indexes');

Route::get('/module/creates/{project}','ModuleController@creates');

Route::get('/module/creates/{project}/project','ModuleController@stores');

Route::post('/module/creates/{project}/project','ModuleController@stores');

// Jobs

Route::post('/jobs/create','JobController@store');

Route::get('/jobs/creates/{module}','JobController@createFromModule');

Route::get('/jobs/creates/{module}/module','JobController@store');

Route::post('/jobs/creates/{module}/module','JobController@store');


// Timesheets

Route::get('/timesheetss','TimesheetController@UserTimesheets');


// User Info

Route::get('/userInfo','UserInfoController@index');

Route::get('/userInfo/module/{module}','UserInfoController@moduleUser');





Route::group(['prefix'=>'errors','as'=>'error.'], function(){
    Route::get('403', ['as' => 'err403', 'uses' => 'ErrorsController@index']);
   // Route::get('connect', ['as' => 'connect', 'uses' => 'AccountController@connect']);
});

