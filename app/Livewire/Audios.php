<?php
namespace App\Livewire;
use Livewire\Component;
use App\Models\Conteudo;
use Livewire\Attributes\Lazy;
#[Lazy]


class Audios extends Component{
    public function render() {

        $conteudos = Conteudo::where('type_tag', 'audios')
        ->orderBy('created_at', 'desc')
        ->get();

        return view(
            'livewire.audios',
            [
                'conteudos' => $conteudos,
            ]
        );
    }
}
