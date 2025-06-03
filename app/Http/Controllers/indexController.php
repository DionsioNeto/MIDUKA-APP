<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{
    Conteudo,
    User,
};

class indexController extends Controller{
    //Rota principal da aplicação...
    public function index() {
        if (auth()->check()) {
        // Usuário autenticado e verificado
            if (!auth()->user()->hasVerifiedEmail()) {
                return redirect('/email/verify');
            }
        }
        return view('project.index');
    }
    //Rota para criação de conteúdos...
    public function criar(){
        if (auth()->check()) {
        // Usuário autenticado e verificado
            if (!auth()->user()->hasVerifiedEmail()) {
                return redirect('/email/verify');
            }
        }
        return view('project.criar');
    }
    //Rota que mostra um conteúdo...
    public function show($id){
        if (auth()->check()) {
        // Usuário autenticado e verificado
            if (!auth()->user()->hasVerifiedEmail()) {
                return redirect('/email/verify');
            }
        }
        $item = Conteudo::findOrFail($id);
        return view('project.ver', ['item' => $item]);
    }
}