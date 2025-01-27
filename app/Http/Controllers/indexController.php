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
        return view('project.index');
    }
    //Rota para criação de conteúdos...
    public function criar(){
        return view('project.criar');
    }
    //Rota que mostra um conteúdo...
    public function show($id){
        $item = Conteudo::findOrFail($id);
        return view('project.ver', ['item' => $item]);
    }
}
