<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
    protected $fillable = [
        'titulo',
        'descripcion',
        'categoria',
        'duracion',
        'icono',
        'destacado',
        'video_url',
        'imagen'
    ];
}
