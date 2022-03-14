<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilUserIndica extends Model
{
    protected $table = 'perfil_user_indica';

    protected $fillable = [
        'perfil_id',
        'indicador_id',
        'created_at',
        'updated_at'
    ]; 
}
