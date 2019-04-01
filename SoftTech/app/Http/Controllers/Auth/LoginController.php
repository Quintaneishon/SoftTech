<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    public function showLogin(){
        return view('auth.welcome');
    }

    public function login(Request $request){
        $user_data = array(
            'email'  => $request->get('email'),
            'password' => $request->get('password')
        );

        if(Auth::attempt($user_data))
            return redirect('usuarios');
        else
            return back()->withInput()->with('error', 'Datos de inicio de sesiÃ³n incorrectos.');

    }
}
