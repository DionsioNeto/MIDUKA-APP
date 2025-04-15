<div>
    @extends('layouts.principal')
    @section('title', 'Mi | Vizualizar')
    @session('content')

    @endsession
    <link rel="stylesheet" href="./styles/ver.css">
    <div id="main">
    <div class="conteudo">
        <div class="header">
            <div class="logo">
                <div class="last-header">
                    <a href="/">
                        <button>
                            <i class="fa-solid fa-arrow-left-long"></i>
                        </button>
                    </a>
                    <img src="{{ url("storage/more/logo.png") }}" class="Logo">
                </div>
            </div>
            <button>
            </button>
            <div class="last-header">
                <a href="/Pesquisar">
                    <button>
                        <i class="fa fa-search"></i>
                    </button>
                </a>

                <button class="dark-mode" id="toggle-mode">
                    <i class="fa-solid fa-circle-half-stroke"></i>
                </button>

                <button>
                    <div class="notification">
                            <i class="fa fa-bell"></i>
                        <div class="counter">15</div>
                    </div>
                </button>
                @guest
                <a href="/perfil">
                    <div class="img-photo">
                        <img src="./imgs/avatar.webp" alt="">
                    </div>
                </a>
                @endguest
                @auth
                <a href="/perfil">
                    <div class="img-photo">
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="">
                    </div>
                </a>
                @endauth
            </div>
        </div>
        <div class="content-archive">
            @if ($item->type_tag == "jpg")
            <img src="{{ url("storage/uploads/{$item->content}") }}" class="archive">
            @elseif($item->type_tag == "mp4")
            <video src="{{ url("storage/uploads/{$item->content}") }}" class="archive" controls></video>
            @elseif ($item->type_tag == "mp3")
            <div class="content-audio"> 
                <img src="{{ url("storage/uploads/{$item->capa}") }}" class="archive">
                <audio controls="" autoplay="" name="media">
                    <source src="{{ url("storage/uploads/{$item->content}") }}" type="audio/mpeg">
                </audio>
                <div class="bor">
                    <i class="fa fa-play"></i>
                    <i class="fa fa-pause"></i>
                    <i class="fa fa-re-place"></i>
                </div>
            </div> 
            @elseif ($item->type_tag == "pdf")
            <iframe src="{{ url("storage/uploads/{$item->content}") }}"" frameborder="0"></iframe>
            @endif      
        </div>
    </div>
    <div class="comentarios">
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
                                <i class="fa-solid fa-bookmark"></i>
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
        <div class="description">
            {{$item->description}}
        </div>
        <div class="options">
            <a href="#">
                <i class="fa-regular fa-thumbs-up"></i>
                <div class="contador">{{ $item->likes->count() }}</div>
            </a>
            <a href="#">
                <i class="fa-regular fa-comments"></i>
            </a>
            <a href="{{ url("storage/uploads/{$item->content}") }}" download>
                <i class="fa fa-download"></i>
            </a>
            <a href="#">
                <i class="fa fa-share-nodes"></i>
            </a>
        </div>
        <div class="container">
            <div class="mainCom">
                <div class="box">
                    <div class="img-photo">
                        {{-- <img src="{{ $item->comments->user->profile_photo_url }}"> --}}
                    </div>
                    <div class="content">
                        <div class="name">
                            {{-- <div>{{ $item->comments->name }}</div> --}}
                            <div class="opc">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </div>
                        </div>
                        <div class="teor">
                            {{ $item->user->comments->content }}
                        </div>
                    </div>
                </div>
                <div class="like">
                    <div>
                        <i class="fa fa-share-nodes"></i>
                        10
                    </div>
                    <div>
                        <i class="fa fa-share-nodes"></i> 2
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


</div>
