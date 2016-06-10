<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Advertisement;

use App\Bids;

class BidsController extends Controller
{
	public function placeBid($id, Request $request){
		$ads = Advertisement::findOrFail($id);

		$input = $request->all(); 
		if($input->has('price_cents')){
			$bid = $request->price_cents;
		}else if($input->has('trade_prefs')){
			$trade = $request->trade_prefs;
		}else{
	        session()->flash('errors','Field not defined!');
	        return redirect()->back();
		}
		
        $bid = new Bids();

		echo $ads;
		return var_dump($request);
	}
    //
}
