<?php

namespace App\Http\Controllers;
use App\Project;
use App\ProjectMessages;
use App\Peticion;
use App\Reporte;
use App\User;
use Illuminate\Http\Request;
use Storage;

class ProjectController extends Controller
{
    public function sendMessage(Request $request)
    {

        $message=ProjectMessages::create([
            'project_id'=>$request['project_id'],
            'remitente' => $request['remitente'],
            'destinatario' => $request['destinatario'],
            'mensaje' => $request['text']
        ]);

        return back();
    }

    public function crearAvance(Request $request){
        $project = Project::findOrFail($request['project_id']);
        $titulo='Entrega Final';
        if($project->avance_1 == null)
            $titulo='Entrega Primer Avance';
        else if($project->avance_2 == null)
            $titulo='Entrega Segundo Avance';
        Peticion::create([
            'desarrollador_id' => $project->desarrollador_id,
            'cliente_id' => $project->cliente_id,
            'resumen' => $request['date'],
            'name' => $titulo,
            'project_id' => $project->id
        ]);
        return back()->with('success','Fecha enviada correctamente!');
        // return $cliente.' '.$request['desarrolladorID'];
    }

    public function crearReporte(Request $request){
        $project = Project::findOrFail($request['project_id']);
        Reporte::create([
            'desarrollador_id' => $project->desarrollador_id,
            'cliente_id' => $project->cliente_id,
            'reporte' => $request['reporte'],
            'reporto' => $request['reporto'],
            'project_id' => $project->id
        ]);
        return back()->with('success','Reporte enviado correctamente!');
        // return $cliente.' '.$request['desarrolladorID'];
    }

    public function crearCosto(Request $request){
        $project = Project::findOrFail($request['project_id']);
        Peticion::create([
            'desarrollador_id' => $project->desarrollador_id,
            'cliente_id' => $project->cliente_id,
            'resumen' => $request['money'],
            'name' => 'Costo proyecto '.$project->name,
            'project_id' => $project->id
        ]);
        return back()->with('success','Costo enviado correctamente!');
        // return $cliente.' '.$request['desarrolladorID'];
    }

    public function borrarProyecto(Request $request){
        $project = Project::findOrFail($request['project_id']);
        if($request['quien'] == 'cliente'){
            $project->cliente_borrar='S';
            $desarrollador = User::findOrFail($project->desarrollador_id);
            $cali = $desarrollador->calificacion;
            $cali = ($cali + $request['numero']) / 2;
            $desarrollador->calificacion=$cali;
            $desarrollador->save();
        }else{
            $project->desarrollador_borrar='S';
            $cliente = User::findOrFail($project->cliente_id);
            $numero=$cliente->proyectos;
            $numero++;
            $cliente->proyectos=$numero;
            $cliente->save();
        }

        $project->save();
        return back()->with('success','Proyecto eliminado correctamente!');
        // return $cliente.' '.$request['desarrolladorID'];
    }
}
