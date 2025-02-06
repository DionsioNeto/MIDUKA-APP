<div class="relactive">

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
                    <div class="date">
                        <i class="fa fa-calendar"></i>
                        {{ date('d/m/Y', strtotime($item->created_at)) }}
                        <i class="fa fa-clock"></i>
                        {{ date(' H', strtotime($item->created_at)) }} H {{ date('m', strtotime($item->created_at)) }} M
                    </div>
                    <a href="/ver{{$item->id}}">
                        <div class="description">
                            {{ strlen($item->description) > 100 ? substr($item->description, 0, 100) . ' ver mais...' : $item->description }}
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
                @endforeach
            </div>

            <div id="pag">
                {{-- {{ $conteudos->links() }} --}}
                {{-- @if ($conteudos->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation">
            <span>
                @if ($conteudos->onFirstPage())
                    <span>Previous</span>
                @else
                    <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev">Previous</button>
                @endif
            </span>

            <span>
                @if ($conteudos->onLastPage())
                    <span>Next</span>
                @else
                    <button wire:click="nextPage" wire:loading.attr="disabled" rel="next">Next</button>
                @endif
            </span>
        </nav>
    @endif --}}
            {{ $conteudos->links(data: ['scrollTo' => false]) }}
            </div>
        @else
           <livewire:no-content />
        @endif
