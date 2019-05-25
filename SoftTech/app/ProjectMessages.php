<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectMessages extends Model
{
    protected $table = 'projects_messages';

    protected $fillable = [
        'remitente','destinatario','mensaje','project_id'
    ];
}
