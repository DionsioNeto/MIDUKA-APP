<div class="main-all">
    <div class="main-img">
        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
    </div>

    <div class="padding">
        <div class="informacao">
            <div class="profile-photo">
                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
            </div>
            <div class="nameOPtion">
                <h2>{{ Auth::user()->name }}</h2>
                <a href="/definicoes" class="op">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
            </div>
            <small>{{ Auth::user()->email }}</small>
       </div>
    </div>
    <div class="dados">
        <div class="bio">
            {{ __('Bio') }}😪🧠
        </div>
        <div>
            <i class="fa fa-location"></i>
            Luanda, Angola
        </div>
        <div>
            <i class="fa fa-calendar"></i>
            Aderiu em 2024
        </div>
        <div class="seguidor">
            <i class="fa-solid fa-handshake-simple"></i> Conexões: 0
        </div>
    </div>

    <hr>
    @if (count($conteudos) > 0)
        @foreach ($conteudos as $item)
            <div class="grid">
                <div class="card-video">
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
                    <div class="container-conteudo">
                        <img src="./imgs/pdf1.jpg" class="capa">
                        <video src="./uploads/1722697-uhd_3840_2160_25fps.mp4" class="arquivo" autoplay loop></video>
                    </div>
                    <div class="date">
                        <i class="fa fa-calendar"></i>
                        {{ date('d/m/Y', strtotime($item->created_at)) }} as {{ date(' H', strtotime($item->created_at)) }} Horas {{ date('m', strtotime($item->created_at)) }} Minutos
                    </div>
                    <a href="/ver{{$item->id}}">
                        <div class="description">
                            {{ $item->description }}
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
                        <a href="#" wire:click.prevent="unlike({{ $item->id }})">
                            <i class="fa fa-thumbs-up"></i>
                            <div class="contador">8M</div>
                        </a>
                        @else
                        <a href="#" wire:click.prevent="like({{ $item->id }})">
                            <i class="fa-regular fa-thumbs-up"></i>
                            <div class="contador">8M</div>
                        </a>
                        @endif
                        @endauth
                        @guest
                        <a href="/login">
                            <i class="fa-regular fa-thumbs-up"></i>
                            <div class="contador">8M</div>
                        </a>
                        @endguest

                        <a href="#">
                            <i class="fa-regular fa-comments"></i>
                            <div class="contador">1K</div>
                        </a>
                        <a href="./uploads/{{ $item->content }}" download>
                            <i class="fa fa-download"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-share-nodes"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

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
</div>
