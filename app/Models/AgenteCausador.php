<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgenteCausador extends Model
{
    protected $table = 'agente_causador';

    protected $fillable = [ 
        'descricao',
        'created_at',
        'updated_at'
    ];
}
