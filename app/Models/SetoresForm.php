<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetoresForm extends Model
{
    protected $table = 'setores_form';

    protected $fillable = [
		  'departamento',
      'created_at',
      'updated_at'
    ];
}
