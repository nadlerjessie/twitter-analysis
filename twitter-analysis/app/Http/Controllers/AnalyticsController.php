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
      $analytics->chronologicalChartData('retweet_count', '12/26/2015', '12/27/2015');
      $statusCode = 200;
      $response = ['numTweets' => $analytics->numTweets(),
        'numTweetsWithLink' => $analytics->numTweetsWithLink(),
        'numTweetsTypeRT' => $analytics->numTweetsTypeRT(),
        'numTimesRetweeted' => $analytics->numTimesRetweeted(),
        'avgNumCharacters' => $analytics->avgNumCharacters(),
      ];

      return \Response::json($response, $statusCode);
    }

    public function chartData($input_param, $start_date, $end_date) {
      $analytics = new Analytics();
      $statusCode = 200;
      $response = [$input_param => $analytics->chronologicalChartData('retweet_count', '12/26/2015', '12/27/2015')];

      return \Response::json($response, $statusCode);
    }
}
