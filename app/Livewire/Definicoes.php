<?php
namespace App\Livewire;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


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


    public $email;

    // Regra de validação
    protected $rules = [
        'email' => 'required|email|unique:users,email', // Verifica se o email é único, ignorando o do usuário logado
        'current_password' => 'required',
        'new_password' => 'required|min:8|different:current_password',
        'new_password_confirmation' => 'required|same:new_password',
        ];

    public function mount()
    {
        // Preenche o campo com o email atual do usuário
        $this->email = Auth::user()->email;
    }

    public function updateEmail()
    {
        // Validação dos dados
        $this->validate();

        try {
            // Atualiza o email do usuário
            $user = Auth::user();
            $user->email = $this->email;
            $user->save();

            session()->flash('message', 'E-mail atualizado com sucesso!');
        } catch (\Exception $e) {
            session()->flash('error', 'Ocorreu um erro ao atualizar o e-mail.');
        }
    }




    public $isProfileEmail = false;

    public function toggleProfileEmail(){
        $this->isProfileEmail = !$this->isProfileEmail;
    }

    // Modal para alterar ou excluir foto do usuário
    public $isPlofileImage = false;

    public function toggleProfileImage(){
        $this->isPlofileImage = !$this->isPlofileImage;
    }


    public $current_password;
    public $new_password;
    public $new_password_confirmation;



    public function updatePassword()
    {
        $this->validate();

        $user = Auth::user();

        // Verificar se a senha atual está correta
        if (!Hash::check($this->current_password, $user->password)) {
            session()->flash('error', 'A senha atual não está correta.');
            return;
        }

        // Atualizar a senha
        $user->password = Hash::make($this->new_password);
        $user->save();

        session()->flash('message', 'Senha atualizada com sucesso!');
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
