<?php

namespace App\Livewire;
use Livewire\Component;
use Livewire\Attributes\Lazy;
#[Lazy]


class SidbarRight extends Component{
    public function placeholder(){
        return <<<'HTML'
            <div id="sir" class="loading">
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

                    div#sir{
                        padding: 10px;
                        height: calc(98vh - 65px);
                        margin: 70px 5px 5px 25px;
                        display: flex;
                        flex-direction: column;
                        gap: 3px;
                        border-left: 1px solid var(--link);
                        position: fixed;
                        right: 0;
                        width: 250px;
                    }
                    @media screen and ( max-width: 1200px) {
                        div#sir{
                            display: none;
                        }

                    }
                </style>
            </div>
        HTML;
    }

    public function render(){
        return view('livewire.sidbar-right');
    }
}
