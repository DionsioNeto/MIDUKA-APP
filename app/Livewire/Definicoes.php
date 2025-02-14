<?php
namespace App\Livewire;
use Livewire\Component;
use App\Models\User;

class Definicoes extends Component{

    public function destroy(){
        User::findOrFail(auth()->user()->id)->delete();
        return redirect("/")->with('delete', 'A sua conta foi deletada com sucesso');
    }

    // Modal para excluir conta ddo usuário
    public $isModalVisible = false;
    // Método para mostrar ou esconder o modal
    public function toggleModal(){
        $this->isModalVisible = !$this->isModalVisible;
    }



    // Modal para alterar email do perfil
    public $isProfileEmail = false;

    public function toggleProfileEmail(){
        $this->isProfileEmail = !$this->isProfileEmail;
    }

    // Modal para alterar ou excluir foto do usuário
    public $isPlofileImage = false;

    public function toggleProfileImage(){
        $this->isPlofileImage = !$this->isPlofileImage;
    }

    public $isPassWord = false;

    public function togglePassWord(){
        $this->isPassWord = !$this->isPassWord;
    }

    public $imageProfileCap = false;

    public function toggleImageProfileCap(){
        $this->imageProfileCap = !$this->imageProfileCap;
    }

    public function render(){
        return view('livewire.definicoes');
    }
}
