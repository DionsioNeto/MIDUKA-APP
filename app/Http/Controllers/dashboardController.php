<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Mail\UserDeletedMail;
use Illuminate\Support\Facades\Mail;
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

    public function denucias(Request $request)
{
    $query = Denuncias::query();

    if ($request->has('search') && $request->search != '') {
        $query->where('denuncia', 'like', '%' . $request->search . '%');
    }

    // Paginação (recomendado) ou get()
    $denuncias = $query->paginate(12); // ou ->get();

    return view('dashboard.dashboard-denuncias', [
        'denuncias' => $denuncias
    ]);
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

    public function support(Request $request){
        $query = msg::query();

        if($request->has('search') && $request->search != '') {
            $query->where('typeProblem', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%' );
        }

        $denuncias = $query->latest()->paginate()->withQueryString();

        return view(
            'dashboard.dashboard-support',
            [
                "denuncias" => $denuncias,
            ]
        );
    }

    public function user($id){
        $user = User::findOrFail($id);
        $userCo = Conteudo::where('user_id', $id);
        return view(
            'dashboard.dashboard-user',
            [
                'user' => $user,
                'userCo' => $userCo
            ]
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
        return redirect("/dashboard-support")->with("delete", "Mensagem excluída com sucesso.");
    }

    public function destroy_conteudo($id){
        Conteudo::findOrFail($id)->delete();
        return redirect("/dashboard-conteudos")->with("delete", "Conteudo Excluído com sucesso.");
    }

    public function destroy_user($id){
        $user = User::findOrFail($id);
        $email = $user->email;
        $name = $user->name;

        // Enviar e-mail antes da exclusão
        Mail::to($email)->send(new UserDeletedMail($name));

        $user->delete();
        return redirect("/dashboard-usuario")->with("delete", "Usuário Excluído com sucesso.");
    }

    public function destroy_denuncia($id){
        Denuncias::findOrFail($id)->delete();
        return redirect("/dashboard-denuncias")->with("delete", "Denúncia Excluída com sucesso.");
    }
}
 