<?php

use Illuminate\Database\Seeder;
use App\TwitterClient;
use App\Tweet;

class TweetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function getTweets() {
        $client = new TwitterClient('FlatironSchool', 100);
        $tweets = json_decode($client->getTwitterJson());
        foreach ($tweets as $tweet) { 
          $this->findOrCreateByText($tweet);
        }
    }

    public function tweetHasLink($text) {
        return (strpos($text, 'http') == true);
    }

    public function tweetIsRT($text) {
        return (substr($text, 0, 2) == 'RT');
    }

    public function setTime($time) {
        return new Datetime($time);
    }

    public function findHour($time) {
        $date = new Datetime($time);
        return (int)$date->format('H');
    }

    public function findOrCreateByText($tweet) {
        $text = $tweet->text;
        if (!count(Tweet::where('text', $text)->get())){
          return Tweet::create(['text' => $text,
          'link' => $this->tweetHasLink($text),
          'retweet_count' => $tweet->retweet_count,
          'datetime' => $this->setTime($tweet->created_at),
          'hour' => $this->findHour($tweet->created_at),
          'favorite_count' => $tweet->favorite_count,
          'hashtag_count' => count($tweet->entities->hashtags),
          'retweet' => $this->tweetIsRT($text)]);
        }
        else {
          return Tweet::where('text', $text)->get();
        }
    }

    public function run()
    {
        $this->getTweets();
    }
}
