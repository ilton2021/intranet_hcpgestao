<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosQualidade extends Model
{
    protected $table = 'documentos_qualidade';

    protected $fillable = [
        'nome',
        'sigla',
        'caminho',
        'imagem',
		'imprimir',
        'setor_id',
        'created_at',
        'updated_at'   
    ];
}
