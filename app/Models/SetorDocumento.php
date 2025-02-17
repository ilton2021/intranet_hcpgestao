<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetorDocumento extends Model
{
    protected $table = 'setor_documento';

    protected $fillable = [
	    'setor',
        'sigla',
        'unidade_id',
        'created_at',
        'updated_at'
    ];
}
