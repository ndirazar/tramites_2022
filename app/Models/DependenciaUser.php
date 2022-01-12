<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DependenciaUser extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'dependencia_id',
        'user_id',
        'principal',

    ];

}
