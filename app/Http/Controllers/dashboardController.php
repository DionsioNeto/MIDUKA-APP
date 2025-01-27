<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{
    Conteudo,
    User,
};

class dashboardController extends Controller{
    //Rota da Dashboard da aplicação...
    public function index(){
            return view('dashboard');
    }
}
