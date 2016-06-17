<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement_tag extends Model
{
	protected $table = 'advertisement_tag';

    protected $fillable = [
        'advertisement_id', 'tag_id'
    ];

    public function advertisements()
    {
        return $this->hasMany('App\advertisement');
    }
}
