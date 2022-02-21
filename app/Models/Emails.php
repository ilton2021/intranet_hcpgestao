<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emails extends Model
{
    protected $table = 'emails';
    
    protected $fillable = [
        'nome',
        'email',
        'unidade_id',
        'setor_id',
        'created_at',
        'updated_at'
    ];
}
