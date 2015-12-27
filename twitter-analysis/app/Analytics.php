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
      return DB::collection('tweets')->where('retweet', false)->sum('retweet_count');
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
      return (floor(array_sum($lengths) / count($lengths)));
  }

  public function optimalTweetTime() {
      $retweet_counts = $this->findCountsByTime('retweet_count');
      $favorite_counts = $this->findCountsByTime('favorite_count');
      $max_retweet_count_index = array_keys($retweet_counts, max($retweet_counts))[0];
      $max_favorite_count_index = array_keys($favorite_counts, max($favorite_counts))[0];
      if ($max_retweet_count_index == $max_favorite_count_index) {
        $range = $this::$hour_ranges[$max_retweet_count_index];
        return $this->displayTime($range);
      }
      else {
        $retweet_range = $this::$hour_ranges[$max_retweet_count_index];
        $favorite_range = $this::$hour_ranges[$max_favorite_count_index];
        return "To optimize RTs: " . $this->displayTime($retweet_range) . " To optimize Likes: " .  $this->displayTime($favorite_range);
      }
  }

  public function displayTime($range){
      $start_time = $range[0];
      $end_time = $range[1];
      if ($start_time == 12) {
        return $start_time . "-" . ($end_time - 12) . " PM.";
      }
      elseif ($start_time > 12) {
        return ($start_time - 12) . "-" . ($end_time - 12) . " PM.";
      }
      else {
        return $start_time . "-" . $end_time . " AM.";
      }
  }

  public function findCountsByTime($count_type) {
      $tweets_by_time = $this->organizeTweetsByTime();
      $counts = [];
      foreach ($tweets_by_time as $key => $tweet_by_time) {
        array_push($counts, $tweet_by_time->sum($count_type));
      }
      return $counts;
  }

  public function organizeTweetsByTime() {
      $tweets_by_time = [];
      foreach($this::$hour_ranges as $range) {
          array_push($tweets_by_time, DB::collection('tweets')->whereBetween('hour', $range)->where('retweet', false));
      }
      return $tweets_by_time; //[$early_morning, $morning, $mid_day, $afternoon, $evening, $night]      
  }

  public function setDateRange($start_date, $end_date) {
      $interval = new \DateInterval('P1D');
      $start = new DateTime($start_date);
      $end = new DateTime($end_date);
      return new \DatePeriod($start, $interval, $end); 
  }

  public function chronologicalChartData($input_param, $start_date, $end_date) {
      // Find tweets in date range
      // Group tweets by date->format('Y-m-d') and sum value of input_param for each day in range
      $daterange = $this->setDateRange($start_date, $end_date); 
      foreach($daterange as $date) {
        // validate instances where $tweet['datetime']['date']->format('Y-m-d') == $date->format('Y-m-d')
        $tweets = DB::collection('tweets')->where('datetime');
        $t1 = new DateTime($tweets['datetime']['date']);
        $t2 = $date->format('Y-m-d');
        dd($t1->format('Y-m-d') == $t2);
      }
      
  }
}
