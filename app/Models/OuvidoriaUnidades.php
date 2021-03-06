<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OuvidoriaUnidades extends Model
{
    protected $table = 'ouvidoria_unidades';

    protected $fillable = [
        'nome',
        'email',
        'created_at',
        'updated_at'
    ];
}
