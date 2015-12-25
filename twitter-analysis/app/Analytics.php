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
    length(Tweet::all());
  }

  public function numTweetsWithLink(){
    length(Tweet::where('link', true));
  }

  public function numTweetsFromRT() {
    length(Tweet::where('retweet', true));
  }

  public function numTimesRetweeted() {
    
  }

  public function avgNumCharacters() {
    
  }
}
