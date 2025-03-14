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
                    <details>
                        <summary>
                        <a class="op">
                            <div class="opc">
                                <i class="fa-solid fa-ellipsis"></i>
                            </div>
                        </a>
                        </summary>
                        <ul>
                            <li>
                                <i class="fa-regular fa-copy"></i>
                                Cópiar link da página
                            </li>
                            <li>
                                <i class="fa-solid fa-share"></i>
                                Partilhar perfil
                            </li>
                            <li>
                                <i class="fa fa-bug"></i>
                                Notificar possível erro
                            </li>
                            <li>
                                <i class="fa fa-error"></i>
                                Denunciar
                            </li>
                        </ul>
                    </details>
                </div>
                <div class="information">
                    <i class="fa-solid fa-at"></i>
                    {{ $usuario->user_name }}
                </div>

                <div class="information">
                    <i class="fa-solid fa-envelope"></i>
                    {{ $usuario->email }}
                </div>
                @if ($usuario->site)
                <div class="information">
                    <a href="{{ $usuario->site }}">
                        <i class="fa fa-link"></i>
                        {{ $usuario->site }}
                    </a>
                </div>
                @endif
                <div>
                    <i class="fa fa-calendar"></i>
                    Aderiu em {{ date('Y' , strtotime($usuario->created_at)) }}
                </div>
           </div>
        </div>
        <div class="dados">
            @if($usuario->bio)
            <div class="bio">
                {{ $usuario->bio }}
            </div>
            @endif
        </div>
        <div class="all">
            <div>
                <a href="">Tudo 1</a>
            </div>
            <div>
                <a href="">Vídeos 1</a>
            </div>
            <div>
                <a href="">Imagens 0</a>
            </div>
            <div>
                <a href="">Livros 0</a>
            </div>
            <div>
                <a href="">Audios 0</a>
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
                            {{ $item->user->name }}
                            <br>
                            <small>@ {{ $item->user->user_name }}</small>
                        </div>
                    </a>
                    <div class="fle">
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
@if ($conteudos->hasPages())
                <hr>
                <div class="pag">
                    <div>
                        <p class="text-sm text-gray-700 leading-5 dark:text-gray-400">
                            {!! __('Showing') !!}
                            @if ($conteudos->firstItem())
                                <span class="font-medium">{{ $conteudos->firstItem() }}</span>
                                {!! __('to') !!}
                                <span class="font-medium">{{ $conteudos->lastItem() }}</span>
                            @else
                                {{ $conteudos->count() }}
                            @endif
                            {!! __('of') !!}
                            <span class="font-medium">{{ $conteudos->total() }}</span>
                            {!! __('results') !!}
                        </p>
                    </div>
                    <nav role="navigation" aria-label="Pagination Navigation">
                        <span class="btn-nav">
                            @if ($conteudos->onFirstPage())
                                <span>
                                    Anterior
                                </span>
                            @else
                                <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev">
                                    <i class="fa-solid fa-arrow-left-long"></i>
                                    Anterior
                                </button>
                            @endif
                        </span>

                        <span  class="btn-nav">
                            @if ($conteudos->onLastPage())
                                <span>
                                    Proximo
                                </span>
                            @else
                                <button wire:click="nextPage" wire:loading.attr="disabled" rel="next">
                                    Proximo
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                </button>
                            @endif
                        </span>
                    </nav>
                </div>
                @endif
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
