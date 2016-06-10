<?php 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Request;
 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

use App\User;
use App\Media;
use App\Advertisement;
 
class MediaController extends Controller {
 
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	
 	// -- NOT IMPLEMENTED --
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

		if($user->profile_photo == null || !Storage::disk('local')->exists("profile/". $user->profile_photo)){
			$file = Storage::disk('local')->get("/user_not_found.png");
			return (new Response($file, 200))->header('Content-Type', 'image/png');
		}

		$file = Storage::disk('local')->get("profile/". $user->profile_photo);
		return (new Response($file, 200))->header('Content-Type', $user->mime_type);

	}

	public function getImageAds($id){
		$ads = Advertisement::findOrFail($id);
		$file = null;

		if(count($ads->medias) > 0){
			$photo = $ads->medias[0];
			$file = (Storage::disk('local')->exists("ads/". $photo->photo_path) ? storage_path("app/ads/". $photo->photo_path) : storage_path("app/image_not_found.png") );
		}

		if($file == null)
			$file = storage_path("app/image_not_found.png");

 		$headers = array(
              'Content-Type:' . (isset($photo->mime_type) ? $photo->mime_type : "image/png"),
            );

		return response()->download($file, 'TESTE', $headers, 'inline');

	}

	public function deleteImageAds($id){
		$photo = Media::findOrFail($id);
		$photo->destroy;
		return;
	}
}