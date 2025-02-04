<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\User;
use App\Models\Conteudo;
use Livewire\Attributes\Lazy;
#[Lazy]



class Header extends Component{
    public function placeholder(){
        return <<<'HTML'
                <header>
                    <style>
                        header{
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            margin: 5px;
                            padding: 5px;
                            border: 1px solid var(--link);
                            border-radius: 10px;
                            box-shadow: 0px 0px 5px 0px var(--link);
                            position: fixed;
                            width: calc(100% - 10px);
                            z-index: 1;
                            height: 60px;
                        }
                    </style>
                </header>

        HTML;

    }

    public function openKeyBoard(){
        
    }


    public $search = ''; // Variável para armazenar a pesquisa
    public function render(){
        $users = User::where('name', 'like', '%'.$this->search.'%')
        ->orWhere('email', 'like', '%'.$this->search.'%')
        ->get();


        return view(
            'livewire.header',
            [
               'users' => $users,

           ]
        );
    }
}
