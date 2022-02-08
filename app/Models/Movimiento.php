<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    public $fillable = [
        'nota_id',
        'archivo_anexo',
        'observaciones',
        'estado_id',
        'user_id',
    ];
}
