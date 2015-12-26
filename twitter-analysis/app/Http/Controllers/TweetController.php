<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Tweet;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Analytics;

class TweetController extends Controller
{
    public function index() 
    {   
        $analytics = new Analytics();
        $optimalTweetTime = $analytics->optimalTweetTime();

        $tweets = Tweet::all();
        return view('tweets.index', ['tweets' => $tweets, 'time' => $optimalTweetTime]);
    }
}
