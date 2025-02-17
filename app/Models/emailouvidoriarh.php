<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emailouvidoriarh extends Model
{
    protected $table = 'emailouvidoriarh';

    protected $fillable = [
        'id',
        'email',
        'token',
        'status',
        'created_at',
        'updated_at'
    ];
}
