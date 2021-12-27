<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProtocolosInstitucionais extends Model
{
    protected $table = 'protocolos_institucionais';

    protected $fillable = [
        'nome',
        'setor',
        'imagem',
        'caminho',
        'created_at',
        'updated_at'
    ];
}
