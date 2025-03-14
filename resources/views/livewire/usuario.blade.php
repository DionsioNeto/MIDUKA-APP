@extends('layouts.principal')
@section('title', 'Mi | Perfil')
@session('content')

@endsession

<livewire:header />
<livewire:sidbar />
<livewire:sidbar-right />
<main>
<div>
@if($id != null)
    <div>
        <h1>Perfil</h1>
        <div class="main-img">
            <img src="{{ $usuario->profile_photo_url }}" alt="{{ $usuario->name }}">
        </div>

        <div class="padding">
            <div class="informacao">
                <div class="profile-photo">
                    <img src="{{ $usuario->profile_photo_url }}" alt="{{ $usuario->name }}">
                </div>
                <div class="nameOPtion">
                    <h2>{{ $usuario->name }}</h2>
                    <a href="" class="op">
                        <i class="fa-solid fa-share"></i>
                    </a>
                </div>
                <small>{{ $usuario->email }}</small>
           </div>
        </div>
        <div class="dados">
            <div class="bio">
                Biográfia😪🧠
            </div>
            <div>
                <i class="fa fa-location"></i>
                Luanda, Angola
            </div>
            <div>
                <i class="fa fa-calendar"></i>
                Aderiu em {{ date('Y' , strtotime($usuario->created_at)) }}
            </div>
            <div class="seguidor">
                <i class="fa-solid fa-handshake-simple"></i> Conexões: 0
            </div>
        </div>
        <hr>
    @if (count($conteudos) > 0)
        <div class="grid">
             @foreach ($conteudos as $item)
             <div class="card-video">
                <div class="user-description">
                    <a href="/usuario{{ $item->user->id }}" class="inline">
                        <div class="img-photo">
                            <img src="{{ $item->user->profile_photo_url }}">
                        </div>
                        <div class="page-name">
                            {{ $item->name }}
                            <br>
                            <small>@dionisio.miduka</small>
                        </div>
                    </a>
                    <div class="fle">
                        <div class="foll">
                            Seguir
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
                </div>
                <div class="container-conteudo">
                    <img src="{{ url("storage/uploads/{$item->capa}") }}" class="capa">
                    @if ($item->type_tag == "jpg")
                    <img src="{{ url("storage/uploads/{$item->content}") }}" class="arquivo">
                    @elseif($item->type_tag == "mp4")
                    <video src="{{ url("storage/uploads/{$item->content}") }}" class="arquivo" autoplay loop></video>
                    @endif
                </div>
                <div class="date cinza">
                    <i class="fa fa-calendar"></i>
                    {{ date('d/m/Y', strtotime($item->created_at)) }} |
                    <i class="fa fa-clock"></i>
                    {{ date(' H', strtotime($item->created_at)) }} H {{ date('m', strtotime($item->created_at)) }} M |
                    <i class="fa-regular fa-eye"></i> 0
                </div>
                <a href="/ver{{$item->id}}">
                    <div class="description">
                        {{ strlen($item->description) > 100 ? substr($item->description, 0, 100) . ' ver mais ...' : $item->description }}
                    </div>
                </a>
                <div class="comment">
                    <div class="c-img">
                        @guest
                        <img src="./imgs/avatar.webp" alt="">
                        @endguest
                        @auth
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                        @endauth
                    </div>
                    <form action="" method="post">
                        <input type="text" placeholder="Digite seu comentário">
                        <button>
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </button>
                    </form>
                </div>
                <div class="options">
                    @auth
                    @if ($item->Likes->count())
                    <a wire:click.prevent="unlike({{ $item->id }})">
                        <i class="fa fa-thumbs-up"></i>
                        <div class="contador">{{ $item->likes()->count() }}</div>
                    </a>
                    @else
                    <a wire:click.prevent="like({{ $item->id }})">
                        <i class="fa-regular fa-thumbs-up"></i>
                        <div class="contador">{{ $item->likes()->count() }}</div>
                    </a>
                    @endif
                    @endauth
                    @guest
                    <a href="/login">
                        <i class="fa-regular fa-thumbs-up"></i>
                        <div class="contador">{{ $item->likes()->count() }}</div>
                    </a>
                    @endguest

                    <a href="#">
                        <i class="fa-regular fa-comments"></i>
                        <div class="contador">0</div>
                    </a>
                    <a href="{{ url("storage/uploads/{$item->content}") }}" download>
                        <i class="fa fa-download"></i>
                    </a>
                    <a href="#">
                        <i class="fa fa-share-nodes"></i>
                    </a>
                </div>
            </div>
             @endforeach
        </div>

        @else
            <section class="posts">
                <div>
                    <div class="alert-content">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <h1>Sem conteúdo algum adicionado</h1>
                    </div>
                </div>
            </section>
        @endif
@else
    <h1>Usuário não encontrado!</h1>
    <a href="/">voltar para home</a>
@endif

</main>
