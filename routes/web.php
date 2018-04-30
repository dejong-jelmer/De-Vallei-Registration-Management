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

Route::get('/', 'Web\LoginController@index')
    ->middleware('guest')
    ->name('login');

Route::post('/login', 'Web\LoginController@login')
    ->name('login.user');

Route::middleware(['auth'])->group(function() {

    Route::get('/logout', 'Web\LoginController@logout')
        ->name('logout');

    Route::get('/dashboard', 'Web\DashboardController@index')
        ->name('dashboard');

    Route::get('/account', 'Web\AccountController@index')
        ->name('account');
    Route::post('/account/aanmaken', 'Web\AccountController@create')
        ->name('account.create');
    Route::post('/account/versturen/{id}', 'Web\AccountController@sendAccountDetails')
        ->name('account.send');


    Route::get('/status', 'Web\StatusController@index')
        ->name('status');

    Route::post('/status/aanmaken', 'Web\StatusController@create')
        ->name('status.create');

    Route::post('/status/aanpassen/{id}', 'Web\StatusController@update')->
        name('status.update');

    Route::get('/leerlingen/aanmaken', 'Web\StudentController@indexCreate')
        ->name('leerlingen.index.create');
    Route::get('/leerlingen/gegevens', 'Web\StudentController@indexUpdate')
        ->name('leerlingen.index.update');
    Route::get('/leerling/{id}', 'Web\StudentController@show')
        ->name('leerlingen.show');
    Route::get('/leerling/', function(){ return back(); });


    Route::post('/leerlingen/zoeken', 'Web\StudentController@search')
        ->name('leerlingen.search');
    Route::post('/leerlingen/aanmaken', 'Web\StudentController@create')
        ->name('leerlingen.create');
    Route::post('/leerling/{id}/aanpassen', 'Web\StudentController@update')
        ->name('leerlingen.update');
    Route::post('/leerling/{id}/verwijderen', 'Web\StudentController@destroy')
        ->name('leerlingen.destroy');
    
    Route::get('/leerlingen/status', 'Web\StudentController@getStatus')
        ->name('leerlingen.status');
    Route::post('/leerling/{studentId}/status/{statusId}', 'Web\StudentController@updateStatus')
        ->name('leerlingen.status.update');
    Route::post('/leerlingen/statuses/', 'Web\StudentController@updateStatuses')
        ->name('leerlingen.statuses.update');

    Route::get('/aanwezigheid', 'Web\AttendanceController@index')
        ->name('aanwezigheid.index');
    Route::post('/aanwezigheid', 'Web\AttendanceController@getStudentAanwezigheid')
        ->name('aanwezigheid.leerling');

    Route::get('/coaches/gegevens', 'Web\CoachController@indexUpdate')
        ->name('coaches.index.create');
    Route::get('/coaches/aanmaken', 'Web\CoachController@indexCreate')
        ->name('coaches.index.update');
    Route::get('/coach/{id}', 'Web\CoachController@show')
        ->name('coaches.show');
    Route::get('/coach/', function(){ return back(); });
    
    
    Route::post('/coaches/aanmaken', 'Web\CoachController@create')
        ->name('coaches.create');
    Route::post('/coach/{id}/aanpassen', 'Web\CoachController@update')
        ->name('coaches.update');
    Route::post('/coach/{id}/verwijderen', 'Web\CoachController@destroy')
        ->name('coaches.destroy');

    Route::get('/coaches/status', 'Web\CoachController@getStatus')
        ->name('coaches.status');
    Route::post('/coach/{coachId}/status/{statusId}', 'Web\CoachController@updateStatus')
        ->name('coaches.status.update');
    Route::post('/coaches/statuses/', 'Web\CoachController@updateStatuses')
        ->name('coaches.statuses.update');

    Route::get('leerlingen/importeren', 'Web\ImportController@index')
        ->name('leerlingen.import');

    Route::post('leerlingen/lijsten/uploaden', 'Web\ImportController@import')
        ->name('leerlingen.import.upload');


});



