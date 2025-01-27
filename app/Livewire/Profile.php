<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Conteudo;
use Livewire\Attributes\Lazy;
#[Lazy]



class Profile extends Component{
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
        $id = auth()->user()->id;
        $conteudos = Conteudo::where('id', $id)->get();
        return view('livewire.profile', ['conteudos' => $conteudos]);
    }
}
