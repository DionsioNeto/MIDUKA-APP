<?php

namespace App\Livewire;
use App\Models\Conteudo;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\Lazy;
#[Lazy]


class Videos extends Component{
    use WithPagination, WithoutUrlPagination;

    public function render(){
        $conteudos = Conteudo::latest()
        ->paginate(4)
        ->where('type_tag', 'mp4');

        return view(
            'livewire.videos',
            [
                'conteudos' => $conteudos,
            ]
        );
    }
}
