<?php
namespace App\Livewire;
use Livewire\Component;
use App\Models\Conteudo;
use Livewire\Attributes\Lazy;
#[Lazy]



class Imagens extends Component{
    public function render(){

        $conteudos= Conteudo::where('type_tag', 'img')
        ->orderBy('created_at', 'desc')
        ->get();

        return view(
            'livewire.imagens',
            [
                'conteudos' => $conteudos,
            ]
        );
    }
}
