<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissaoUser extends Model
{
    protected $table = 'permissao_user';

    protected $fillable = [
        'user_id',
        'permissao_id',
        'created_at',
        'updated_at'
    ];
}
