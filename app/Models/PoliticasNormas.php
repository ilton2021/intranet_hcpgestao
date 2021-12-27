<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliticasNormas extends Model
{
    protected $table = 'politicas_normas';

    protected $fillable = [
        'nome',
        'setor',
        'imagem',
        'caminho',
        'created_at',
        'updated_at'
    ];
}
