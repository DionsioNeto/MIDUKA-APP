<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Conteudo;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\Lazy;
#[Lazy]



class Profile extends Component{
    use WithPagination, WithoutUrlPagination;


    public $modalEditProfile = false;

    public function ToggleModal(){
        $this->modalEditProfile = !$this->modalEditProfile;
    }


    public function render(){
        $conteudos = Conteudo::where('id', auth()->user()->id)->get();
        return view('livewire.profile', ['conteudos' => $conteudos]);
    }
}
