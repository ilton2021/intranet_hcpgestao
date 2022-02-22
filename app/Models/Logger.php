<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logger extends Model
{
    protected $table = 'logger';

    protected $fillable = [
        'user_id',
        'tela',
        'idTabela',
        'created_at',
        'updated_at'
    ];
}
