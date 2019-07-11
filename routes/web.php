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
    return view('welcome');
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


]);

Route::post('/projects/create','ProjectController@store');

Route::post('/roles/create','RoleController@store');

Route::post('/users/create','UserController@store');

Route::post('/timesheets/create','TimesheetController@store');

Route::post('/teamprojects/create','TeamProjectController@store');

Route::post('/modules/create','ModuleController@store');

Route::get('/module/creates/{project}','ModuleController@creates');

Route::get('/module/creates/{project}/project','ModuleController@stores');

Route::post('/module/creates/{project}/project','ModuleController@stores');

Route::post('/jobs/create','JobController@store');


Route::group(['prefix'=>'errors','as'=>'error.'], function(){
    Route::get('403', ['as' => 'err403', 'uses' => 'ErrorsController@index']);
   // Route::get('connect', ['as' => 'connect', 'uses' => 'AccountController@connect']);
});

