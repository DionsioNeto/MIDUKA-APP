<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\User;
use App\Models\Conteudo;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\Lazy;

//#[Lazy]



class Usuario extends Component{
    use WithPagination, WithoutUrlPagination;


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
            $den->profile_or_content = 'Conteúdo';
            $den->conteudo_id = $var;
            $den->user_id = auth()->user()->id;
            $den->profile_or_content_id = $var;
            $den->denuncia = $this->denuncia;

            if($den->save()){
                session()->flash('denNullSucess', 'A sua denúncia foi submetida com sucesso.');
                $this->denuncia = '';

            }else{
                session()->flash('denNullError', 'Erro ao submeter a sua denúncia.');
            }
        }else{
            session()->flash('denNull', 'O (s) campo não podem ficar nulo.');

        }
    }

    // Modal de partilha

    public $share = false;
    public $text_id;
    public $text_link;

    public function toggleShare ($id, $link){
        $this->share = !$this->share;
        $this->text_id = "http://localhost:8000/ver/ " . $id;
        $this->text_link = $link;
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

    public function like($idConteudo, $id_to){
        $conteudo = Conteudo::find($idConteudo);
        $conteudo->likes()->create([
            'user_id' => auth()->user()->id
        ]);

        // if (!auth()->user()->id == $id) {
            $stor = new Notification();
            $stor->content_notification = "Curtiu seu conteúdo";
            $stor->conteudo_id = $idConteudo;
            $stor->nt_from = "like";
            $stor->user_id = auth()->user()->id;
            $stor->id_to = $id_to;
            $stor->save();
        // }
    }

    public function unlike(Conteudo $conteudo){
        if (auth()->check()) {
            $conteudo->likes()
                ->where('user_id', auth()->id())
                ->delete();
        }
    }


    public $comments = [];

    public function storageComment($idConteudo, $id)
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
            $comment->content =  $conteudoComentario;
            $comment->user_id = auth()->id();
            $comment->conteudo_id = $idConteudo;
            $comment->id_to = $id;
            if ($comment->save()) {
                $this->comments[$idConteudo]['content'] = '';
                $conteudoComentario = null;
                session()->flash('comment', 'Sucesso ao comentar.');
            } else {
                session()->flash('comment', 'Ero, o seu comentário não foi salvo.');
            }
            

            if (!auth()->user()->id == $id) {
               $stor = new Notification();
                $stor->content_notification = "Comentou seu conteúdo";
                $stor->conteudo_id = $idConteudo;
                $stor->nt_from = "comment";
                $stor->user_id = auth()->user()->id;
                $stor->id_to = $id;
                $stor->save();
            }
        }
        
    }

    public function deletePost($id){
        Conteudo::findOrFail($id)->delete();
        session()->flash('comment', 'Conteúdo deletado com sucesso.');
    }
     

    public $id;

    public function render(){

        if (auth()->check() && !auth()->user()->hasVerifiedEmail()) {
            abort(redirect('/email/verify'));
        }

        if (auth()->user()) {
            if(auth()->user()->id == $this->id){
                return redirect('/perfil');
            }
        }

        $conteudos = Conteudo::where('user_id', $this->id)->latest()->paginate(2);

        $usuario = User::findOrFail($this->id);
        return view('livewire.usuario',[
            'usuario' => $usuario,
            'conteudos' => $conteudos,
            // 'id' => $id
        ]);

    }

    // public function placeholder(){
    //     return  <<<'HTML'
    //         <div class="loading">
    //             <div class="img-capa">
    //                 <div class="img-perfil"></div>
    //             </div>
    //             <div class="coluna">
    //                 <div class="text-coluna"></div>
    //                 <div class="text-coluna two"></div>
    //                 <div class="text-coluna tree"></div>
    //             </div>
                
        
    //             <style>     
    //                 .img-capa{
    //                     width: 100%;
    //                     height: 180px;
    //                     background: var(--destaque);
    //                     border-radius: 15px;
    //                     position: relative;
    //                 }

    //                 .img-perfil{
    //                     width: 110px;
    //                     height: 110px;
    //                     border-radius: 50%;
    //                     background: var(--link);
    //                     position: absolute;
    //                     bottom: -30%;
    //                     left: 5%;
    //                 }

    //                 .coluna{
    //                     margin-top: 60px;
    //                 }

    //                 .text-coluna{
    //                     width: 100px;
    //                     height: 20px;
    //                     margin: 3px 0px;
    //                     background: var(--destaque);
    //                     border-radius: 5px;
    //                 }

    //                 .two{
    //                     width: 140px;
    //                 }

    //                 .tree{
    //                     width: 120px;
    //                 }

    //                 div.loading{
    //                     padding-top: 69px;
    //                     padding-left: 280px;
    //                     padding-right: 260px;
    //                     padding-bottom: 5px;
    //                     z-index: 1;
    //                 }

    //                 @media screen and ( max-width: 1200px) {
    //                     div.loading{
    //                         padding-right: 8px;
    //                         padding-left: 250px;
    //                     }
    //                 }

    //                 @media screen and ( max-width: 600px){
    //                     div.loading{
    //                         padding-right: 8px;
    //                         padding-left: 8px;
    //                         padding-bottom: 60px;
    //                     }
    //                 }

    //                 @media screen and (max-width:  750px) {
    //                     div.loading{
    //                         width: 100%;
    //                     }
    //                 }
    //             </style>
    //         </div>
    //     HTML;
    // }
}
