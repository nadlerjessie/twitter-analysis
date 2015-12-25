<?php

namespace App;

use Jenssegers\Mongodb\Model as Eloquent;
use App\Tweet;
use DB;

class Analytics extends Eloquent
{

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
}
