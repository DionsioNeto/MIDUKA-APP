<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comments extends Model{
     use HasFactory;

    protected $fillable = ['content', 'user_id', 'conteudo_id', 'id_to'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function conteudo(){
        return $this->belongsTo(Conteudo::class);
    }

    public function destinatario(){
        return $this->belongsTo(User::class, 'id_to');
    }


}
