<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposInsumos extends Model
{
    protected $table = 'tipos_insumos';

    protected $fillable = [
        'nome',
        'tipo_refeicao',
        'created_at',
        'updated_at'
    ];
}
