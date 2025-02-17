<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualFarmacia extends Model
{
    protected $table = 'manual_farmacia';

    protected $fillable = [
        'tipo',
        'tipo_doc',
        'titulo',
        'nome_arquivo',
        'caminho',
        'id_link',
        'unidade_id',
        'created_at',
        'updated_at'
    ];
}
