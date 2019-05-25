<?php

namespace App\Http\Controllers;
use App\Project;
use App\ProjectMessages;
use App\Peticion;
use Illuminate\Http\Request;

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
}
