<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Advertisement;

use App\Bids;

use App\User;

use Validator;

use Auth;

class BidsController extends Controller
{
	public function placeBid($id, Request $request){
		$ads = Advertisement::findOrFail($id);

		$rules = array(
		    'price_cents' => 'required_without_all:trade_prefs',
		    'trade_prefs' => 'required_without_all:facebook_id,price_cents',
		    'quantity' => 'required',
		);
		
		//$v = Validator::make($request->all(), $rules);

		$input = $request->all();
		if(Validator::make($input, $rules)->fails())
		{
	        session()->flash('error', 'Fields are incorrect!');
	        return redirect()->back();
		}
		
		//test if price is higher
		if( $request->has('price_cents') ){
			$lastPrice = isset($ads->lastBid->price_cents) ? $ads->lastBid->price_cents : $ads->price_cents;
			if($input['price_cents'] < $lastPrice){
				session()->flash('error', 'The price that you insert is lower!');
	        	return redirect()->back();
			}
		}

        $bid  = new Bids();
        //$bid->advertisement_id = $ads->id;
        $bid->buyer_id =  Auth::user()->id;
        $bid->comment = $input['comment'];
        $bid->price_cents =$input['price_cents'];
        $bid->trade_location =$input['trade_location'];
        $bid->trade_prefs =$input['trade_prefs'];
        $bid->quantity =$input['quantity'];
        $bid->status = "1";

        //return ($bid);
        $ads->bids()->save($bid);


        //return var_dump($ads->bids);


        // redirect para a home 
        session()->flash('success','You have been placed a bid.');
        return redirect()->back();
	}

	public function showMyBids($id){
		$title = "List of my Bids";
		$user = User::findOrFail($id);
		$bids = $user->bids;


		$ads = Advertisement::all();
		$bidsAds = array();
		foreach ($bids as $bid) {
			$ad = $ads->find($bid->advertisement_id);
			$info = array("advertisement" => $ad, "bid"=>$bid);
			array_push($bidsAds, $info);
		}

		if(count($bidsAds) > 0)
		{
			$bids = $bidsAds;
		}else{
			$bids = null;
		}

		return view('bids.view', compact('title', 'bids'));
	}
}
