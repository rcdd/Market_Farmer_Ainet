<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Comments;

class CommentsController extends Controller
{
    public function insert(Request $request){
    	//return var_dump($request);

    	$rules = array(
            'comment'  => 'Required|Min:3|Max:255',
        );

        // executar validate()
        $this->validate($request, $rules);

        $input = $request->all();
		//return $input;
		$com  = new Comments();
        $com->comment = $input['comment'];
        $com->advertisement_id = $input['advertisement_id'];
        $com->user_id = $input['user_id'];
        $com->parent_id = (isset($input['parent_id']) ? $input['parent_id'] : null);

        $com->save();

        session()->flash('success','Comment added');
        return redirect()->back();
    }

    public function delete($id){
        $com = Comments::findOrFail($id);

        if(count($com->hasReplay()) > 0){
            $com->hasReplay()->delete();
        }

        $com->delete();

        session()->flash('success','Comment(s) deleted');
        return redirect()->back();
    }
}
