<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class CabinetController extends Controller
{
    public function index(){
        $user = auth()->user();
        return view('cabinet.index', ['user' => $user]);
    }

    public function edit(){
        $user = auth()->user();
        return view('cabinet.edit', ['user'=>$user]);
    }
    
    public function update(Request $request){
        $user = auth()->user();

        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email,' . $user->id,
            'password'=>'nullable|min:8|confirmed',
        ],['name.required' => 'обязательно для заполнения']);

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->filled('password')){
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('cabinet.index')->with('success', 'Данные обновлены');
    }
}
