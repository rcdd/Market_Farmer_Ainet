<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Advertisement;
use App\Media;
use Auth;

//files
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class SearchController extends Controller
{
    
    public function mainSearch(){
        //get keywords input for search
        $keyword=  Input::get('mainSearch');

        $searchTerms = explode(' ', $keyword);

        //search that advertisement in Database
        $advertisements = Advertisement::where('blocked', '=', '0')->where(function($query)
            {
                $query->where('name', 'LIKE', '%' . $searchTerms . '%');
            })->get();

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