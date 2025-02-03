<?php
namespace App\Livewire;
use Livewire\Component;
use App\Models\User;

class Definicoes extends Component{

    public function destroy(){
        User::findOrFail(auth()->user()->id)->delete();
        return redirect("/")->with('delete', 'A sua conta foi deletada com sucesso');
    }

    public $isModalVisible = false;

    // Método para mostrar ou esconder o modal
    public function toggleModal(){
        $this->isModalVisible = !$this->isModalVisible;
    }

    public function render(){
        return view('livewire.definicoes');
    }
}
