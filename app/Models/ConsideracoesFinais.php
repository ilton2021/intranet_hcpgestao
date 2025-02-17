<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsideracoesFinais extends Model
{
    protected $table = 'ConsideracoesFinais';

    protected $fillable = [
		'pergunta',
        'resposta',
        'sair_hss',
        'continuar_hss',
        'departamento_id',
        'created_at',
        'updated_at'
    ];
}
