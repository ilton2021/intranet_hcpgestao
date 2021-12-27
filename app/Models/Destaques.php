<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destaques extends Model
{
    protected $table = 'destaques';

    protected $fillable = [
        'imagem',
        'caminho',
        'texto',
        'titulo',
        'data_inicio',
        'data_fim',
        'created_at',
        'updated_at'
    ];
}
