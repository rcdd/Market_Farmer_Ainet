<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
	protected $fillable = [
        'advertisement_id', 'tag_id'
    ];

    public function advertisements()
    {
        return $this->hasMany('App\advertisement');
    }
}