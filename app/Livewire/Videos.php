<?php

namespace App\Livewire;
use App\Models\Conteudo;
use Livewire\Component;

class Videos extends Component{
    public function render(){
        $conteudos = Conteudo::where('type_tag', 'video')
        ->orderBy('created_at', 'desc')
        ->get();

        return view(
            'livewire.videos',
            [
                'conteudos' => $conteudos,
            ]
        );
    }
}
