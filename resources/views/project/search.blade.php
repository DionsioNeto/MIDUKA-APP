@extends('layouts.principal')
@section('title', 'Mi | Principal')
@session('content')
@endsession
<livewire:header />
<livewire:sidbar />
<livewire:sidbar-right />
<style>
.card-user{
    padding: 10px;    
    display: flex;
    justify-content: space-between;
    width: 100%;
    cursor: pointer;
}

.card-user > div{
    display: flex;
    gap: 5px;
}

.card-user .img{
    height: 60px;
    width: 60px;
    border-radius: 50%;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
}

.card-user .img img{
    width: 100%;
}

.opc{
    background: var(--link);
    width: 30px;
    height: 30px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
}

</style>
<main>
    <h1>Pesquisa</h1>
    <p>Resultados de suas pesquisas:</p>
    <hr>
    <h3>Contúdos:</h3>

    <div class="card-"></div>

    <h2>Usuários:</h2>

    <div class="card-user">
        <div>
            <div class="img">
                <img src="./imgs/avatar.webp" alt="">
            </div>
            <div class="description">
                <h4>Nome</h4>
                <p>Aderio em: 2025</p>
            </div>
        </div>
            
        <div class="opc">
            <details>
                <summary>
                    <i class="fa-solid fa-ellipsis"></i>
                </summary>
                <ul>
                    <li>
                        <i class="fa fa-mega-phone"></i>
                        Denunciar
                    </li>
                    <li>
                        <i class="fa fa-link"></i>
                        Cópiar URL
                    </li>
                    <li>
                        <i class="fa-regular fa-bookmark"></i>
                        Guardar para ler mais tarde
                    </li>
                    <li>
                        <i class="fa fa-bug"></i>
                        Notificar possível erro
                    </li>
                </ul>
            </details>
        </div>
    </div>


</main>
