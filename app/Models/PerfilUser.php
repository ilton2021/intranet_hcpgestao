<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilUser extends Model
{
    protected $table = 'perfil_user';

    protected $fillable = [
        'nome',
        'created_at',
        'updated_at'
    ];
}
