<?php
namespace App\Livewire;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


class Definicoes extends Component{
    use WithFileUploads;


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


    public function mount(){
        // Preenche o campo com o email atual do usuário
        $this->email = Auth::user()->email;
    }

    public function updateEmail(){
        $this->validate([
            'email' => 'required|email|unique:users,email',
        ]);

        if($this->email == null){
            $this->email = auth()->user()->email;
        }


        // dd($this->email);

        $User = User::find(auth()->user()->id);
        $User->update([
            'email' => $this->email,
        ]);

        session()->flash('msg-mail', 'E-mail foi atualizado.');
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

    public function rules()
    {
        return [
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ];
    }

    
    public $photo;

public function updatedPhoto()
{
    // Validação rápida e clara
    $this->validate([
        'photo' => ['required', 'image', 'max:1024'], // 1MB
    ]);

    $user = Auth::user();

    // Apaga foto anterior com verificação segura
    if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
        Storage::disk('public')->delete($user->profile_photo_path);
    }

    // Armazena nova foto e atualiza usuário
    $path = $this->photo->store('profile-photos', 'public');

    $user->forceFill([
        'profile_photo_path' => $path,
    ])->save();

    session()->flash('success', 'Foto de perfil atualizada com sucesso.');

    // Limpa a propriedade após o upload (opcional, mas bom para resetar input)
    $this->reset('photo');
}

public function removePhoto()
{
    $user = Auth::user();

    if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
        Storage::disk('public')->delete($user->profile_photo_path);
    }

    $user->forceFill([
        'profile_photo_path' => null,
    ])->save();

    session()->flash('success', 'Foto de perfil removida com sucesso.');
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
        return view('livewire.definicoes',
         [
            'photoUrl' => Auth::user()->profile_photo_path 
                ? Storage::url(Auth::user()->profile_photo_path)
                : null,
        ]);
    }
}
