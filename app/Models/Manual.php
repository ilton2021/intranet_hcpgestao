<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manual extends Model
{
    protected $table = 'manual';

    protected $fillable = [
        'tipo_doc',
        'titulo',
        'caminho',
        'nome_arq',
        'tipo',
        'id_link',
        'id_menu',
        'created_at',
        'updated_at'
    ];
}
