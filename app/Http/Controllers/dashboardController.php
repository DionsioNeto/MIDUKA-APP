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
        $user = User::get();
        $content = Conteudo::get();
        return view(
            'dashboard.dashboard',
            [
                "user" => $user,
                "content" => $content,
            ]
        );
    }

    public function usuarios(){
        $users = User::paginate();
        return view(
            'dashboard.dashboard-usuario',
            [
                "users"=> $users,
            ]
        );
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
