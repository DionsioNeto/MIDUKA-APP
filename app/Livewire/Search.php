<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\User;
use App\Models\Conteudo;

class Search extends Component{
    public $search = ''; // Variável para armazenar a pesquisa

    public function render(){

        if (auth()->check() && !auth()->user()->hasVerifiedEmail()) {
            abort(redirect('/email/verify'));
        }

        $users = User::where('name', 'like', '%'.$this->search.'%')
        ->orWhere('email', 'like', '%'.$this->search.'%')
        ->get();

        $content = Conteudo::where('description', 'like', '%'.$this->search.'%')
        // ->orWhere('email', 'like', '%'.$this->search.'%')
        ->get();

        return view(
            'livewire.search',
            [
                "users" => $users,
                "content" => $content,
            ]
        );
    }
}
