<?php

namespace App\Livewire;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Lazy;
use App\Models\{
    User,
    Conteudo,
    Notification,
};

#[Lazy]

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

    public $beyBoard = false;

    public function openKeyBoard(){
        $this->beyBoard = !$this->beyBoard;
    }

    // Variável para armazenar a pesquisa
  
    public $search = '';

    public function addChar($char){
        $this->search .= $char;
    }

    public function backspace(){
        $this->search = mb_substr($this->search, 0, -1);
    }

    public function render(){

        //pesquisa de usuários
        
        $users = User::where('name', 'like', '%'.$this->search.'%')
            ->orWhere('email', 'like', '%'.$this->search.'%')
            ->get();

        //pesquisa de conteúdos

        $cont = Conteudo::where('description', 'like', '%'.$this->search.'%')
            ->get();

        if (auth()->user()) {
            $notification = Notification::where('id_to', auth()->user()->id)
                ->latest()
                ->get();
        }else{
            $notification = null;
        }
        
        return view(
            'livewire.header',
            [
               'users' => $users,
               'cont' => $cont,
               'notification' => $notification,
               // 'notification_verify' => $notification_verify,
           ]
        );
    }
}
