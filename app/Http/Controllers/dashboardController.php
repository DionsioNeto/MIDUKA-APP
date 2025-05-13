<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{
    Conteudo,
    User,
    Denuncias,
    msg,
};

class dashboardController extends Controller{
    //Rota da Dashboard da aplicação...
    public function index(){
        $user = User::get();
        $content = Conteudo::get();
        $denun = msg::get();
        return view(
            'dashboard.dashboard',
            [
                "user" => $user,
                "content" => $content,
                "denun" => $denun,
            ]
        );
    }

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
            'dashboard.dashboard-denuncias',
            ['denuncias' => $denuncias]
        );
    }

    public function conteudos(Request $request){
        $query = Conteudo::query();
    
        // Se houver termo de pesquisa, aplicamos o filtro
        if ($request->has('search') && $request->search != '') {
            $query->where('description', 'like', '%' . $request->search . '%')
                  ->orWhere('type_tag', 'like', '%' . $request->search . '%');
        }
    
        $itens = $query->latest()->paginate()->withQueryString(); // Mantém o search na paginação
    
        return view('dashboard.dashboard-conteudos', [
            'itens' => $itens,
        ]);
    }

    public function support(){
        $denuncias = msg::latest()->paginate(3);

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
            ['user' => $user]
        );
    }

    public function show_support($id){
        $item = msg::findOrFail($id);
        return view(
            'dashboard.dashboard-show-support',
            ['item' => $item]
        );
    }

    public function show_conteudo($id){
        $item = Conteudo::findOrFail($id);
        return view('dashboard.dashboard-conteudo-show', ['item' => $item]);
    }

    // Lógica de deleção

    public function destroy_msg($id){
        msg::findOrFail($id)->delete();
        return redirect("/dashboard-support")->with("delete", "Conteudo deletado com sucesso.");
    }

    public function destroy_conteudo($id){
        Conteudo::findOrFail($id)->delete();
        return redirect("/dashboard-support")->with("delete", "Conteudo deletado com sucesso.");
    }
}
 