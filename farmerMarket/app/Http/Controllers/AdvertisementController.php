<?php
 
namespace App\Http\Controllers;
 
use App\Advertisement;
 
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
 
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
 
        /*$file = Request::file('file');
        $extension = $file->getClientOriginalExtension();
        Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
 
        $entry = new \App\File();
        $entry->mime = $file->getClientMimeType();
        $entry->original_filename = $file->getClientOriginalName();
        $entry->filename = $file->getFilename().'.'.$extension;
 
        $entry->save();
 */
        $advertisement  = new Advertisement();
        $advertisement->owner_id=Request::input('owner_id');
        $advertisement->name =Request::input('name');
        $advertisement->description =Request::input('description');
        $advertisement->price_cents =Request::input('price_cents');
        //$product->imageurl =Request::input('imageurl');
 
        $advertisement->save();
 
        return redirect('/advertisement/view');
 
    }
}