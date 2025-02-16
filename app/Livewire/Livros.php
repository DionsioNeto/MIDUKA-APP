<?php
namespace App\Livewire;
use Livewire\Component;
use App\Models\Conteudo;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\Lazy;
#[Lazy]


class Livros extends Component{
    use WithPagination, WithoutUrlPagination;
    public function render(){

        $conteudos = Conteudo::where('type_tag', 'pdf')
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
