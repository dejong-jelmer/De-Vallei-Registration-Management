<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => '/v1'], function(){   

    // login
    Route::post('/login', 'Api\AuthController@login');
    // status
    Route::get('/statuses', 'Api\StatusController@getStatusen');
    
    // JWT Auth middleware protected
    Route::group(['middleware' => ['jwt-auth']], function(){
        
        Route::post('/logout', 'Api\AuthController@logout');
        
        // user routes
        Route::get('/gebruikers/overzicht', 'Api\UserController@getUsers');
        Route::post('/gebruikers/aanmaken', 'Api\UserController@createUser');
        
        //coach routes
        Route::get('/coaches/overzicht', 'Api\CoachController@getCoaches');
        Route::get('/coaches/{id}', 'Api\CoachController@getCoach');
        Route::post('/coaches/aanmaken', 'Api\CoachController@createCoach');
        Route::post('/coaches/aanpassen/{id}', 'Api\CoachController@updateCoach');
        Route::delete('/coaches/verwijderen/{id}', 'Api\CoachController@delete');
        
        // coach group routes
        Route::get('/coachgroepen', 'Api\CoachGroupController@getCoachGroups');
        Route::get('/coachgroep/{id}', 'Api\CoachGroupController@getCoachGroup');
        
        // student routes
        Route::get('/leerlingen/overzicht', 'Api\StudentController@getStudents');
        Route::get('/leerlingen/status', 'Api\StudentController@getStudentStatuses');
        Route::get('/leerlingen/status/{id}', 'Api\StudentController@getStudentStatus');
        Route::post('/leerlingen/aanmaken', 'Api\StudentController@createStudent');
        Route::post('/leerlingen/aanpassen/{id}', 'Api\StudentController@updateStudent');
        Route::delete('/leerlingen/verwijderen/{id}', 'Api\StudentController@deleteStudent');

        // attendance routes
        Route::post('leerlingen/updatestatus/{studentId}/{statusId}', 'Api\AttendanceController@updateStudentAttendance');

        Route::get('/status/{id}', 'Api\StatusController@getStatus');

    }); 
});



