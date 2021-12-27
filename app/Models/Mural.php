<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mural extends Model
{
    protected $table = 'mural';

    protected $fillable = [
        'imagem',
        'caminho',
        'titulo',
        'texto',
        'data_inicio',
        'data_fim',
        'created_at',
        'updated_at'
    ];
}
