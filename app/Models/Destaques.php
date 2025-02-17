<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destaques extends Model
{
    protected $table = 'destaques';

    protected $fillable = [
        'tipo',
        'imagem',
        'video',
        'caminho',
        'texto',
        'titulo',
        'subtitulo',
        'data_inicio',
        'data_fim',
        'imagem2',
        'video2',
        'caminho2',
        'tipo2',
        'imagem3',
        'video3',
        'caminho3',
        'tipo3',
        'imagem4',
        'video4',
        'caminho4',
        'tipo4',
        'imagem5',
        'video5',
        'caminho5',
        'tipo5',
        'imagem6',
        'video6',
        'caminho6',
        'tipo6',
		'status',
        'unidade_id',
        'created_at',
        'updated_at'
    ];
}
