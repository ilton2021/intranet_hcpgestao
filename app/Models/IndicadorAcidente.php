<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicadorAcidente extends Model
{
    protected $table = 'indicador_acidente';

    protected $fillable = [
        'data_evento',
        'dia_semana',
        'nome',
        'funcao',
        'setor',
        'genero',
        'idade',
        'tempo_funcao',
        'tipo',
        'situacao',
        'agente_causador',
        'turno',
        'momento_jornada',
        'local_incidente',
        'horario_acidente',
        'parte_corpo_atingida',
        'status',
        'dias_afastamento',
        'descricao_acidente',
        'responsavel_preenchimento',
        'apos_horas_trabalhadas'
    ];
}
