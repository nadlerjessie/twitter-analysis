<?php
namespace App\Http\Controllers;

use GuzzleHttp\Client;

class TwitterClientController extends Controller
{
  public function getTweets() {
    $client = new Client(['base_uri' => 'https://api.twitter.com/', 'defaults' => ['auth' => 'oauth']]);
    // .1/statuses/user_timeline.json/
    $oauth = [
      'consumer_key' => env('TWITTER_CONSUMER_KEY'),
      'consumer_secret' => env('TWITTER_CONSUMER_SECRET'),
      'token' => env('TWITTER_ACCESS_TOKEN'),
      'token_secret' => env('TWITTER_ACCESS_TOKEN_SECRET')
      ];

    $res = $client->get('1.1/statuses/user_timeline.json?screen_name=FlatironSchool&count=2')->getBody();
    // screen_name=FlatironSchool&count=2
    print_r($res->json());
  }
    
}
