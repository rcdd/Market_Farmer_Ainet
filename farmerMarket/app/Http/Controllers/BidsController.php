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
		    'trade_prefs' => 'required_without_all:price_cents',
		    'quantity' => 'required',
		);
		
		//$v = Validator::make($request->all(), $rules);

		$input = $request->all();
		if($validator = Validator::make($input, $rules)->fails())
		{
	        session()->flash('error', 'Fields are incorrect!');
	        return redirect()->back();
		}
		
		//test if price is higher
		if( $request->has('price_cents') ){
			$lastPrice = ($ads->lastBid() ? $ads->lastBid() : $ads->price_cents);
			if($input['price_cents'] <= $lastPrice){
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

		if($user->id != Auth::id()){
            session()->flash('error','Resource not allowed to you!');
            return redirect('/');
        }

		$bids = $user->bids;


		$ads = Advertisement::all();
		$bidsAds = array();
		foreach ($bids as $bid) {
			if($bid->status <1 )
				continue;
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

	public function changeBid(Request $request)
	{
		//return var_dump($request);
		$ads = Advertisement::findOrFail($request->id_ads);

		if($ads->owner_id != Auth::id()){
            session()->flash('error','Resource not allowed to you!');
            return redirect('/');
        }

        $rules = array(
		    'price_cents' => 'required_without_all:trade_prefs',
		    'trade_prefs' => 'required_without_all:price_cents',
		    'quantity' => 'required',
		);

		$input = $request->all();
		if(Validator::make($input, $rules)->fails())
		{
	        session()->flash('error', 'Fields are incorrect!');
	        return redirect()->back();
		}

		if($request->price_cents < $ads->lastBid()){
			session()->flash('error', 'The price that you insert is lower than the current bid!');
	        return redirect()->back();
		}

		$bid = Bids::findOrFail($request->id_bid);

		$input = $request->all();


        if($request->has('comment')) $bid->comment = $input['comment'];
        if($request->has('price_cents')) $bid->price_cents = $input['price_cents'];
        if($request->has('trade_location'))  $bid->trade_location = $input['trade_location'];
        if($request->has('trade_prefs')) $bid->trade_prefs = $input['trade_prefs'];
        if($request->has('quantity')) $bid->quantity = $input['quantity'];

        //$bid->status = '1';

        $bid->save();

		session()->flash('success', 'You have changed your bid successfull');
	    return redirect()->back();
	}

	public function cancelBid($id){
		$bid = Bids::findOrFail($id);
		if($bid->buyer_id != Auth::id()){
            session()->flash('error','Resource not allowed to you!');
            return redirect('/');
        }

		$bid->status = 0;
		$bid->save();
		return redirect()->back();
	}

	public function acceptBid($id){
		$bid = Bids::findOrFail($id);
		$ads = Advertisement::where('id', '=', $bid->id);

		if($ads->owner_id != Auth::id()){
            session()->flash('error','Resource not allowed to you!');
            return redirect('/');
        }

		$bid->status = 3;
		$bid->save();
		return redirect()->back();
	}

	public function refuseBid($id){
		$bid = Bids::findOrFail($id);
		$ads = Advertisement::where('id', '=', $bid->id);

		if($ads->owner_id != Auth::id()){
            session()->flash('error','Resource not allowed to you!');
            return redirect('/');
        }

		$bid->status = 2;
		$bid->save();
		return redirect()->back();
	}

	public function viewBids($id){
		$title = 'Bids in advertisement';
        $ads = Advertisement::findOrFail($id);

        if($ads->owner_id != Auth::id()){
            session()->flash('error','Resource not allowed to you!');
            return redirect('/');
        }

        $bids = $ads->bids;

		return view('bids.bidsInAd', compact('title', 'bids'));    
    }
}
