<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{
    Conteudo,
    User,
    Denuncias
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
        $users = User::latest()->paginate(3);
        return view(
            'dashboard.dashboard-usuario',
            [
                "users"=> $users,
            ]
        );
    }


    public function denucias(){
        $denuncias = Denuncias::get();
        return view(
            'dashboard.dashboard-denuncias'
        );
    }


    public function conteudos(){
        $itens = Conteudo::latest()->paginate(3);
        return view(
            'dashboard.dashboard-conteudos',
            [
                'itens' => $itens,
            ]
        );
    }

    public function support(){
        $denuncias = Denuncias::latest()->paginate(3);

        return view(
            'dashboard.dashboard-support',
            [
                "denuncias" => $denuncias,
            ]
        );
    }

    public function user($id){
        $user = User::findOrFail($id);
        return view(
            'dashboard.dashboard-user',
            [
                'user' => $user
            ]
        );
    }
}
 