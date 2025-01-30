<?php

namespace App\Livewire;

use Livewire\Component;

 use Livewire\WithFileUploads;
 use Illuminate\Support\Facades\Storage;

class KeyBoard extends Component{

    public $inputText = '';
    public $isKeyboardVisible = false;

    // Método para adicionar uma letra ao input
    public function addCharacter($char)
    {
        $this->inputText .= $char;
    }

    // Método para remover a última letra do input
    public function removeCharacter()
    {
        $this->inputText = substr($this->inputText, 0, -1);
    }

    // Método para mostrar ou esconder o teclado
    public function toggleKeyboard()
    {
        $this->isKeyboardVisible = !$this->isKeyboardVisible;
    }
    public function render(){
        return view('livewire.key-board');
    }
}
