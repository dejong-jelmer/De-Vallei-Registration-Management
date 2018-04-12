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

Route::get('/', ['uses' => 'Web\AuthController@getLogin', 'middleware' => 'guest', 'as' => 'login']);

Route::post('/login', 'Web\AuthController@login');

Route::group(['middleware' => 'auth'], function() {

    Route::get('/logout', 'Web\AuthController@logout');

    Route::get('/home', 'Web\DashboardController@getDashboard');

    Route::get('/account', 'Web\AccountController@getAccount');

    Route::get('/status', 'Web\StatusController@getStatus');
    Route::post('/status/aanmaken', 'Web\StatusController@createStatus');
    Route::post('/status/aanpassen/{id}', 'Web\StatusController@updateStatus');

    Route::get('/leerlingen/gegevens', 'Web\StudentController@getUpdate');
    Route::get('/leerlingen/aanmaken', 'Web\StudentController@getCreate');
    Route::get('/leerling/{id}', 'Web\StudentController@getStudent');
    Route::get('/leerling/', function(){ return back(); });


    Route::post('/leerlingen/zoeken', 'Web\StudentController@searchStudents');
    Route::post('/leerlingen/aanmaken', 'Web\StudentController@createStudent');
    Route::post('/leerling/{id}/aanpassen', 'Web\StudentController@updateStudent');
    Route::post('/leerling/{id}/verwijderen', 'Web\StudentController@deleteStudent');
    
    Route::get('/leerlingen/status', 'Web\StudentController@getStatus');
    Route::post('/leerling/{studentId}/status/{statusId}', 'Web\StudentController@updateStatus');
    Route::post('/leerlingen/statuses/', 'Web\StudentController@updateStatuses');

    Route::get('/aanwezigheid', 'Web\AttendanceController@getIndex');
    Route::post('/aanwezigheid', 'Web\AttendanceController@getStudentAanwezigheid');

    Route::get('/coaches/gegevens', 'Web\CoachController@getUpdate');
    Route::get('/coaches/aanmaken', 'Web\CoachController@getCreate');
    Route::get('/coach/{id}', 'Web\CoachController@getCoach');
    Route::get('/coach/', function(){ return back(); });
    
    
    Route::post('/coaches/aanmaken', 'Web\CoachController@createCoach');
    Route::post('/coach/{id}/aanpassen', 'Web\CoachController@updateCoach');
    Route::post('/coach/{id}/verwijderen', 'Web\CoachController@deleteCoach');

    Route::get('/coaches/status', 'Web\CoachController@getStatus');
    Route::post('/coach/{coachId}/status/{statusId}', 'Web\CoachController@updateStatus');
    Route::post('/coaches/statuses/', 'Web\CoachController@updateStatuses');


});



