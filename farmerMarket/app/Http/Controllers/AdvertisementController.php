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
        return view('advertisements.index',['advertisements' => $advertisements]);
    }
 
    public function destroy($id){
        Advertisement::destroy($id);
        return redirect('/advertisement/index');
    }
 
    public function newAdvertisement(){
        return view('advertisements.new');
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
        }
       

        //$advertisement->integer('id')->unsigned();
        $media->advertisement_id = $advertisement->id;
        //end image field

        $media->save();
 
        return redirect('/advertisement/index');
 
    }

    public function viewAdvertisement($id){
        $ads = Advertisement::findOrFail($id);
        $users = User::all();
        $comments = Comments::where('advertisement_id', '=', $id)->get();

        return view('advertisements.view', compact('ads', 'users', 'comments'));
    }
}