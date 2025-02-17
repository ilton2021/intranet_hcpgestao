<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControleVeiculos extends Model
{
    protected $table = 'controle_veiculos';

    protected $fillable = [
        'matricula',
		'setor',
        'funcao',
        'nome',
        'telefone',
        'placa',
        'tipo',
        'marcamodelo',
        'cor',
        'unidade_id',
        'created_at',
        'updated_at',
    ];
}
