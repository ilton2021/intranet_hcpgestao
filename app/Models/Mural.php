<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mural extends Model
{
    protected $table = 'mural';

    protected $fillable = [
        'tipo',
        'imagem',
        'caminho',
        'video',
        'videominiatura',
        'titulo',
        'texto',
        'data_inicio',
        'data_fim',
        'unidade_id',
        'status',
        'created_at',
        'updated_at'
    ];
}
