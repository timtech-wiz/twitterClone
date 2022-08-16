<?php

use Illuminate\Support\Facades\Route;
 

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
 Route::get('/api/timeline', 'Api\Timeline\TimelinesController@index');

 Route::get('/notifications', 'Notifications\NotificationController@index')->name('tweet.notification');
 Route::get('/conversation/{tweet}', 'Tweets\TweetsController@show');

 Route::get('/api/notifications', 'Api\Notifications\NotificationController@index');


