<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bids extends Model
{
	protected $fillable = [
        'price_cents', 'trade_prefs', 'quantity', 'trade_location', 'comment', 'advertisement_id', 'buyer_id', 'buyer_eval', 'seller_eval',
    ];

    public function advertisement()
    {
    	$this->belongsTo('App\Advertisement');
    }

    public function user()
    {
    	$this->belongsTo('App\User', 'buyer_id');
    }

}
