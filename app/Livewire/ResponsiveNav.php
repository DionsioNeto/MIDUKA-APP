<?php

namespace App\Livewire;
use Livewire\Component;
use Livewire\Attributes\Lazy;
#[Lazy]

class ResponsiveNav extends Component{

    public $isNavSidbar = false;

    // Método para mostrar ou esconder o modal
    public function toggleNavSidbar(){
        $this->isNavSidbar = !$this->isNavSidbar;
    }

    public function render(){
        return view('livewire.responsive-nav');
    }

}
