<?php

namespace App;

use Jenssegers\Mongodb\Model as Eloquent;

class TwitterClient extends Eloquent
{
    public function __construct($handle, $count) {
        $this->handle = $handle;
        $this->count = $count;
    }

    public function getTwitterJson() {
        return \Twitter::getUserTimeline(['screen_name' => $this->handle,
            'count' => $this->count, 
            'format' => 'json']);
  }
}
