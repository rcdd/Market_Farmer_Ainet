<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;

//files
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function list(){

    	$title = "Listagem de Utilizadores";
    	$users = User::all();

    	return view('users.index', compact('title', 'users'));
    }

    public function register(){
    	$user = new User;
        $title = "New User";
    	return view('auth.register', compact('user', 'title'));
    }

	public function store(Request $request){
        // definir regras 
        $rules = array(
            'name'  => 'Required|Min:3|Max:80|Alpha',
            'email'     => 'Required|Between:3,64|Email|Unique:users',
            'password'  =>'Required|AlphaNum|Between:4,8|Confirmed',
            'password_confirmation'=>'Required',
        );

        // executar validate()
        $this->validate($request, $rules);

		
        // gravar na DB
        $input = $request->all();

        //image field
        $file = $request->file('profile_photo');
        $extension = $file->getClientOriginalExtension();
        Storage::disk('local')->put("profile/" . $file->getFilename().'.'.$extension,  File::get($file));

        $mime_type = $file->getClientMimeType();
        $profile_photo = $file->getFilename().'.'.$extension;
        //end image field

        // $profile_photo = $request->file('profile_photo')->getClientOriginalName();
        // $request->file('profile_photo')->move(base_path() . '/public/assets/uploads/users/', $profile_photo);

        User::create([
        	'name'  => $input['name'],
            'email'     => $input['email'],
        	'password' => password_hash ( $input['password'], PASSWORD_DEFAULT), 
        	'admin' => $request->has('admin'),
        	'location' => $input['location'],
        	'presentation' => $input['presentation'],
        	'profile_photo' => $profile_photo,
            'mime_type' => $mime_type,
        	'profile_url' => $input['profile_url'],
        ]);

        // redirect para a home
        return redirect('/home');
    }

    public function edit($id){
    	$user = User::findOrFail($id);
        $title = "Edit User";
    	//return view('users.edit', ['id' => $id]);
    	return view('auth.edit', compact('id', 'user', 'title'));
    }

    public function update($id, Request $request)
	{
	    $user = User::findOrFail($id);
	    
	    $rules = array(
            'name'  => 'Required|Min:3|Max:80|Alpha',
            'email'     => 'Required|Between:3,64|Email',
            'password'  =>'Required|AlphaNum|Between:4,8|Confirmed',
            'password_confirmation'=>'Required',
        );

        // executar validate()
        $this->validate($request, $rules);


	    $input = $request->all();
		$user->fill($input);

	    $user->password = password_hash ( $input['password'], PASSWORD_DEFAULT);
	    $user->admin = $request->has('admin');

        //image field
        $file = $request->file('profile_photo');
        $extension = $file->getClientOriginalExtension();
        Storage::disk('local')->put("profile/" . $file->getFilename().'.'.$extension,  File::get($file));

        $user->mime_type = $file->getClientMimeType();
        $user->profile_photo = $file->getFilename().'.'.$extension;
        //end image field

	   	$user->save();

	    return redirect('/home');
	}

    public function delete($id){
    	return "Delete Users $id";
    }

    public function viewOwnAdvertisements($id){
        $title = "My Advertisements ";
        $user = User::findOrFail($id);
        if(count($user->advertisements) > 0){
            $advertisements = $user->advertisements()->get();
        }else{
            $advertisements = "";
        }

        return view('advertisements.index', compact('advertisements', 'title'));
    }

}
