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

    Route::get('/export/leerlingen/{type}/{export}', 'Web\ExportController@exportStudents');
    Route::post('/import/leerlingen', 'Web\ImportController@importExcel');

    Route::get('/logout', 'Web\AuthController@logout');

    Route::get('/home', 'Web\HomeController@getHome');
    Route::post('/zoeken', 'Web\SearchController@searchStudents');
    Route::post('/zoeken/{id}', 'Web\SearchController@searchStudent');

    Route::get('/status', 'Web\StatusController@getStatus');

    Route::get('/aanwezigheid', 'Web\AanwezigheidsController@getIndex');
    Route::post('/aanwezigheid', 'Web\AanwezigheidsController@getStudentAanwezigheid');
});



