<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumos extends Model
{
    protected $table = 'insumos';

    protected $fillable = [
        'tipos_insumos_id',
        'nome',
        'tipo_refeicao',
        'created_at',
        'updated_at'
    ];
}
