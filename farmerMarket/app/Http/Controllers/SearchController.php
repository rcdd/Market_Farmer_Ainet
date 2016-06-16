<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Advertisement;
use Auth;

class SearchController extends Controller
{
    
    public function mainSearch(Request $request){

        $keyword =  $request['mainSearch'];

        $searchTerms = explode(' ', $keyword);

        $query = Advertisement::where('blocked', '=', '0');

        foreach($searchTerms as $term)
        {
            $query->where('name', 'LIKE', '%'. $term .'%');
        }

        $advertisements = $query->get();



        return view('advertisements.index', ['advertisements' => $advertisements, 'title' => "List of Advertisements founded"]);

        /*if(!$advertisements)
        {
            $users = Users::where('blocked', '=', '0')->where(function($query)
            {
                $query->where('name', '=', $keyword)
                    ->orWhere('location', '=', $keyword);
            })->get();
            return view('user.index', ['advertisements' => $users, 'title' => "List of Users"]);
        } else {
            
        }*/
    }

}