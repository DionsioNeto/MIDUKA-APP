<?php

namespace App\Livewire;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\Lazy;
use App\Models\{
    Conteudo,
    Comments,
};
#[Lazy()]

class Content extends Component{
    use WithPagination, WithoutUrlPagination;

    public function placeholder(){
        return  <<<'HTML'
                    <div class="loading">
                        <span></span>
                        <span></span>
                        <span></span>
                        <style>
                            div.loading span:nth-child(2){
                                margin: 10px 0px;
                                width: 70%;
                                height: 20px;
                                border-radius: 20px;
                                background: var(--destaque);
                                animation: firstLoading 1500ms infinite;
                            }

                            @keyframes firstLoading {
                                0%{
                                    width: 70%;
                                }50%{
                                    width: 100%;
                                }100%{
                                    width: 70%;
                                }
                            }
                            div.loading span{
                                margin: 10px 0px;
                                width: 100%;
                                height: 20px;
                                border-radius: 20px;
                                background: var(--destaque);
                                animation: lastLoading 1500ms infinite;
                            }


                            @keyframes lastLoading {
                                0%{
                                    width: 100%;
                                }50%{
                                    width: 70%;
                                }100%{
                                    width: 100%;
                                }
                            }
                        </style>
                    </div>
                HTML;
    }

    public function guard($idConteudo){
        $guardar = Conteudo::find($idConteudo);
        $guardar->Guardados()->create([
            'user_id' => auth()->user()->id
        ]);
    }

    public function unguard(Conteudo $guardar){
        $guardar->Guardados()->delete();
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

    public function storageComment($idConteudo){
        $this->validate([
            'comments' => 'min:1|required',
        ]);
        if(isset(auth()->user()->name)){

            $storageComment = new Comments;

            $storageComment->content = $this->comments[$idConteudo]['content'];

            $storageComment->user_id = auth()->user()->id;

            $storageComment->conteudo_id = $idConteudo;

            if($storageComment->save()){
                session()->flash('msg', 'Sucesso no envio do seu comentário');
                $this->comments[$idConteudo]['content'] = null;
            }else{
                session()->flash('auth', 'Você precisa ter sessão iniciada para poder fazer comentários ...');
            }
        }else{
            session()->flash('auth', 'Você precisa ter sessão iniciada para poder fazer comentários ...');
        }
    }

    public function render(){
        $conteudos = Conteudo::latest()->paginate(4);
        $comments = Comments::get();
        return view('livewire.content', ['conteudos' => $conteudos]);
    }

}
