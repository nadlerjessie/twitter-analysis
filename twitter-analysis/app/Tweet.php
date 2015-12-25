<?php

namespace App;

use Jenssegers\Mongodb\Model as Eloquent;

class Tweet extends Eloquent
{
    protected $connection = 'mongodb';

    public function text(){
        return $this->getAttributes()['text'];
    }

    public function link(){
        return $this->getAttributes()['link'];
    }

    public function retweet_count(){
        return $this->getAttributes()['retweet_count'];
    }

    public function time(){
        return $this->getAttributes()['time'];
    }

    public function favorite_count(){
        return $this->getAttributes()['favorite_count'];
    }

    public function hashtag_count(){
        return $this->getAttributes()['hashtag_count'];
    }

    public function retweet(){
        return $this->getAttributes()['retweet'];
    }

}
