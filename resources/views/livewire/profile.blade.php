<div class="main-all">
    <div class="main-img">
        @if (Auth::user()->photo_de_capa == null)
        <img src="{{ url("storage/more/default.jpg") }}" alt="{{ Auth::user()->name }}">
        @else
        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
        @endif
    </div>

    <div class="padding">
        <div class="informacao">
            <div class="profile-photo">
                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
            </div>
            <div class="nameOPtion">
                <h2>{{ Auth::user()->name }}</h2>
                <a class="op">
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
                </a>
            </div>
            <small>{{ Auth::user()->email }}</small>
       </div>
       <br>
       <div class="bio">
            {{ __('Bio') }}😪🧠
        </div>
       <div class="">
           Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quibusdam quia est adipisci tempora suscipit voluptas nisi doloremque, nulla consequatur maxime eveniet possimus ut architecto, quae unde libero sed quod ex.
       </div>
    </div>

    <div class="all">
        <div>
            <a href="">Tudo</a>
        </div>
        <div>
            <a href="">Vídeos 0</a>
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
</div>
