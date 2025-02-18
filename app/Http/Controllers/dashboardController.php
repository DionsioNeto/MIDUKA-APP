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
            return view('dashboard.dashboard');
    }
    public function usuarios(){
        return view('dashboard.dashboard-usuario');
    }
    public function denucias(){
        return view('dashboard.dashboard-denuncias');
    }
    public function conteudos(){
        return view('dashboard.dashboard-conteudos');
    }
    public function support(){
        return view('dashboard.dashboard-support');
    }
}
