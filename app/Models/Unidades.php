<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidades extends Model
{
    protected $table = 'unidades';

    protected $fillable = [
        'nome',
        'nome_unidade',
        'imagem',
        'caminho',
        'horario',
        'telefone',
        'ouvidoria',
        'endereco',
        'texto',
        'sigla',
        'created_at',
        'updated_at'
    ];
}
