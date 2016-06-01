<?php 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Media;
use Request;
 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

use App\User;
use App\Advertisement;
 
class MediaController extends Controller {
 
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$entries = Media::all();
 
		return view('fileentries.index', compact('entries'));
	}
 
	public function add($file) {
		$extension = $file->getClientOriginalExtension();
		Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
		$entry = new Media();
		$entry->mime = $file->getClientMimeType();
		$entry->original_filename = $file->getClientOriginalName();
		$entry->filename = $file->getFilename().'.'.$extension;
 
		$entry->save();
 
		return ;
		
	}

	public function getImageProfile($id){
		$user = User::findOrFail($id);
		//$entry = $user->where('id', '=', $id)->firstOrFail();
		$file = Storage::disk('local')->get("profile/". $user->profile_photo);

		return (new Response($file, 200))->header('Content-Type', $user->mime_type);

	}

	public function getImageAds($id){
		$ads = Advertisement::findOrFail($id);
		$media = new Media();
		$photo = $media->where('advertisement_id', '=', $ads->id)->firstOrFail();
		$file = Storage::disk('local')->get("ads/". $photo->photo_path);

		return (new Response($file, 200))->header('Content-Type', $photo->mime_type);

	}
}