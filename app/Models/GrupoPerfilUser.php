<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoPerfilUser extends Model
{
    protected $table = 'grupo_perfil_user';

    protected $fillable = [
        'grupo_indic_id',
        'perfil_user_id',
        'created_at',
        'updated_at'
    ];
}
