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
    'modules' => 'ModuleController',
    'jobs' => 'JobController',


]);

Route::post('/projects/create','ProjectController@store');

Route::post('/roles/create','RoleController@store');

Route::post('/users/create','UserController@store');

Route::post('/timesheets/create','TimesheetController@store');

Route::post('/modules/create','ModuleController@store');

Route::post('/jobs/create','JobController@store');


