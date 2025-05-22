<?php
namespace App\Livewire;
use Livewire\Component;
use App\Models\Conteudo;
use Livewire\WithPagination;
use Livewire\Attributes\Lazy;

#[Lazy]

class Audios extends Component{
    use WithPagination;

    public function placeholder(){
        return  <<<'HTML'
                    <div class="loading">
                
                        <div class="lazy-content">
                            <div class="lazy-content-top">
                                <div class="lazy-content-photo"></div>
                                <div class="lazy-content-traco">
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                            <div class="lazy-content-show"></div>
                        </div>

                        <div class="lazy-content">
                            <div class="lazy-content-top">
                                <div class="lazy-content-photo"></div>
                                <div class="lazy-content-traco">
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                            <div class="lazy-content-show"></div>
                        </div>

                        <div class="lazy-content">
                            <div class="lazy-content-top">
                                <div class="lazy-content-photo"></div>
                                <div class="lazy-content-traco">
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                            <div class="lazy-content-show"></div>
                        </div>
                
                        <style>
                            .lazy-content{
                                display: flex;
                                flex-direction: column;
                                gap: 5px;
                                width: 100%;
                            }

                            .lazy-content-top{
                                display: flex;
                                gap: 15px;
                            }

                            .lazy-content-photo{
                                width: 45px;
                                height: 45px;
                                border-radius: 50%;
                                background: var(--destaque);
                            }
                            
                            .lazy-content-traco > div{
                                width: 100px;
                                height: 11px;
                                border-radius: 10px;
                                background: var(--destaque);
                                margin: 5px 0;
                            }

                            .lazy-content-show{
                                width: 100%;
                                background: var(--destaque);
                                height: 115px;
                                border-radius: 5px;
                            }

                            div.loading{
                                padding-top: 69px;
                                padding-left: 280px;
                                padding-right: 260px;
                                padding-bottom: 5px;
                                z-index: 1;
                                display: grid;
                                grid-template-columns: repeat(2,2fr);
                                gap: 10px;
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
                                    display: grid;
                                    grid-template-columns: repeat(1,1fr);
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
        $conteudos = Conteudo::where('type_tag', 'mp3')
        ->latest() // já é orderBy('created_at', 'desc')
        ->paginate($this->perPage);

        return view(
            'livewire.audios',
            [
                'conteudos' => $conteudos,
            ]
        );
    }
}
