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
        $denun =Denuncias::get();
        return view(
            'dashboard.dashboard',
            [
                "user" => $user,
                "content" => $content,
                "denun" => $denun,
            ]
        );
    }

    // public function usuarios(){
    //     $users = User::latest()->paginate();
    //     return view(
    //         'dashboard.dashboard-usuario',
    //         [
    //             "users"=> $users,
    //         ]
    //     );
    // }


    public function usuarios(Request $request){
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate()->withQueryString(); // Mantém o search na paginação

        return view('dashboard.dashboard-usuario', [
            'users' => $users,
        ]);
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
 