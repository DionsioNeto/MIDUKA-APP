<?php

namespace App\Livewire;
use Livewire\Component; 
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\Lazy;
use App\Models\Conteudo;                  
use App\Models\Comments;
#[Lazy]


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

    public function render(){
        $conteudos = Conteudo::latest()->paginate(2);
        $comments = Comments::get();
        return view('livewire.content', ['conteudos' => $conteudos]);
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

    public $Content;

    protected $rules = [
        'Content' => 'required', // Permitindo diferentes tipos de arquivos
    ];

    public function storageComment($idConteudo){
        if(auth()->user()){
            $creat = new Comments();

            $this->validate();

            $creat->content = $this->content;
            $creat->user_id = auth()->user()->id;

            if($creat->save()){
                $this->Content = null;
                session()->flash('msg', 'Sucesso no envio do seu comentário');
            }else{
                session()->flash('Erro', 'Sem Sucesso no envio do seu comentário');
            }
        }else{
            session()->flash('auth', 'Você precisa ter sessão iniciada para poder fazer comentários ...');
        }
    }





}
