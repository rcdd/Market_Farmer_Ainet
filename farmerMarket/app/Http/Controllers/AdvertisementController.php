<?php
 
namespace App\Http\Controllers;
 
use App\Advertisement;
 
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
 
use App\Media;

class AdvertisementController extends Controller
{
 
    public function index(){
        $advertisements = Advertisement::all();
        return view('advertisements.view',['advertisements' => $advertisements]);
    }
 
    public function destroy($id){
        Advertisement::destroy($id);
        return redirect('/advertisement/view');
    }
 
    public function newProduct(){
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
        $file = Request::file('photo_path');
        $extension = $file->getClientOriginalExtension();
        Storage::disk('local')->put("ads/" . $file->getFilename().'.'.$extension,  File::get($file));
 

        $media = new Media();
        $media->mime_type = $file->getClientMimeType();
        $media->photo_path = $file->getFilename().'.'.$extension;

        //$advertisement->integer('id')->unsigned();
        $media->advertisement_id = $advertisement->id;
        //end image field

        $media->save();
 
        return redirect('/advertisement/view');
 
    }
}