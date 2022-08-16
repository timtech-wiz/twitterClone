<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/timeline', 'Api\Timeline\TimelinesController@index');

Route::get('/tweets/{tweet}', 'Api\Tweets\TweetsController@show');
Route::post('/tweets', 'Api\Tweets\TweetsController@store');
Route::get('/tweets', 'Api\Tweets\TweetsController@index');
Route::post('/tweets/{tweet}/like', 'Api\Tweets\TweetsLikeController@store');
Route::delete('/tweets/{tweet}/like', 'Api\Tweets\TweetsLikeController@destroy');

Route::post('/tweets/{tweet}/retweets', 'Api\Tweets\TweetRetweetController@store');
Route::delete('/tweets/{tweet}/retweets', 'Api\Tweets\TweetRetweetController@destroy');

Route::post('/tweets/{tweet}/quote', 'Api\Tweets\TweetQuoteController@store');

Route::get('/media/types', 'Api\Media\MediaTypesController@index');
Route::post('/media', 'Api\Media\MediaController@store');

Route::get('/tweets/{tweet}/reply', 'Api\Tweets\TweetReplyController@show');
Route::post('/tweets/{tweet}/reply', 'Api\Tweets\TweetReplyController@store');





