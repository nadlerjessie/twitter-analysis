<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Response;

use App\Analytics;

class AnalyticsController extends Controller
{
    public function index() {
      $analytics = new Analytics();
      $statusCode = 200;
      $response = ['numTweets' => $analytics->numTweets(),
        'numTweetsWithLink' => $analytics->numTweetsWithLink(),
        'numTweetsTypeRT' => $analytics->numTweetsTypeRT(),
        'numTimesRetweeted' => $analytics->numTimesRetweeted(),
        'avgNumCharacters' => $analytics->avgNumCharacters()
      ];

      return \Response::json($response, $statusCode);
    }
}
