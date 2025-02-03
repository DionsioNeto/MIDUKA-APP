<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Support;

class SupporInside extends Component{
    public $email;
    public $description;

    protected $rules = [
        'email' => 'required',
        'description' => 'required|min:20',
        'phoneNumber' => 'required',
        'typeProblem' => 'required',
    ];

    public function store(){
        $su = new Support();
        $this->validate();
        $su->email = $this->email;
        $su->description = $this->description;
        $su->user_id = auth()->user()->id;

        if( $su->save() ){
            $this->email = $this->description = null;
            session()->flash('msg', 'Sucesso no envia da sua mensagen, aguarde pelo deferimento');
        }else{
            session()->flash('Erro', 'Sem Sucesso no envia da sua mensagen');
        }
    }

    public function render(){
        return view('livewire.suppor-inside');
    }
}
