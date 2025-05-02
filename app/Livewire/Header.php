<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\User;
use App\Models\Conteudo;
use App\Models\Notification;
use Livewire\Attributes\Lazy;
#[Lazy()]


class Header extends Component{

    public function placeholder(){
        return <<<'HTML'
            <div class="lazy-header">
                <div class="lazy-header-contain">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
           
                <style>
                    .lazy-header .lazy-header-contain{
                        display: flex;
                        gap: 5px;
                    }

                    .lazy-header .lazy-header-contain > div{
                        width: 45px;
                        height: 45px;
                        border-radius: 50%;
                        background: var(--destaque);
                    }

                    .lazy-header{
                        display: flex;
                        justify-content: end;
                        align-items: center;
                        margin: 5px;
                        padding: 5px;
                        border: 1px solid var(--link);
                        border-radius: 10px;
                        position: fixed;
                        width: calc(100% - 10px);
                        height: 57px;
                        z-index: 2;
                    }
                </style>
            </div>
        HTML;
    }

    public $isNotification = false;

    public function openNotification(){
        $this->isNotification = !$this->isNotification;
    }

    public $search = ''; // Variável para armazenar a pesquisa

    public function render(){
        $users = User::where('name', 'like', '%'.$this->search.'%')
        ->orWhere('email', 'like', '%'.$this->search.'%')
        ->get();

        $notification = Notification::get();

        return view(
            'livewire.header',
            [
               'users' => $users,
               'notification' => $notification,

           ]
        );
    }
}
