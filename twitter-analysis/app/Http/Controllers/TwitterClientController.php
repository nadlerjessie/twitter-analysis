<?php
require 'vendor/autoload.php';
namespace App\Http\Controllers;

use Guzzle\Http\Client;
use Guzzle\Http\Subscriber\Oauth\Oauth1;

class TwitterClientController extends Controller
{
    $client = new Client(['base_url' => 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=FlatironSchool&count=50', 'defaults' => ['auth' => 'oauth']);

    $oauth = new Oauth1([
      'consumer_key' => env('TWITTER_CONSUMER_KEY'),
      'consumer_secret' => env('TWITTER_CONSUMER_SECRET'),
      'token' => env('TWITTER_ACCESS_TOKEN'),
      'token_secret' => env('TWITTER_ACCESS_TOKEN_SECRET')
      ]);
}
