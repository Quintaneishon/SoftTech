<?php

namespace App\Http\Controllers;
use App\Project;
use App\ProjectMessages;
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
}
