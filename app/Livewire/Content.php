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
// #[Lazy()]''

class Content extends Component{
    use WithPagination , WithoutUrlPagination;

    // Modal de partilha

    public $share = false;
    public $text;

    public function toggleShare ($id){
        $this->share = !$this->share;
        $this->text = "O id do conteúdo é " . $id;
    }


    
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

public function storageComment($idConteudo)
{
    $this->validate([
        "comments.{$idConteudo}.content" => 'required|min:1',
    ]);

    if (auth()->check()) {
        $storageComment = new Comments();
        $storageComment->content = $this->comments[$idConteudo]['content'];
        $storageComment->user_id = auth()->id();
        $storageComment->conteudo_id = $idConteudo;

        if ($storageComment->save()) {
            session()->flash('c', 'Sucesso no envio do seu comentário');
            $this->comments[$idConteudo]['content'] = null;
            $this->reset("comments.{$idConteudo}");
        } else {
            session()->flash('auth', 'Erro ao salvar o comentário');
        }
    } else {
        session()->flash('auth', 'Você precisa ter sessão iniciada para poder fazer comentários ...');
    }
}

    public int $perPage = 4; // ou qualquer valor inicial que você queira

    protected $listeners = ['carregarMais' => 'loadMore'];

    public function loadMore()
    {
        $this->perPage += 4; // ou a lógica que quiser
    }
    

    public function render(){
        $conteudos = Conteudo::latest()->paginate(4);
        $comments = Comments::get();
        return view('livewire.content', ['conteudos' => $conteudos]);
    }

}
