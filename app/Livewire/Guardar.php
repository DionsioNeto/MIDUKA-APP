<?php

namespace App\Livewire;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Models\{
    Guardados,
    Conteudo,
};
#[Lazy()]

class Guardar extends Component{
    use WithPagination, WithoutUrlPagination;

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
                                padding-bottom: 5px;
                                z-index: 1;
                                display: grid;
                                grid-template-columns: repeat(2,2fr);
                                gap: 10px;
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

    public function unguard(Conteudo $guardar){
        $guardar->Guardados()->delete();
    }

    public function render(){
        $item = Guardados::where('user_id', auth()->user()->id)
        ->latest()
        ->paginate(100);
        
        return view(
            'livewire.guardar',
            [
                'item' => $item,
            ]
        );
    }
}
