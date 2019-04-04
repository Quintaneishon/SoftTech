<?php

namespace App\Http\Controllers;

use Image;
use App\User;
use Storage;
use App\Especialidad;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $tittle = 'Listado de Desarrolladores';

        return view('users.index',[
            'users' => $users,
            'title' => $tittle
        ]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        $especialidad = Especialidad::find($user->especialidad_id);

        return view('users.show',[
            'user' => $user,
            'especialidad' => $especialidad
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $data=request()->validate([
            'name' => 'required',
            'email' => ['required','email','unique:users,email'],
            'password' => ['required','between:6,14'],
        ],[
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.email' => 'Tiene que ser un email valido',
            'email.unique' => 'Ese correo ya esta registrado',
            'password.required' => 'El campo contraseña es obligatorio',
            'password.between' =>'la contraseña debe ser entre 6 y 14 caracteres'
        ]);

        $nombreReal = $request->uploadfile->getClientOriginalName();
        $request->uploadfile->storeAs('fotukischidas',$nombreReal,"public");

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        return redirect('usuarios');
    }
}
