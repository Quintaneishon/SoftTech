<?php

namespace App\Http\Controllers;

use Image;
use App\User;
use Storage;
use App\Especialidad;
use App\Peticion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('tipo','desarrollador')->get();
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

    public function createUser()
    {
        $especialidades = Especialidad::all();

        return view('users.createUser',['especialidades'=>$especialidades]);
    }



    public function storeDesarrollador(Request $request)
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
            'tipo' => 'desarrollador',
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'foto' => $nombreReal,
            'descripcion' => $data['descripcion'],
            'especialidad_id' => $request->get('select'),
        ]);

        return redirect('usuarios');
    }

    public function storeCliente(Request $request)
    {
        $data=request()->validate([
            'name2' => 'required',
            'email2' => ['required','email','unique:users,email'],
            'password2' => ['required','between:6,14'],
            'confirmacion2' => ['required','same:password2'],
        ],[
            'name2.required' => 'El campo nombre es obligatorio',
            'email2.required' => 'El campo email es obligatorio',
            'email2.email' => 'Tiene que ser un email valido',
            'email2.unique' => 'Ese correo ya esta registrado',
            'password2.required' => 'El campo contraseña es obligatorio',
            'password2.between' =>'la contraseña debe ser entre 6 y 14 caracteres',
            'confirmacion2.required' => 'El campo confirmacion es obligatorio',
            'confirmacion2.same' => 'Las contraseñas no coinciden',
        ]);

        User::create([
            'name' => $data['name2'],
            'tipo' => 'cliente',
            'email' => $data['email2'],
            'password' => bcrypt($data['password2']),
            'foto' => null,
            'descripcion' => null,
            'especialidad_id' => null,
        ]);

        return redirect('usuarios');
    }

    public function logout(){
        try{
            Auth::logout();
            return redirect()->route('/');
        }
        catch(Throwable $e){
            ;
        }
    }

    public function dashboardDesarrollador($id)
    {
        $user = User::findOrFail($id);
        $especialidad = Especialidad::find($user->especialidad_id);
        $peticion = Peticion::where('desarrollador_id',$id)->where('contestado','N')->get();
        return view('users.dashboardDesarrollador',[
            'user' => $user,
            'especialidad' => $especialidad,
            'peticion' => $peticion,
        ]);
    }

    public function dashboardCliente($id)
    {
        $user = User::findOrFail($id);
        $peticion = Peticion::where('cliente_id',$id)->where('contestado','S')->get();
        return view('users.dashboardCliente',[
            'user' => $user,
            'peticion' => $peticion,
        ]);
    }

    public function crearTrato(Request $request){
        $cliente=Session::get('login');

        Peticion::create([
            'desarrollador_id' => $request['desarrolladorID'],
            'cliente_id' => $cliente,
            'resumen' => $request['resumen'],
            'name' => $request['titleProyect']
        ]);
        return back()->with('success','Resumen enviado correctamente!');
        // return $cliente.' '.$request['desarrolladorID'];
    }

    public function contestar($respuesta,$id){
        $peticion=Peticion::find($id);
        $peticion->contestado='S';

        if($respuesta=='aceptar')
            $peticion->aceptado='S';

        $peticion->save();
        return back();
    }

    public function eliminarPeticion($id){
        $peticion=Peticion::find($id);
        $peticion->delete();
        return back();
    }

}
