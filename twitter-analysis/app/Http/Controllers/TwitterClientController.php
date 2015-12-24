<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TwitterClientController extends Controller
{
  public function getTweets() {

    $tweets = \Twitter::getUserTimeline(['screen_name' => 'FlatironSchool','count' => 50, 
      'format' => 'json']);
    $tweet_array = json_decode($tweets);
    $link = \Twitter::linkTweet($tweet_array[0]);
    print_r('');
    print_r('');
    print_r($tweet_array[1]);

    // $m = new MongoClient();
    // $collection = $m->selectCollection('tweets');
    // db.tweets.insert() {
    //   'text' : $tweet->text,
    //   'link' : // custom function,
    //   'retweet_count' : $tweet->retweet_count,
    //   'time' : $tweet->created_at,
    //   'favorite_count' : $tweet->favorite_count,
    //   'hashtag_count' : count($tweet_array[1]->entities->hashtags),
    //   'retweet' : // custom function 
    // }
  }
    
}
