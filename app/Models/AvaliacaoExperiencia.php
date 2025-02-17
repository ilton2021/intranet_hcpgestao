<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvaliacaoExperiencia extends Model
{
    protected $table = 'avaliacao_experiencia';

    protected $fillable = [
        'colaborador',
        'vaga',
        'unidade',
        'gestor',
        'area',
        'continuidade',
        'resultado',
        'capacidade',
        'produtividade',
        'iniciativa',
        'colaboracao',
        'relacionamento',
        'pontualidade',
        'assiduidade',
        'seguranca',
        'created_at',
        'updated_at',
    ];
}
