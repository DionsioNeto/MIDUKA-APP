<?php
namespace App\Livewire;
use Livewire\Component;
use App\Models\Conteudo;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\Lazy;
#[Lazy]




class Imagens extends Component{
    use WithPagination, WithoutUrlPagination;
    public function render(){

        $conteudos= Conteudo::where('type_tag', 'jpg')
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
