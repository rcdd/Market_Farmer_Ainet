<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    public function advertisements()
    {
        return $this->belongsToMany('App\advertisement');
    }
}
