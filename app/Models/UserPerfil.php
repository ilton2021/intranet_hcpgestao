<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPerfil extends Model
{
    protected $table = 'user_perfil';

    protected $fillable = [
        'users_id',
        'perfil_id',
        'created_at',
        'updated_at'
    ]; 
}
