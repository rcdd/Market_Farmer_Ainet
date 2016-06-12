<?php
 
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
 
use Validator;
use App\Media;
use App\Advertisement;
use App\Comments;
use App\User;
use Auth;

class AdvertisementController extends Controller
{
 
    public function index(){

        $advertisements = Advertisement::where('blocked', '=', '0')->where(function($query)
            {
                $query->whereDate('available_until', '>', date('Y-m-d'))
                    ->orWhere('available_until', '=', null);
            })->get();
        
        return view('advertisements.index', ['advertisements' => $advertisements, 'title' => "List of Advertisements"]);
    }
 

    public function destroy($id){

        $ads =Advertisement::findOrFail($id);
        if($ads->medias){

            $ads->medias()->delete();
        }

        if($ads->comments){
            $ads->comments()->delete();
        }

        $ads->delete();
         session()->flash('success','Advertisement Deleted');
        return redirect('/advertisement/index');
    }
 
    public function newAdvertisement(){
        $ads = new Advertisement();
        return view('advertisements.new', ['ads' => $ads, 'title' => "New Advertisement"]);
    }
 
    public function add(Request $request) {
        
        $rules = array(
            'name'  => 'Required|Min:3|Max:80',
            'available_on'     => 'Required|date',
            'available_until'  =>'date|after:available_on|after:today',
            'price_cents' => 'required_without_all:trade_prefs',
            'trade_prefs' => 'required_without_all:price_cents',
            'quantity' => 'required',
        );

        $input = $request->all();
        $validator = Validator::make($input, $rules);
        if($validator->fails())
        {   
            session()->flash('error','The form has errors. Please correct it and try again.');
            return redirect()->back();
        }

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
 
    }


    public function edit($id){
        $ads = Advertisement::findOrFail($id);

        if($ads->owner_id != Auth::id()){
            session()->flash('error','Resource not allowed to you!');
            return redirect('/advertisement/index');
        }

        $title = "Edit Advertisement :: " . $ads->name;
        return view('advertisements.edit', compact('ads', 'title'));
    }

    public function update($id, Request $request){
        $ads = Advertisement::findOrFail($id);
        
        if($ads->owner_id != Auth::id()){
            session()->flash('error','Resource not allowed to you!');
            return redirect('/advertisement/index');
        }

        $rules = array(
            'name'  => 'Required|Min:3|Max:80',
            'available_on'     => 'Required|date',
            'available_until'  =>'date|after:available_on|after:today',
            'price_cents' => 'required_without_all:trade_prefs',
            'trade_prefs' => 'required_without_all:price_cents',
            'quantity' => 'required',
        );

        $input = $request->all();

        $validator = Validator::make($input, $rules);
        if($validator->fails())
        {   
            session()->flash('error','The form has errors. Please correct it and try again.');
            return redirect()->back();
        }

        $ads->owner_id= $input['owner_id'];
        $ads->name = $input['name'];
        $ads->description =$input['description'];
        $ads->price_cents =$input['price_cents'];
        $ads->available_on =$input['available_on'];
        $ads->available_until = ($request->has('available_until') ? $input['available_until'] : null);
        $ads->trade_prefs =$input['trade_prefs'];
        $ads->quantity =$input['quantity'];

        $ads->save();

        //image field
        if($file = $request->file('photo_path')){
            $extension = $file->getClientOriginalExtension();
            Storage::disk('local')->put("ads/" . $file->getFilename().'.'.$extension,  File::get($file));
     

            $media = new Media();
            $media->mime_type = $file->getClientMimeType();
            $media->photo_path = $file->getFilename().'.'.$extension;
            // falta de tempo para mostrar varias -- to update
            if($ads->medias){
                $ads->medias()->delete();
            }
            $media->advertisement()->associate($ads);
            //end image field

            $media->save();
        }

        
        session()->flash('success','Advertisement updated');
        return redirect('/advertisement/view/' . $id);

    }

    public function viewAdvertisement($id){
        $ads = Advertisement::findOrFail($id);
        $title = "Advertisement :: " . $ads->name;
        $comments = $ads->comments()->where('parent_id', null)->get();
        return view('advertisements.view', compact('ads', 'comments', 'title'));
    }

    public function status($id){
        $ads = Advertisement::findOrFail($id);

        $ads->blocked = ($ads->blocked ? '0' : '1');
        $ads->save();

        session()->flash('success','Advertisement status changed');
        return redirect()->back();
    }

    public function blocked(){
         $advertisements = Advertisement::where('blocked', '=', '1')->get();
        return view('advertisements.index', ['advertisements' => $advertisements, 'title' => "List of Blocked Advertisements"]);
    }

    
}