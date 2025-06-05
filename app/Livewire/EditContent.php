<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Conteudo;

class EditContent extends Component{
    public function render(){
        $conteudos = Conteudo::get();
        return view(
            'livewire.edit-content',
            ['conteudos' => $conteudos]
        );
    }
}
