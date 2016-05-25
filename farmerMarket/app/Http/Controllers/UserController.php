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

        /*$password = $request::get('password');
        $request['password'] = password_hash ($password);
		*/
		
        // gravar na DB
        $input = $request->all();
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

    public function login(){
    	$users = User::all();
			$email = $_POST['email'];
			$password = $_POST['pwd'];
			//$email = input_value('email');
			//$password = input_value('pwd');


            if($user = $this->findByEmail($email)){
            	if(password_verify($password , $user->password)) {
					$_SESSION['login'] = $user->email;
					$_SESSION['name'] = $user->fullname;
					$_SESSION['type'] = $user->type;
					return "OK";
					//$this->redirectToHome();
				}
			}
			return "Not login";
    	//return $this->list();


    }

    public function findByEmail($userEmail){
        $users = User::all();
        foreach ($users as $user){
            if($userEmail==$user->email){
                return $user;
            }
        }
        return;
    }

}
