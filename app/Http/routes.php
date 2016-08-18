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

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', function () {
        return view('auth/login');
    });
});

Route::auth();

Route::group(['middleware' => 'auth'], function () {

    Route::resource('/home', 'HomeController');
    Route::get('/history', 'HomeController@history');
    Route::get('/history/{history}', 'HomeController@historyShow');
    Route::get('/reallocate/{reallocate}', 'HomeController@reallocateTicket');

    Route::get('/reports/car-count', 'ReportsController@carCount');
    Route::resource('/reports', 'ReportsController');

    Route::resource('/pre-booking', 'PreBookController');
    Route::get('/issue/{booking}', 'PreBookController@issueTicket');

    Route::any('/search-reg', function (){
        $reg = $_POST['searchreg'];
        return \App\Tracking::where('ticket_status', 'active')->Where('ticket_registration', 'LIKE', '%'.$reg.'%')
            ->orderBy('created_at', 'desc')->get();
    });

});

Route::get('/all-tickets', function () {
    return ['data' => \App\Tracking::where('id','!=','1')->get()];
});