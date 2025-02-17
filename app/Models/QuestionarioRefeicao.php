<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionarioRefeicao extends Model
{
    protected $table = 'questionario_refeicao';

    protected $fillable = [
        'dia',
        'unidade_id',
        'tipo_refeicao',
        'resposta1',
        'resposta2',
        'resposta3',
        'resposta4',
        'created_at',
        'updated_at'
    ];
}
