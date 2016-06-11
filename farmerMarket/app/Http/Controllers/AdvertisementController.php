<?php
 
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
 
use App\Media;
use App\Advertisement;
use App\Comments;
use App\User;

class AdvertisementController extends Controller
{
 
    public function index(){
        $advertisements = Advertisement::all();
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
 
    public function add() {

        $advertisement  = new Advertisement();
        $advertisement->owner_id=Request::input('owner_id');
        $advertisement->name =Request::input('name');
        $advertisement->description =Request::input('description');
        $advertisement->price_cents =Request::input('price_cents');
        $advertisement->available_on =Request::input('available_on');
        $advertisement->available_until =Request::input('available_until');
        $advertisement->trade_prefs =Request::input('trade_prefs');
        $advertisement->quantity =Request::input('quantity');

        $advertisement->save();

        //image field
        if($file = Request::file('photo_path')){
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
        $title = "Edit Advertisement :: " . $ads->name;
        return view('advertisements.edit', compact('ads', 'title'));
    }

    public function update($id, Request $request){
        $ads = Advertisement::findOrFail($id);

        $ads->owner_id=Request::input('owner_id');
        $ads->name =Request::input('name');
        $ads->description =Request::input('description');
        $ads->price_cents =Request::input('price_cents');
        $ads->available_on =Request::input('available_on');
        $ads->available_until =Request::input('available_until');
        $ads->trade_prefs =Request::input('trade_prefs');
        $ads->quantity =Request::input('quantity');

        $ads->save();

        //image field
        if($file = Request::file('photo_path')){
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
}