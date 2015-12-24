<?php

namespace App;

use Jenssegers\Mongodb\Model as Eloquent;

class Tweet extends Eloquent
{
    protected $connection = 'mongodb';
    // whitelist:
    protected $fillable = ['text', 'link', 'retweet_count', 'time', 'favorite_count', 'hashtag_count', 'retweet'];
}
