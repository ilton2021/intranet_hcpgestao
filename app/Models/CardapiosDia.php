<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardapiosDia extends Model
{
    protected $table = 'cardapios_dia';

    protected $fillable = [
        'dia',
        'unidade_id',
        'insumos_1_id',
        'insumos_2_id',
        'insumos_3_id',
        'insumos_4_id',
        'insumos_5_id',
        'insumos_6_id',
        'insumos_7_id',
        'insumos_8_id',
        'insumos_9_id',
        'insumos_10_id',
        'insumos_11_id',
        'tipo_refeicao',
        'inativa',
        'created_at',
        'updated_at'
    ];
}
