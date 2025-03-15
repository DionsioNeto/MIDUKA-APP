<div>

    @if ($modalEditProfile)
    <div class="modalAccount modal-video">
        <div class="contentModal">
            <div class="cima">
                <h4>Atualizar dados do perfil</h4>
                <button wire:click='ToggleModal'>&times;</button>
            </div>
            <div class="img-all">
                <div class="capa">
                    <img src="{{ url("storage/more/default.webp") }}" alt="{{ Auth::user()->name }}">
                </div>
                <div class="edit-profile-photo">
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                </div>
            </div>
            <p>
            @if (session()->has('message'))
                {{ session('message') }}
            @endif
            </p>
            <div class="content-text">
                <form wire:submit.prevent='updatePrifileInfo' method="post" enctype="multipart/form-data">
                    <label for="name">
                        @error('name')
                        <small class="erro">{{ $message }}</small>
                        @enderror
                        <div class="info-text">
                            <small>Nome ({{ Auth::user()->name }})</small>
                            <input type="text" placeholder="Este espaço não pode ficar vázio!" id="name" wire:model='name' value="{{ Auth::user()->name }}">
                        </div>
                    </label>

                    <label for="email">
                        @error('email')
                        <small class="erro">{{ $message }}</small>
                        @enderror
                        <div class="info-text">
                            <small>E-mail ({{ Auth::user()->email }})</small>
                            <input type="text" value="{{ Auth::user()->email }}" placeholder="Este espaço não pode ficar vázio!" id="email" wire:model='email'>
                        </div>
                    </label>

                    <label for="userName">
                        @error('user_name')
                        <small class="erro">{{ $message }}</small>
                        @enderror
                        <div class="info-text">
                            <small>Nome de usuário ({{ Auth::user()->user_name }}), ATT:o campo não pode conter espacamento</small>
                            <input type="text" value="{{ Auth::user()->user_name }}" placeholder="Este espaço não pode ficar vázio!" id="userName" wire:model='user_name'>
                        </div>
                    </label>

                    <label for="site">
                        @error('site')
                        <small class="erro">{{ $message }}</small>
                        @enderror
                        <div class="info-text">
                            <small>Site @if(Auth::user()->site) ({{ Auth::user()->site}}) @endif</small>
                            <input type="text" value="{{ Auth::user()->site }}" placeholder="Digite uma ligação (Link) site ou rede social" id="site" wire:model='site'>
                        </div>
                    </label>

                    <label for="bio">
                        @error('bio')
                        <small class="erro">{{ $message }}</small>
                        @enderror
                        <div class="info-text">
                            <small>Bio @if(Auth::user()->bio) ({{ Auth::user()->bio}}) @endif</small>
                            <textarea id="bio" placeholder="Edite a sua biográfia (opcional)" value="{{ Auth::user()->bio }}" wire:model='bio'></textarea>
                        </div>
                    </label>

                    <div class="btn">
                        <button type="submit">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <main class="relactiva">
        <div>
            <div class="main-img">
                @if (Auth::user()->photo_de_capa == null)
                <img src="{{ url("storage/more/default.webp") }}" alt="{{ Auth::user()->name }}">
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
                                <li wire:click='ToggleModal'>
                                    <i class="fa-regular fa-edit"></i>
                                    Editar perfil
                                </li>
                                <li>
                                    <i class="fa fa-bug"></i>
                                    Notificar possível erro
                                </li>
                            </ul>
                        </details>
                    </div>
                    <div class="information">
                        <a href="">
                            <i class="fa-solid fa-at"></i>
                            {{ Auth::user()->user_name }}
                        </a>
                    </div>

                    <div class="information">
                        <a>
                            <i class="fa-solid fa-envelope"></i>
                            {{ Auth::user()->email }}
                        </a>
                    </div>
                    @if (Auth::user()->site)
                    <div class="information">
                        <a href="{{ Auth::user()->site }}">
                            <i class="fa fa-link"></i>
                            {{ Auth::user()->site }}
                        </a>
                    </div>
                    @endif

               </div>
               <br>
               @if (Auth::user()->bio)
               <div class="bio">
                    <div class="bio-inside">
                        {{ Auth::user()->bio }}
                    </div>
                </div>
               @endif

            </div>

            <div class="all">
                <div>
                    <a href="">Tudo {{ $conteudos->total() }}</a>
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
                                    <small>@ {{ Auth::user()->user_name }}</small>
                                </div>
                            </a>
                            <div class="fle">

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
                                            <i class="fa-regular fa-edit"></i>
                                            Editar conteúdo
                                        </li>
                                        <li>
                                            <i class="fa fa-bug"></i>
                                            Notificar possível erro
                                        </li>
                                    </ul>
                                </details>
                            </div>
                        </div>
                        <div class="container-conteudo">
                            <img src="{{ url("storage/uploads/{$item->capa}") }}" class="capa">
                            @if ($item->type_tag == "jpg")
                            <img src="{{ url("storage/uploads/{$item->content}") }}" class="arquivo">
                            @elseif($item->type_tag == "mp4")
                            <video src="{{ url("storage/uploads/{$item->content}") }}" class="arquivo" {{-- autoplay loop--}}></video>
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
        </div>
        <div wire:offline>
            <livewire:all-pages />
        </div>
    </main>
</div>
