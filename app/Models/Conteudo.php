<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conteudo extends Model
{
    use HasFactory;
    protected $fillable = ['content'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function Likes(){
        return $this->hasMany(Like::class)
            ->where(function($query){
                if(auth()->check()){
                    $query->where('user_id', auth()->user()->id);
                }
            });
    }

    public function Guardados(){
        return $this->hasMany(Guardados::class)
            ->where(function($query){
                if(auth()->check()){
                    $query->where('user_id', auth()->user()->id);
                }
            });
    }
}
