<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Support;

class SupporInside extends Component{
    public $email;
    public $description;
    public $phoneNumber;
    public $typeProblem;

    protected $rules = [
        'email' => 'required',
        'description' => 'required|min:20',
        'phoneNumber' => 'required',
        'typeProblem' => 'required',
    ];

    public function store(){
        $this->validate();
        $su = new Support();
        $su->email = $this->email;
        $su->description = $this->description;
        $su->user_id = auth()->user()->id;

        if( $su->save() ){
            $this->email = $this->description = $this->phoneNumber = $this->typeProblem = null;
            session()->flash('msg', 'Sucesso no envia da sua mensagen, aguarde pelo deferimento');
        }else{
            session()->flash('Erro', 'Sem Sucesso no envia da sua mensagen');
        }
    }

    public function render(){
        return view('livewire.suppor-inside');
    }
}
