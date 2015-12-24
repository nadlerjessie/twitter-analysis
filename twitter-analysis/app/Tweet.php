<?php

namespace App;

use Jenssegers\Mongodb\Model as Eloquent;

class Tweet extends Eloquent
{
    protected $connection = 'mongodb'; 
}
