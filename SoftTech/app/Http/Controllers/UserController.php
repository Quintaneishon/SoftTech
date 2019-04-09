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
        $especialidades = Especialidad::all();
        return view('users.index',[
            'users' => $users,
            'title' => $tittle,
            'especialidades' => $especialidades
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
        $especialidades = Especialidad::all();

        return view('users.create',['especialidades'=>$especialidades]);
    }



    public function store(Request $request)
    {
        $data=request()->validate([
            'name' => 'required',
            'email' => ['required','email','unique:users,email'],
            'password' => ['required','between:6,14'],
            'confirmacion' => ['required','same:password'],
            'descripcion' => 'max:100',
        ],[
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.email' => 'Tiene que ser un email valido',
            'email.unique' => 'Ese correo ya esta registrado',
            'password.required' => 'El campo contraseña es obligatorio',
            'password.between' =>'la contraseña debe ser entre 6 y 14 caracteres',
            'confirmacion.required' => 'El campo confirmacion es obligatorio',
            'confirmacion.same' => 'Las contraseñas no coinciden',
            'descripcion.max' => 'Maximo 140 caracteres',
        ]);

        $nombreReal = null;
        if ($request->file('uploadfile') != null) {
            $nombreReal = $request->uploadfile->getClientOriginalName();
            $request->uploadfile->storeAs('fotukischidas',$nombreReal,"public");
        }
        //dd($data);
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'foto' => $nombreReal,
            'descripcion' => $data['descripcion'],
            'especialidad_id' => $request->get('select'),
        ]);

        return redirect('usuarios');
    }

}
