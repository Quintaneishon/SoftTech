<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peticion extends Model
{
    protected $table = 'peticiones';

    protected $fillable = [
        'desarrollador_id','cliente_id','resumen','aceptado','contestado','name','project_id'
    ];

}
