<?php

namespace App\Livewire;
use Livewire\Component;
use Livewire\Attributes\Lazy;

#[Lazy]

class AllPages extends Component
{
    public function render()
    {
        return view('livewire.all-pages');
    }
}
