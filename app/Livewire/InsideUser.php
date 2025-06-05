<?php

namespace App\Livewire;
use Livewire\Component;
use App\Livewire\Usuario;
use App\Models\User;
use App\Models\Conteudo;


class InsideUser extends Component{

    public function render($id){
        if (auth()->check() && !auth()->user()->hasVerifiedEmail()) {
            abort(redirect('/email/verify'));
        }

        $usuario = User::findOrFail($id);
        return view('livewire.inside-user', ['usuario' => $usuario,]);
    }
}

// $getId = new Usuario();

// $id = new InsideUser;

// $id->render($getId->export);

