<?php
namespace App\Livewire;
use Livewire\Component;
use App\Models\Conteudo;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\Lazy;
#[Lazy]



class Audios extends Component{
    use WithPagination, WithoutUrlPagination;
    public function render() {

        $conteudos = Conteudo::where('type_tag', 'mp3')
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
