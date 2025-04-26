<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\User;
use App\Models\Conteudo;
use App\Models\Notification;
use Livewire\Attributes\Lazy;
// #[Lazy()]


class Header extends Component{
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
