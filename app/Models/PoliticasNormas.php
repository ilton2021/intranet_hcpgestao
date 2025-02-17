<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliticasNormas extends Model
{
    protected $table = 'politicas_normas';

    protected $fillable = [
        'nome',
        'sigla',
        'setor',
        'imagem',
        'caminho',
		'imprimir',
        'setor_id',
        'created_at',
        'updated_at'
    ];
}
