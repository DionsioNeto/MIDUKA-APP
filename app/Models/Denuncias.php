<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Denuncias extends Model{
    use HasFactory;
    
    protected $fillable = ['denuncia', 'user_id', 'conteudo_id'];

    protected $casts = [
        'denuncia' => 'array',
    ];


    public function user(){
        return $this->belongsTo(user::class);
    }

    public function conteudo(){
        return $this->belongsTo(conteudo::class);
    }

}
