<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoIndicadores extends Model
{
    protected $table = 'grupo_indicadores';

    protected $fillable = [
        'nome',
        'nivel',
        'created_at',
        'updated_at'
    ];
}
