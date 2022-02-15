<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ramais extends Model
{
    protected $table = 'ramais';

    protected $fillable = [
        'nome',
        'telefone',
        'unidade_id',
        'created_at',
        'updated_at'
    ];
}
