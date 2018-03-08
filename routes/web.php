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

    Route::get('/home', 'Web\HomeController@getHome');

    Route::get('/status', 'Web\StatusController@getStatus');

    Route::get('/leerlingen/gegevens', 'Web\LeerlingController@getUpdate');
    Route::get('/leerlingen/aanmaken', 'Web\LeerlingController@getCreate');
    Route::post('/leerlingen/aanmaken', 'Web\LeerlingController@createStudentData');
    Route::post('/leerling/zoeken', 'Web\LeerlingController@searchStudent');
    Route::post('/leerlingen/zoeken', 'Web\LeerlingController@searchStudents');
    Route::post('/leerling/{id}/aanpassen', 'Web\LeerlingController@updateStudentData');

    Route::get('/aanwezigheid', 'Web\AanwezigheidsController@getIndex');
    Route::post('/aanwezigheid', 'Web\AanwezigheidsController@getStudentAanwezigheid');
});



