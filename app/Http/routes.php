<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::auth();

Route::resource('/home', 'HomeController');
Route::get('/history', 'HomeController@history');
Route::get('/history/{history}', 'HomeController@historyShow');
Route::get('/reallocate/{reallocate}', 'HomeController@reallocateTicket');
Route::resource('/reports', 'ReportsController');

Route::get('/all-tickets', function () {
    return ['data' => \App\Tracking::where('id','!=','1')->get()];
});
