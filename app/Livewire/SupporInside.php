<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Denuncias;

class SupporInside extends Component{
    public $email;
    public $description;
    public $tel;
    public $typeProblem;

    protected $rules = [
        'email' => 'required',
        'description' => 'required|min:20',
        // 'tel' => 'required',
        'typeProblem' => 'required',
    ];

    public function store(){
        $this->validate();
        $su = new Denuncias();
        $su->email = $this->email;
        $su->phoneNumber = "123";
        $su->user_id = auth()->user()->id;
        $su->description = $this->description;
        $su->typeProblem = $this->typeProblem;

        if( $su->save() ){
            $this->email = $this->description = $this->tel = $this->typeProblem = null;
            session()->flash('msg', 'Sucesso no envia da sua mensagen, aguarde pelo deferimento');
        }else{
            session()->flash('Erro', 'Sem Sucesso no envia da sua mensagen');
        }
    }

    public function render(){
        return view('livewire.suppor-inside');
    }
}
