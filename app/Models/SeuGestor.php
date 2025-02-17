<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeuGestor extends Model
{
    protected $table = 'SeuGestor';

    protected $fillable = [
		'pergunta',
        'resposta',
        'departamento_id',
        'created_at',
        'updated_at'
    ];
}
