<?php

namespace App\Http\Controllers;

use App\User;
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
}
