<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardados extends Model{
    use HasFactory;
    protected $fillable = ['user_id', 'conteudo_id'];

    public function user(){
        return $this->belongsTo(user::class);
    }

    public function conteudo(){
        return $this->belongsTo(conteudo::class);
    }
}
