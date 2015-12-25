<?php

namespace App;

use Jenssegers\Mongodb\Model as Eloquent;
use App\Tweet;

class Analytics extends Model
{
    // Create an API endpoint in Laravel that returns # of tweets in
    // database, # of tweets that include a link, # of re-tweets, avg # of
    // characters.

  public function numTweets(){
      return length(Tweet::all());
  }

  public function numTweetsWithLink(){
      return length(Tweet::where('link', true));
  }

  public function numTweetsFromRT() {
      return length(Tweet::where('retweet', true));
  }

  public function numTimesRetweeted() {
      return Tweet::all()->sum('retweet_count')
  }

  public function getLengthOfTweets() {
      $tweets = Tweet::all();
      $tweet_lengths = [];
      foreach($tweets as $tweet) {
        $len = strlen($tweet->getAttribute('text'));
        $tweet_lengths.push($len);
      }
      return $tweet_lengths
  }

  public function avgNumCharacters() {
      $lengths = $this->getLengthOfTweets();
      return (array_sum($lengths) / count($lengths));
  }
}
