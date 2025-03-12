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


#[Lazy]



class Profile extends Component{
    use WithPagination, WithoutUrlPagination;


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

    protected $rules = [
        'name' => 'required|min:20',
        'email' => 'required|min:5',
        'user_name' => 'required|min:20',
        'bio' => '',
        'site' => 'required|min:20',
        'profile_photo' => 'max:2028|mimes:jpg,jpeg,png,bmp,tiff,webp',
        'profile_photo_capa_path' => 'max:2028|mimes:jpg,jpeg,png,bmp,tiff,webp'
    ];

    use WithFileUploads;


    public function updatePrifileInfo(){

    }


    public function render(){
        $conteudos = Conteudo::where('user_id', auth()->user()->id)->get();
        return view('livewire.profile', ['conteudos' => $conteudos]);
    }
}
