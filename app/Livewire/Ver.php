<?php

namespace App\Livewire;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use App\Models\{
    Conteudo,
    Comments,
    Denuncias,
    Notification,
};

//#[Lazy]

class Ver extends Component{
    // Pendentes

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
    
    // Excluir post

    public function deletePost($id){
        Conteudo::findOrFail($id)->delete();
        return redirect()->route("home")->with("comment", "Conteúdo deletado com sucesso.");
    }    

    // curtidas
    public function like($idConteudo){
        $conteudo = Conteudo::find($idConteudo);
        $conteudo->likes()->create([
            'user_id' => auth()->user()->id
        ]);

        // Notificar o dono do post

        $stor = new Notification();
        $stor->content_notification = "Curtiu seu conteúdo";
        // $stor->conteudo_id = $idConteudo;
        $stor->user_id = auth()->user()->id;
        $stor->id_to = 1;
        $stor->save();
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

    // descurtidas

    public function unlike(Conteudo $conteudo){
        $conteudo->likes()->delete();
    }

    // Guardar comentarios
    
    public $comment;
    public function storageComment($idConteudo){
        $this->validate(["comment" => 'required'],
            ["comment.required" => "Você deve escrever antes de comentar"]
        );
        $comment = new Comments();
        $comment->content = $this->comment;
        $comment->user_id = auth()->id();
        $comment->conteudo_id = $idConteudo;
        $comment->id_to = 1;
        if($comment->save()){
            $this->comment = null;
        }
        $stor = new Notification();
        $stor->content_notification = "Comentou o seu conteúdo";
        // $stor->conteudo_id = $idConteudo;
        $stor->user_id = auth()->user()->id;
        $stor->id_to = 1;
        $stor->save();

    }

    public $id;
    public function render(){
        $item = Conteudo::findOrFail($this->id);
        return view(
            'livewire.ver',
             [
                'item' => $item,
            ]
        );
    }
}
