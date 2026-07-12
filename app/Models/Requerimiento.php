<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requerimiento extends Model
{
    protected $fillable = [
        'user_id',
        'categoria',
        'titulo',
        'descripcion',
        'prioridad',
        'estado',
        'respuesta_admin',
        'fecha_cierre',
    ];
}