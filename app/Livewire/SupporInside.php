<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\msg;
use Livewire\Attributes\Lazy;

#[lazy]

class SupporInside extends Component{
    public $email;
    public $description;
    public $phoneNumber;
    public $typeProblem;

    protected $rules = [
    'email' => 'required',
    'description' => 'required',
    'phoneNumber' => 'required',
    'typeProblem' => 'required',
    ];

    protected $messages = [
        'email.required' => 'O email não deve ficar vago',
        'description.required' => 'A descrição não deve ficar vaga',
        'phoneNumber.required' => 'O número de telefone não deve ficar vago',
        'typeProblem.required' => 'O tipo de problema não deve ficar vago',
    ];


    public function store(){
        $this->validate();
        $su = new msg();
        $su->email = $this->email;
        $su->phoneNumber = $this->phoneNumber;
        $su->user_id = auth()->user()->id;
        $su->description = $this->description;
        $su->typeProblem = $this->typeProblem;

        if( $su->save() ){
            $this->email = $this->description = $this->tel = $this->typeProblem = null;
            session()->flash('msg', 'A sua mensagem foi recebida com sucesso, enviaremos um email.');
        }else{
            session()->flash('Erro', 'Sem Sucesso ao envia da sua mensagen');
        }
    }

    public function render(){
        if (auth()->check() && !auth()->user()->hasVerifiedEmail()) {
            abort(redirect('/email/verify'));
        }
        return view('livewire.suppor-inside');
    }

    public function placeholder(){
        return <<<'HTML'
        <div class="loading">
        
                    <div class="bloco"></div>
                    <div class="bloco"></div>
                    <div class="bloco"></div>
                    <div class="bloco"></div>
                    <div class="bloco"></div>
        
                <style>
                    .bloco{
                        width: 100%;
                        height: 30px;
                        background: var(--destaque);
                        border: 3px solid var(--link);
                        border-radius: 20px;
                    }
                    div.loading{
                        padding-top: 69px;
                        padding-left: 280px;
                        padding-right: 260px;
                        padding-bottom: 5px;
                        z-index: 1;
                        display: grid;
                        grid-template-columns: repeat(2,2fr);
                        gap: 10px;
                    }
                    @media screen and (max-width: 1200px) {
                        div.loading {
                            padding-right: 8px;
                            padding-left: 250px;
                        }
                    }

                    @media screen and (max-width: 600px) {
                        div.loading {
                            padding-right: 8px;
                            padding-left: 8px;
                            padding-bottom: 60px;
                        }
                    }

                    @media screen and (max-width: 750px) {
                        div.loading {
                            width: 100%;
                            grid-template-columns: repeat(1, 1fr);
                        }
                    }
                </style>
            </div>
        HTML;
    }
}
