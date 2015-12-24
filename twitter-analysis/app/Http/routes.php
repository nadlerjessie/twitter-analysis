<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function() {
  return Twitter::getUserTimeline(['screen_name' => 'FlatironSchool','count' => 5, 'format' => 'json']);
});

// Route::get('/tweets', function() {
//   $tweets = DB::collection('tweets')->get();
//   return View::make('tweets', ['tweets' => $tweets]);
// });
Route::resource('tweets', 'TweetController');

Route::get('twitterclient/tweets', 'TwitterClientController@getTweets');

// });

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
