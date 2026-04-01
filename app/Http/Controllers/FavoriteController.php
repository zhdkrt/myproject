<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FavoriteController extends Controller
{
    public function index(){
        $favorites = Auth::user()->favorites()->with('vacancy.company')->latest()->paginate(10);

        return view('cabinet.favorites', [
            'favorites' => $favorites,
        ]);
    }
}

