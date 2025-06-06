<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class msg extends Model{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function user(){
        return $this->belongsTo(user::class);
    }
}
