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
        'imagem2',
        'caminho2',
        'imagem3',
        'caminho3',
        'imagem4',
        'caminho4',
        'imagem5',
        'caminho5',
        'imagem6',
        'caminho6',
        'unidade_id',
        'created_at',
        'updated_at'
    ];
}
