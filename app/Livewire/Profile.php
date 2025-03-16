<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Conteudo;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

#[Lazy]



class Profile extends Component{
    use WithPagination, WithoutUrlPagination;
    use WithFileUploads;

    public $modalEditProfile = false;
    public function ToggleModal(){
        $this->modalEditProfile = !$this->modalEditProfile;
    }

    public $name;
    public $email;
    public $user_name;
    public $bio;
    public $site;
    public $profile_photo;
    public $profile_photo_capa_path;

    public function mount(){
        $this->name = Auth::user()->name;
        $this->user_name = Auth::user()->user_name;
        $this->bio = Auth::user()->bio;
        $this->site = Auth::user()->site;
        // $this->bio = Auth::user()->bio;
        // $this->bio = Auth::user()->bio;
        $this->email = Auth::user()->email;
    }

    public function updatePrifileInfo(){
        $this->validate([
            'name' => '',
            'email' => '',
            'user_name' => '',
            'bio' => '',
            'site' => '',
            'profile_photo' => '',
        ]);

        if($this->name == null){
            $this->name = auth()->user()->name;
        }
        if($this->email == null){
            $this->email = auth()->user()->email;
        }
        if($this->user_name == null){
            $this->user_name = auth()->user()->user_name;
        }


        // dd($this->name, $this->email, $this->user_name, $this->bio, $this->site);

        $User = User::find(auth()->user()->id);
        $User->update([
            'name' => $this->name,
            'email' => $this->email,
            'user_name' => $this->user_name,
            'bio' => $this->bio,
            'site' => $this->site,
        ]);

        session()->flash('message', 'Perfil atualizado com sucesso.');
        // $this->resetInputFields();
    }


    public function render(){
        $conteudos = Conteudo::where('user_id', auth()->user()->id)
        ->latest()
        ->paginate(1);

        return view(
            'livewire.profile',
            [
                'conteudos' => $conteudos,
            ]
        );
    }
}
