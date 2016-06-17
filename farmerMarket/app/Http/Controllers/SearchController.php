<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Advertisement;
use Auth;

class SearchController extends Controller
{
    
    public function mainSearch(Request $request){

        $keyword =  $request['mainSearch'];

        $searchTerms = explode(' ', $keyword);

        $query = Advertisement::where('blocked', '=', '0');

        foreach($searchTerms as $term)
        {
            $query->where('name', 'LIKE', '%'. $term .'%');
        }

        $advertisements = $query->get();



        return view('advertisements.index', ['advertisements' => $advertisements, 'title' => "List of Advertisements founded"]);

        /*if(!$advertisements)
        {
            $users = Users::where('blocked', '=', '0')->where(function($query)
            {
                $query->where('name', '=', $keyword)
                    ->orWhere('location', '=', $keyword);
            })->get();
            return view('user.index', ['advertisements' => $users, 'title' => "List of Users"]);
        } else {
            
        }*/
    }

    public function advertisementSearch(Request $request){

        $keyword =  $request['advertisementSearch'];

        $searchTerms = explode(' ', $keyword);


        $input = $request->all();

        $advertisement  = new Advertisement();
        $advertisement->owner_id= $input['owner_id'];
        $advertisement->name = $input['name'];
        $advertisement->description =$input['description'];
        $advertisement->price_cents =$input['price_cents'];
        $advertisement->available_on =$input['available_on'];
        $ads->available_until = ($request->has('available_until') ? $input['available_until'] : null);
        $advertisement->trade_prefs =$input['trade_prefs'];
        $advertisement->quantity =$input['quantity'];

        $advertisement->save();

        //image field
        if($file = $request->file('photo_path')){
            //if (Input::file('photo')->isValid())
            $extension = $file->getClientOriginalExtension();
            Storage::disk('local')->put("ads/" . $file->getFilename().'.'.$extension,  File::get($file));
     

            $media = new Media();
            $media->mime_type = $file->getClientMimeType();
            $media->photo_path = $file->getFilename().'.'.$extension;

            $media->advertisement()->associate($advertisement);
            //end image field

            $media->save();
        }

        
        session()->flash('success','Advertisement added');
        return redirect('/advertisement/index');

        $query = Advertisement::where('blocked', '=', '0');

        foreach($searchTerms as $term)
        {
            $query->where('name', 'LIKE', '%'. $term .'%');
        }

        $advertisements = $query->get();



        return view('advertisements.index', ['advertisements' => $advertisements, 'title' => "List of Advertisements founded"]);

        /*if(!$advertisements)
        {
            $users = Users::where('blocked', '=', '0')->where(function($query)
            {
                $query->where('name', '=', $keyword)
                    ->orWhere('location', '=', $keyword);
            })->get();
            return view('user.index', ['advertisements' => $users, 'title' => "List of Users"]);
        } else {
            
        }*/
    }


}