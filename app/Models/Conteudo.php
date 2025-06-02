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

    public function comments(){
        return $this->hasMany(Comments::class)->latest();
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function likedByAuthUser() {
        return $this->hasMany(Like::class)->where('user_id', auth()->id());
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
