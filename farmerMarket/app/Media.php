<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
     protected $fillable = [
        'advertisement_id', 'media_url', 'photo_path', 'mime_type'
    ];

    public function advertisement() {
    	return $this->belongsTo('App\Advertisement');
    }
}
