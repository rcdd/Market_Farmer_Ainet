<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ImageController extends Controller
{
    public function upload($file) {
		  // getting all of the post data
		  //$file = array('image' => Input::file('image'));
		  // setting up rules
		    // checking file is valid.
		    if ($file->isValid()) {
		      $destinationPath = 'uploads'; // upload path
		      $extension = $file->getClientOriginalExtension(); // getting image extension
		      $fileName = rand(11111,99999).'.'.$extension; // renameing image
     		  $file->move($destinationPath, $fileName); // uploading file to given path
		      // sending back with message
		      Session::flash('success', 'Upload successfully'); 
		      return Redirect::to('upload');
		    }
		    else {
		      // sending back with error message.
		      Session::flash('error', 'uploaded file is not valid');
		      return Redirect::to('upload');
		    }
	}
}
