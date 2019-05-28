<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table = 'reportes';

    protected $fillable = [
        'desarrollador_id','cliente_id','project_id','reporte','reporto'
    ];
}
