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
                    <img src="./IMG_8610.JPG" alt="">
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
                <a href="/regiter">
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
        <video src="./uploads/1.mp4" controls alt="{{ $item->content }}"></video>
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
                                <small>@dionisio.miduka</small><i class="fa-regular fa-eye"></i>
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
                <div class="contador">8M</div>
            </a>
            <a href="#">
                <i class="fa-regular fa-comments"></i>
                <div class="contador">1K</div>
            </a>
            <a href="./uploads/" download>
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
                        <img src="./imgs/avatar.webp">
                    </div>
                    <div class="content">
                        <div class="name">
                            <div>Dionísio Neto</div>
                            <div class="opc">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </div>
                        </div>
                        <div class="teor">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus, perferendis eos nam doloribus nihil laborum sit accusantium, ea repellendus consectetur officiis at ut? Amet consequuntur quaerat optio, impedit doloremque ab?
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
