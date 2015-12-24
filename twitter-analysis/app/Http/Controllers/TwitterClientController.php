<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tweet;
use MongoClient;
use Illuminate\Support\Facades\DB;

class TwitterClientController extends Controller
{

  public function tweetHasLink($text) {
    return (strpos($text, 'http') == true);
  }

  public function tweetIsRT($text) {
    return (substr($text, 0, 2) == 'RT');
  }

  public function getTweets() {

    $tweets = \Twitter::getUserTimeline(['screen_name' => 'FlatironSchool','count' => 100, 
      'format' => 'json']);
    $tweet_array = json_decode($tweets);

    foreach ($tweet_array as $tweet) {
      $tweet_text = $tweet->text;
      Tweet::create(['text' => $tweet_text,
      'link' => $this->tweetHasLink($tweet_text),
      'retweet_count' => $tweet->retweet_count,
      'time' => $tweet->created_at,
      'favorite_count' => $tweet->favorite_count,
      'hashtag_count' => count($tweet_array[1]->entities->hashtags),
      'retweet' => $this->tweetIsRT($tweet_text)]);
      $new_tweet = new Tweet();
      $tweet_text = $tweet->text;
      $tweet_data = array('text' => $tweet_text,
      'link' => $this->tweetHasLink($tweet_text),
      'retweet_count' => $tweet->retweet_count,
      'time' => $tweet->created_at,
      'favorite_count' => $tweet->favorite_count,
      'hashtag_count' => count($tweet_array[1]->entities->hashtags),
      'retweet' => $this->tweetIsRT($tweet_text));

      $new_tweet->save($tweet_data);
    }

    print_r(Tweet::first()->getAttribute('text'));
  }
    
}
