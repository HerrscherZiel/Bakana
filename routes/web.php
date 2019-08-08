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

//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/sendMail','HomeController@index');



Route::group(['middleware' => ['auth']], function() {
    // your routes

    Route::get('change/pass', 'Auth\PasswordController@change')->name('password.change');
    Route::put('change/pass', 'Auth\PasswordController@update')->name('password.updates');

    Route::resources([

        'projects'      => 'ProjectController',
        'roles'         => 'RoleController',
        'users'         => 'UserController',
        'timesheets'    => 'TimesheetController',
        'teamprojects'  => 'TeamProjectController',
        'modules'       => 'ModuleController',
        'jobs'          => 'JobController',
        'userInfo'      => 'UserInfoController',
        /*'timelines'     => 'TimelineController',*/

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

//
//    Route::post('/team/creates/{project}/project','TeamProjectController@storeFromShow');
//
//    Route::post('/team/creates/{project}/project','TeamProjectController@storeFromShow');
//


    Route::post('/team/creates/{project}','TeamProjectController@storeFromShow');

    Route::post('/team/{project}','TeamProjectController@storeFromShow');



    Route::get('/team/{project}','TeamProjectController@indexes');

    Route::get('/team/{project}/edit','TeamProjectController@editTeamProject');

    Route::put('/team/{project}','TeamProjectController@updateTeamProject');

    Route::get('/disbandedTeam','TeamProjectController@disbandedTeam');


// Module

    Route::get('/module/{module}','ModuleController@indexes');

    Route::get('/module/creates/{project}','ModuleController@creates');

    Route::post('/module/creates/{project}','ModuleController@stores');

    Route::post('/module/{project}','ModuleController@stores');

    Route::get('/completedModule','ModuleController@completedModule');

    Route::get('/module/{project}/edit','ModuleController@editShowProject');

    Route::put('/module/{project}','ModuleController@updates');

    Route::match(array('PUT', 'PATCH'), "/module/{projects}", array(
        'uses' => 'ModuleController@updates',
        'as' => 'module.updates'
    ));


// Jobs

    Route::post('/jobs/create','JobController@store');

    Route::get('/jobs/creates/{module}','JobController@createFromModule');

    Route::post('/jobs/creates/{module}','JobController@storeFromModule');

    Route::post('/jobs/{module}','JobController@storeFromModule');

    Route::get('/completedJob','JobController@completedJob');

    Route::get('/job/{project}/edit','JobController@editShowModule');

    Route::match(array('PUT', 'PATCH'), "/job/{modules}", array(
        'uses' => 'JobController@updateShowModule',
        'as' => 'job.update'
    ));


// Timesheets

    Route::get('/timesheetss','TimesheetController@UserTimesheets');


    Route::get('/timesheetsAjax','TimesheetController@test')->name('timesheets.test');
    Route::post('/timesheetsAjax/update', 'TimesheetController@upAjax')->name('timesheetsAjax.update');
    Route::get('/timesheetsAjax/destroy/{id}', 'TimesheetController@destroyAjax')->name('timesheetsAjax.destroy');
    Route::get('/timesheetsAjax/{id_timesheets}/edit', 'TimesheetController@editAjax')->name('timesheetsAjax.edit');



// User Info

    Route::get('/userInfo','UserInfoController@index');

    Route::get('/userInfo/module/{module}','UserInfoController@moduleUser');

    Route::get('/myCompletedProject','UserInfoController@completedProjectUser');


//Timeline

//    Route::get('/home', 'HomeController@index')->name('home');


    Route::get('/timelines','TimelineController@index')->name('timelines');

    Route::get('/timelines/project','TimelineController@indexProject');

    Route::get('/timelines/job','TimelineController@indexJob');

    Route::get('/timelines/project/{project}','TimelineController@indexJob');

    Route::get('/timelines/job/{module}','TimelineController@dropJob');

    Route::get('/timelines/{project}','TimelineController@dropProject');


    //Mail



});


Route::group(['prefix'=>'errors','as'=>'error.'], function(){
    Route::get('419', ['as' => 'err400', 'uses' => 'ErrorsController@err400']);
    Route::get('403', ['as' => 'err403', 'uses' => 'ErrorsController@index']);
    Route::get('404', ['as' => 'err404', 'uses' => 'ErrorsController@err404']);
    Route::get('419', ['as' => 'err419', 'uses' => 'ErrorsController@err419']);
    Route::get('500', ['as' => 'err500', 'uses' => 'ErrorsController@err500']);

    // Route::get('connect', ['as' => 'connect', 'uses' => 'AccountController@connect']);
});



Route::get('/{any}','HomeController@error404');


//Route::resources([
//
//    'projects'      => 'ProjectController',
//    'roles'         => 'RoleController',
//    'users'         => 'UserController',
//    'timesheets'    => 'TimesheetController',
//    'teamprojects'  => 'TeamProjectController',
//    'modules'       => 'ModuleController',
//    'jobs'          => 'JobController',
//    'userInfo'      => 'UserInfoController',
//    /*'timelines'     => 'TimelineController',*/
//
//
//]);
//
//
//
//Route::post('/projects/create','ProjectController@store');
//
//Route::post('/roles/create','RoleController@store');
//
//Route::post('/users/create','UserController@store');
//
//Route::post('/timesheets/create','TimesheetController@store');
//
//Route::post('/teamprojects/create','TeamProjectController@store');
//
//Route::post('/modules/create','ModuleController@store');
//Route::get('/back','ProjectController@back');
//
//
//// Completed Project
//
//Route::get('/completedProject','ProjectController@completedProject');
//
//
//
//
//// Team Project
//
//Route::get('/team/creates/{project}','TeamProjectController@creates');
//
//Route::get('/team/creates/{project}/project','TeamProjectController@stores');
//
//Route::post('/team/creates/{project}/project','TeamProjectController@stores');
//
//Route::get('/team/{project}','TeamProjectController@indexes');
//
//Route::get('/team/{project}/edit','TeamProjectController@editTeamProject');
//
//Route::put('/team/{project}','TeamProjectController@updateTeamProject');
//
//Route::get('/disbandedTeam','TeamProjectController@disbandedTeam');
//
//
//// Module
//
//Route::get('/module/{module}','ModuleController@indexes');
//
//Route::get('/module/creates/{project}','ModuleController@creates');
//
//Route::post('/module/creates/{project}','ModuleController@stores');
//
//Route::post('/module/{project}','ModuleController@stores');
//
//Route::get('/completedModule','ModuleController@completedModule');
//
//Route::get('/module/{project}/edit','ModuleController@editShowProject');
//
//Route::put('/module/{project}','ModuleController@updates');
//
//Route::match(array('PUT', 'PATCH'), "/module/{projects}", array(
//    'uses' => 'ModuleController@updates',
//    'as' => 'module.updates'
//));
//
//
//// Jobs
//
//Route::post('/jobs/create','JobController@store');
//
//Route::get('/jobs/creates/{module}','JobController@createFromModule');
//
//Route::post('/jobs/creates/{module}','JobController@storeFromModule');
//
//Route::post('/jobs/{module}','JobController@storeFromModule');
//
//Route::get('/completedJob','JobController@completedJob');
//
//Route::get('/job/{project}/edit','JobController@editShowModule');
//
//Route::match(array('PUT', 'PATCH'), "/job/{modules}", array(
//    'uses' => 'JobController@updateShowModule',
//    'as' => 'job.update'
//));
//
//
//// Timesheets
//
//Route::get('/timesheetss','TimesheetController@UserTimesheets');
//
//
//// User Info
//
//Route::get('/userInfo','UserInfoController@index');
//
//Route::get('/userInfo/module/{module}','UserInfoController@moduleUser');
//
//Route::get('/myCompletedProject','UserInfoController@completedProjectUser');
//
//
////Timeline
//
//Route::get('/timelines','TimelineController@index');
//
//Route::get('/timelines/project','TimelineController@indexProject');
//
//Route::get('/timelines/job','TimelineController@indexJob');
//
//Route::post('/timelines/{project}','TimelineController@dropProject');


//Route::get('500', function()
//{
//    abort(500);
//});

//Route::get('/{any}','ErrorsController@err404');

//Route::get('419', function()
//{
//    abort(419);
//});
//
//Route::get('500', function()
//{
//    abort(500);
//});

