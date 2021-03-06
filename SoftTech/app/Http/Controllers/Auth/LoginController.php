<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;

class LoginController extends Controller
{
    public function showLogin(){
        return view('auth.welcome');
    }

    public function login(){
        $data=request();
        $user_data = array(
            'email'  => $data['email'],
            'password' => $data['password']
        );

        if(Auth::attempt($user_data)){
            $tipo=User::where('email',$user_data['email'])->value('tipo');
            $id=User::where('email',$user_data['email'])->value('id');
            
            if($tipo=='cliente'){
                Session::put('login', $id);
                return redirect('cliente/'.$id);
            }else
                return redirect('desarrollador/'.$id);
        }
        else
            return back()->withInput()->with('error', 'Datos de inicio de sesion incorrectos.');

    }

    public function logout(){
        try{
            Auth::logout();
            return redirect('/');
        }
        catch(Throwable $e){
            ;
        }
    }
}
