<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class UserController extends Controller
{
    public function list(){
    	$title = "Listagem de Utilizadores";
    	$users = User::all();

    	return view('users.index', compact('title', 'users'));
    }

    public function create(){
    	return view('users.add', compact('title'));
    }

	public function store(Request $request){
        // definir regras 
        $rules = array(
            'name'  => 'Required|Min:3|Max:80|Alpha',
            'email'     => 'Required|Between:3,64|Email|Unique:users',
            'password'  =>'Required|AlphaNum|Between:4,8|Confirmed',
            'password_confirmation'=>'Required|AlphaNum|Between:4,8'
        );

        // executar validate()
        $this->validate($request, $rules);

		
        // gravar na DB
        $input = $request->all();
        $input['password'] =  password_hash ( $input['password'], PASSWORD_DEFAULT); 
        User::create($input);

        // redirect para a vista seguinte
        return $this->list();
    }

    public function edit($id){
    	//return view('users.edit', ['id' => $id]);
    	return view('users.edit', compact('id'));
    }

    public function delete($id){
    	return "Delete Users $id";
    }

}
