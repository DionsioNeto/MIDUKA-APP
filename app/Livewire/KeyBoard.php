<?php

namespace App\Livewire;

use Livewire\Component;

 use Livewire\WithFileUploads;
 use Illuminate\Support\Facades\Storage;

class KeyBoard extends Component{

    // public $dataToCopy = "Texto a ser copiado para o clipboard"; // Dado que será copiado

    // // Função que simula a preparação do dado para copiar
    // public function prepareData()
    // {
    //     // Aqui você pode preparar os dados conforme necessário, por exemplo, manipular arquivos ou conteúdo.
    //     $this->dataToCopy = "Novo conteúdo gerado para o clipboard!";
    // }

    public $ff;

    public function s(){
        dd($this->ff);
    }

    public function render(){
        return view('livewire.key-board');
    }
}
