<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicadores extends Model
{
    protected $table = 'indicadores';

    protected $fillable = [
        'grupo_id',
        'exibe',
        'status',
        'nome',
        'link',
        'unidade_id',
        'created_at',
        'updated_at'
    ];
}
