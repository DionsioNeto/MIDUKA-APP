<?php
namespace App\Livewire;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Lazy;
use App\Models\{
    Conteudo,
    Comments,
    Denuncias,
};

#[Lazy]

class Content extends Component{
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
     
    public int $perPage = 5;

    protected $queryString = ['page'];

    public function loadMore(){
        $this->perPage += 5;
    }

    public function render(){
        $conteudos = Conteudo::latest()->paginate($this->perPage);
        return view('livewire.content', ['conteudos' => $conteudos]);
    }

}