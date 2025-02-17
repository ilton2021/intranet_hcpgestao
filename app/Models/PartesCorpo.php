<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartesCorpo extends Model
{
    protected $table = 'partes_corpo';

    protected $fillable = [
        'descricao',
        'created_at',
        'updated_at'
    ];
}
