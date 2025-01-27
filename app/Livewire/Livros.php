<?php
namespace App\Livewire;
use Livewire\Component;
use App\Models\Conteudo;


class Livros extends Component{
    public function render(){

        $conteudos = Conteudo::where('type_tag', 'livros')
        ->orderBy('created_at', 'desc')
        ->get();

        return view(
            'livewire.livros',
            [
                'conteudos' => $conteudos,
            ]
        );
    }
}
