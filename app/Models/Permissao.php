<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    protected $table = 'permissao';

    protected $fillable = [
        'tela',
        'created_at',
        'updated_at'
    ];
}
