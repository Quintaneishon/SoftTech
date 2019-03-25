<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $tittle = 'Listado de usuarios';

        return view('users',[
            'users' => $users,
            'title' => $tittle
        ]);
    }
}
