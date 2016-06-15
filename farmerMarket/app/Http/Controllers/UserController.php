<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Auth;

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
    	$user = new User();
        $title = "New User";
    	return view('auth.register', compact('title' , 'user'));
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
        //return var_dump($request);
        //image field
        if($request->hasFile('profile_photo')){
            $file = $request->file('profile_photo');
            $extension = $file->getClientOriginalExtension();
            Storage::disk('local')->put("profile/" . $file->getFilename().'.'.$extension,  File::get($file));

            $mime_type = $file->getClientMimeType();
            $profile_photo = $file->getFilename().'.'.$extension;

        }else{
            $profile_photo = null;
            $mime_type = null;
        }
        //end image field

        User::create([
        	'name'  => $input['name'],
            'email'     => $input['email'],
        	'password' => password_hash ( $input['password'], PASSWORD_DEFAULT), 
        	//'admin' => $request->has('admin'),
        	'location' => $input['location'],
        	'presentation' => $input['presentation'],
        	'profile_photo' => $profile_photo,
            'mime_type' => $mime_type,
        	'profile_url' => $input['profile_url'],
        ]);

        // redirect para a home 
        session()->flash('success','You have been registed successfull. Please login');
        return redirect('/login');
    }

    public function edit($id){
    	$user = User::findOrFail($id);

        if($user->id != Auth::user()->id){
            session()->flash('error','Resource not allowed to you!');
            return redirect('/');
        }

        $title = "Edit User";
    	//return view('users.edit', ['id' => $id]);
    	return view('auth.edit', compact('id', 'user', 'title'));
    }

    public function update($id, Request $request)
	{
	    $user = User::findOrFail($id);
	    
        if($user->id != Auth::id()){
            session()->flash('error','Resource not allowed to you!');
            return redirect('/');
        }

	    $rules = array(
            'name'  => 'Required|Min:3|Max:80|Alpha',
            'email'     => 'Required|Between:3,64|Email',
            'password'  =>'AlphaNum|Between:4,8|Confirmed',
        );

        // executar validate()
        $this->validate($request, $rules);

	    $input = $request->all();
        //return var_dump($request);

        if( $input['password'] != "")
        {
            $user->password = password_hash ( $input['password'], PASSWORD_DEFAULT);
        }

	    $user->name = $input['name'];
        $user->email = $input['email'];
        $user->location = $input['location'];
        $user->profile_url = $input['profile_url'];
        $user->presentation = $input['presentation'];

        //image field
        if($request->hasFile('profile_photo')){
            $file = $request->file('profile_photo');
            $extension = $file->getClientOriginalExtension();
            Storage::disk('local')->put("profile/" . $file->getFilename().'.'.$extension,  File::get($file));

            $user->mime_type = $file->getClientMimeType();
            $user->profile_photo = $file->getFilename().'.'.$extension;
            //end image field
        }

	   	$user->save();

        session()->flash('success','You have been updated your profile successfull.');
	    return redirect('/home');
	}

// tests porposal
    public function delete($id){ 
    	$user = User::findOrFail($id);

        if($user->comments)
            $user->comments()->delete();

        if($user->advertisements){
            $user->advertisements()->delete();
        }
        
        $user->delete();
        session()->flash('success','User deleted!');
        return redirect()->back();
    }

    public function viewOwnAdvertisements($id){
        $title = "My Advertisements ";
        $user = User::findOrFail($id);
        
        if($user->id != Auth::id()){
            session()->flash('error','Resource not allowed to you!');
            return redirect('/');
        }

        if(count($user->advertisements) > 0){
            $advertisements = $user->advertisements()->get();
        }else{
            $advertisements = "";
        }

        return view('advertisements.index', compact('advertisements', 'title'));
    }

    public function blocked($id){
        $user = User::findOrFail($id);
        $user->blocked = 1;
        $user->save();
        session()->flash('success','User has been blocked!');
        return redirect()->back();
    }

    public function unBlocked($id){
        $user = User::findOrFail($id);
        $user->blocked = 0;
        $user->save();
        session()->flash('success','User has been unblocked!');
        return redirect()->back();
    }

    public function revokeAdmin($id){
        $user = User::findOrFail($id);
        $user->admin = 0;
        $user->save();
        session()->flash('success','User has been revoked!');
        return redirect()->back();
    }

    public function becomeAdmin($id){
        $user = User::findOrFail($id);
        $user->admin = 1;
        $user->save();
        session()->flash('success','User is Admin now!');
        return redirect()->back();
    }



}
