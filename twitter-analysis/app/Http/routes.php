<?php
use App\Tweet;

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

Route::resource('tweets', 'TweetController');

Route::group(['prefix' => 'api'], function () {
  Route::group(['prefix' => 'v1'], function() {
    Route::resource('tweetanalytics', 'AnalyticsController', ['only' => ['index']]);
  });
}) ;

Route::get('/test', function() {
  $tweets = Tweet::all();
  return view('tweets.index')
            ->with('tweets', $tweets);
});

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
