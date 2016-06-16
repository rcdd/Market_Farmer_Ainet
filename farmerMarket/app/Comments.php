<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = [
        'comment', 'advertisement_id', 'parent_id', 'user_id',
    ];


    public function advertisement() {
        return $this->belongsTo('App\Advertisement');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function parent()
    {
        return $this->belongsTo('App\Comments', 'parent_id');
    }

    public function hasReplay()
    {
        return $this->hasMany('App\Comments', 'parent_id');
    }

}
