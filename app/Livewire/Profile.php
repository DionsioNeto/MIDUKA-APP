<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\{
    Conteudo,
    User,
    Comments
};
use Livewire\WithPagination;
use Livewire\Attributes\Lazy;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Facades\Auth;
#[Lazy]


class Profile extends Component{
     use WithPagination;

    public $denun = false;
    public $den_id = "";

    public function toggleDenuncia($den_id){
        $this->den_id = $den_id;
        $this->denun = !$this->denun;
    }

    public array $denuncia = [];

    public function submitDen($var){
        if($this->denuncia == !null){
            $den = new Denuncias;
            $den->profile_or_content = 'Conteudo';
            $den->profile_or_content_id = $var;
            $den->denuncia = $this->denuncia;

            if($den->save()){
                session()->flash('denNullSucess', 'A sua denúncia foi submetida com sucesso.');

            }else{
                session()->flash('denNullError', 'Erro ao submeter a sua denúncia.');
            }
        }else{
            session()->flash('denNull', 'O (s) campo não podem ficar nulo.');

        }
    }
    // Modal de partilha

    // Modal de partilha

    public $share = false;
    public $text_id;
    public $text_link;

    public function toggleShare ($id, $link){
        $this->share = !$this->share;
        $this->text_id = "http://localhost:8000/ver/ " . $id;
        $this->text_link = $link;
    }

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

    public $modalEditProfile = true;
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

    public function insertBio(){
        $this->validate([
            'bio' => 'nullable|string|max:500',
        ]);

        $user = User::find(auth()->user()->id);
        
        $user->bio = $this->bio;

        if ($user->save()) {
            dd("Sucesso!");
        }
            
        session()->flash('message', 'Perfil atualizado com sucesso!');
    }

    public function insertSite(){
         $this->validate([
            'site' => 'nullable|url|max:255',
        ]);

        $user = User::find(auth()->user()->id);

        $user->site = $this->site;

        if ($user->save()) {
            dd("Sucesso!");
        }
        
    }

    public function guard($idConteudo){
        $guardar = Conteudo::find($idConteudo);
        $guardar->Guardados()->create([
            'user_id' => auth()->user()->id
        ]);
        return session()->flash('comment', 'Conteúdo guardado com sucesso.');
    }

    public function unguard(Conteudo $guardar){
        $guardar->Guardados()->delete();
        session()->flash('comment', 'Conteúdo retirado sucesso.');
    }

    public function like($idConteudo){
        $conteudo = Conteudo::find($idConteudo);
        $conteudo->likes()->create([
            'user_id' => auth()->user()->id
        ]);
    }

    public function unlike(Conteudo $conteudo){
        $conteudo->likes()->delete();
    }

    public $comments = [];

    public function storageComment($idConteudo)
    {
        $this->validate([
                "comments.{$idConteudo}.content" => 'required',
            ],
            [
                "comments.{$idConteudo}.content.required" => "Você deve escrever antes de comentar",
            ]
        );
    
        if (!auth()->check()) {
            session()->flash('comment', 'Você deve estar logado antes de comentar.');
        }else{
            $conteudoComentario = $this->comments[$idConteudo]['content'] ?? null;
    
            $comment = new Comments();
            $comment->content = $conteudoComentario;
            $comment->user_id = auth()->id();
            $comment->conteudo_id = $idConteudo;
        
            if ($comment->save()) {
                $this->comments[$idConteudo]['content'] = '';
                $conteudoComentario = null;
                session()->flash('comment', 'Sucesso ao comentar.');
            } else {
                session()->flash('comment', 'Ero, o seu comentário não foi salvo.');
            }
        }
        
    }

    public function deletePost($id){
        Conteudo::findOrFail($id)->delete();
        session()->flash('comment', 'Conteúdo deletado com sucesso.');
    }
     
    public int $perPage = 5;

    protected $queryString = ['page'];

    public function loadMore(){
        $this->perPage += 5;
    }
    
    public function render() {
        if (auth()->check() && !auth()->user()->hasVerifiedEmail()) {
            abort(redirect('/email/verify'));
        }
        $conteudos = Conteudo::where('user_id', auth()->user()->id)
        ->latest() // já é orderBy('created_at', 'desc')
        ->paginate($this->perPage);

        $vid = Conteudo::where('user_id', auth()->user()->id)
           ->where('type_tag', ['mp4', 'avi', 'mov', 'wmv', 'mpg', 'mpeg'])
           ->get();

        $img = Conteudo::where('user_id', auth()->user()->id)
            ->where('type_tag', ['jpg', 'png', 'webp', 'jpeg', 'gif', 'bmp', 'tiff'])
            ->get();

        $aud = Conteudo::where('user_id', auth()->user()->id)
            ->where('type_tag', ['mp3', 'wav', 'm4a'])
            ->get();

        $pdf = Conteudo::where('user_id', auth()->user()->id)
            ->where('type_tag', 'pdf')
            ->get();

        return view(
            'livewire.profile',
            [
                'conteudos' => $conteudos,
                'vid' => $vid,
                'img' => $img,
                'aud' => $aud,
                'pdf' => $pdf
            ]
        );
    }
}
