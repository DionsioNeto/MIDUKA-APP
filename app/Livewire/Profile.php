<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\{
    Conteudo,
    User
};
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\Lazy;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Facades\Auth;
#[Lazy]


class Profile extends Component{
    use WithPagination, WithoutUrlPagination;
    use WithFileUploads;

    public function placeholder(){
        return  <<<'HTML'
            <div class="loading">
                <div class="img-capa">
                    <div class="img-perfil"></div>
                </div>
                <div class="coluna">
                    <div class="text-coluna"></div>
                    <div class="text-coluna two"></div>
                    <div class="text-coluna tree"></div>
                </div>
                
        
                <style>     
                    .img-capa{
                        width: 100%;
                        height: 180px;
                        background: var(--destaque);
                        border-radius: 15px;
                        position: relative;
                    }

                    .img-perfil{
                        width: 110px;
                        height: 110px;
                        border-radius: 50%;
                        background: var(--link);
                        position: absolute;
                        bottom: -30%;
                        left: 5%;
                    }

                    .coluna{
                        margin-top: 60px;
                    }

                    .text-coluna{
                        width: 100px;
                        height: 20px;
                        margin: 3px 0px;
                        background: var(--destaque);
                        border-radius: 5px;
                    }

                    .two{
                        width: 140px;
                    }

                    .tree{
                        width: 120px;
                    }

                    div.loading{
                        padding-top: 69px;
                        padding-left: 280px;
                        padding-right: 260px;
                        padding-bottom: 5px;
                        z-index: 1;
                    }

                    @media screen and ( max-width: 1200px) {
                        div.loading{
                            padding-right: 8px;
                            padding-left: 250px;
                        }
                    }

                    @media screen and ( max-width: 600px){
                        div.loading{
                            padding-right: 8px;
                            padding-left: 8px;
                            padding-bottom: 60px;
                        }
                    }

                    @media screen and (max-width:  750px) {
                        div.loading{
                            width: 100%;
                        }
                    }
                </style>
            </div>
        HTML;
    }

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
        $this->email = Auth::user()->email;
    }

    public function updatePrifileInfo(){
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.auth()->id(),
            'user_name' => 'required|string|max:50|unique:users,user_name,'.auth()->id().'|regex:/^[a-zA-Z0-9_]+$/',
            'bio' => 'nullable|string|max:500',
            'site' => 'nullable|url|max:255',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        $user = User::find(auth()->id());
        
        $updateData = [
            'name' => $this->name,
            'email' => $this->email,
            'user_name' => $this->user_name,
            'bio' => $this->bio ?: null, // Converte string vazia para null
            'site' => $this->site ?: null, // Converte string vazia para null
        ];

        // Tratamento para upload de foto de perfil
        if ($this->profile_photo) {
            $path = $this->profile_photo->store('profile-photos', 'public');
            $updateData['profile_photo_path'] = $path;
        }

        $user->update($updateData);

        session()->flash('message', 'Perfil atualizado com sucesso!');
        
        // Atualiza os dados na view se a foto foi alterada
        if ($this->profile_photo) {
            $this->mount();
        }
    }


    public function render(){
        $conteudos = Conteudo::where('user_id', auth()->user()->id)
        ->latest()
        ->paginate(12);

        return view(
            'livewire.profile',
            [
                'conteudos' => $conteudos,
            ]
        );
    }
}
