<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Tweet;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TweetController extends Controller
{
    public function index() 
    {   
        $tweets = Tweet::all();
        return view('tweets.index')->with('tweets', $tweets);
    }
}
