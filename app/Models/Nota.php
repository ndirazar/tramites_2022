<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    public $incrementing = false;

    public $fillable = [
        'id',
        'titulo',
        'descripcion',
        'nombre',
        'telefono',
        'archivo',
        'dependencia_id',
        'estado_id',
        'user_id',
        'finalizada',
        'visto',
    ];
}
