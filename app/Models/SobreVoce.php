<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SobreVoce extends Model
{
    protected $table = 'SobreVoce';

    protected $fillable = [
		'pergunta',
        'resposta',
        'departamento_id',
        'created_at',
        'updated_at'
    ];
}
