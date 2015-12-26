<?php

namespace App;

use Jenssegers\Mongodb\Model as Eloquent;
use App\Tweet;
use DB;
use Datetime;

class Analytics extends Eloquent
{

  public static $hour_ranges = [array(0,7), array(8,11), array(12,14), array(15,17), array(18,20), array(21,23)];

  public function numTweets(){
      return count(Tweet::all());
  }

  public function numTweetsWithLink(){
      return count(DB::collection('tweets')->where('link', true)->get());
  }

  public function numTweetsTypeRT() {
      return count(DB::collection('tweets')->where('retweet', true)->get());
  }

  public function numTimesRetweeted() {
      return DB::collection('tweets')->sum('retweet_count');
  }

  public function getLengthOfTweets() {
      $tweets = Tweet::all();
      $tweet_lengths = [];
      foreach($tweets as $tweet) {
        $len = strlen($tweet->getAttribute('text'));
        array_push($tweet_lengths, $len);
      }
      return $tweet_lengths;
  }

  public function avgNumCharacters() {
      $lengths = $this->getLengthOfTweets();
      return (array_sum($lengths) / count($lengths));
  }

  public function optimizeTweetTime() {
      $tweets_by_time = $this->organizeTweetsByTime();
      $retweet_counts = [];
      $favorite_counts = [];
      foreach ($tweets_by_time as $key => $tweet_by_time) {
        array_push($retweet_counts, $tweet_by_time->sum('retweet_count'));
        array_push($favorite_counts, $tweet_by_time->sum('favorite_count'));
      }
      dd($retweet_counts);
  }

  public function organizeTweetsByTime() {
        $tweets_by_time = [];
        foreach($this::$hour_ranges as $range) {
            array_push($tweets_by_time, DB::collection('tweets')->whereBetween('hour', $range));
        }
        return $tweets_by_time; //[$early_morning, $morning, $mid_day, $afternoon, $evening, $night]
        // $early_morning = DB::collection('tweets')->whereBetween('hour', array(0,7)->get());
        // $morning = DB::collection('tweets')->whereBetween('hour', array(8,11)->get());
        // $mid_day = DB::collection('tweets')->whereBetween('hour', array(12,14)->get());
        // $afternoon = DB::collection('tweets')->whereBetween('hour', array(15,17)->get());
        // $evening = DB::collection('tweets')->whereBetween('hour', array(18,20)->get());
        // $night = DB::collection('tweets')->whereBetween('hour', array(21,23)->get());
         
  }
}
