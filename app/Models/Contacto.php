<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $fillable = [
        'nombre',
        'correo',
        'telefono',
        'empresa',
        'foto_url',
        'enlace_externo',
    ];
}
