<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'desarrollador_id','cliente_id','name','id','costo','cliente_borrar','desarrollador_borrar'
    ];
}
