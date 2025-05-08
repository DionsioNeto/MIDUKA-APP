<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Denuncias extends Model{
    
    protected $fillable = ['denuncia'];

    protected $casts = [
        'denuncia' => 'array',
    ];
}
