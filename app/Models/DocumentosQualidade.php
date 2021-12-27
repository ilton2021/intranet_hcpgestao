<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosQualidade extends Model
{
    protected $table = 'documentos_qualidade';

    protected $fillable = [
        'nome',
        'caminho',
        'imagem',
        'created_at',
        'updated_at'   
    ];
}
