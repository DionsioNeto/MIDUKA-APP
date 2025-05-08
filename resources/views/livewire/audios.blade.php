<div class="relactive">
    <h1>Audios</h1>
    @if (count($conteudos) > 0)
        <div class="grid">
        @foreach ($conteudos as $item)
        <div class="card-video">
            <div class="user-description">
                <a href="/usuario/{{ $item->user->id }}" class="inline">
                    <div class="img-photo">
                        <img src="{{ $item->user->profile_photo_url }}">
                    </div>
                    <div class="page-name">
                        {{ $item->user->name }}
                        <br>
                        <small>
                            @
                            {{ strlen($item->user->user_name) > 20 ? substr($item->user->user_name, 0, 20) . ' ...' : $item->user->user_name }}
                        </small>
                    </div>
                </a>
                <div class="fle">

                    <div class="opc">
                        <details>
                            <summary>
                                <i class="fa-solid fa-ellipsis"></i>
                            </summary>
                            <ul>
                                <li wire:click.prevent="toggleDenuncia({{ $item->id }})">
                                    <i class="fa fa-flag"></i>
                                    Denunciar
                                </li>
                                <li>
                                    <i class="fa-regular fa-bell"></i>
                                    Notificar-me
                                </li>
                                <li>
                                    <i class="fa fa-link"></i>
                                    Cópiar URL
                                </li>
                                @auth
                                    @if ($item->Guardados->count())
                                    <a wire:click.prevent="unguard({{ $item->id }})">
                                        <li>
                                            <i class="fa-solid fa-bookmark"></i>
                                            Não guardar para mais tarde
                                        </li>
                                    </a>
                                    @else
                                    <a wire:click.prevent="guard({{ $item->id }})">
                                        <li>
                                            <i class="fa-regular fa-bookmark"></i>
                                            Guardar para mais tarde
                                        </li>
                                    </a>
                                    @endif
                                @endauth
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
                @if ($item->type_tag == "jpg" | $item->type_tag == "png")
                    <div class="content-type">
                        <i class="fa fa-images"></i>
                        Imagem
                    </div>
                @elseif($item->type_tag == "mp3")
                    <div class="content-type">
                        <i class="fa-solid fa-microphone-lines"></i>
                        Audio
                    </div>
                @elseif($item->type_tag == "pdf")
                    <div class="content-type">
                        <i class="fa fa-book"></i>
                         Livro/PDF
                    </div>
                @elseif($item->type_tag == "mp4")
                    <div class="content-type">
                        <i class="fa fa-video"></i>
                        Vídeo
                    </div>
                @else
                    <div class="content-type">⚠️ O sistema do consegue identificar</div>
                @endif
                <img src="{{ url("storage/uploads/{$item->capa}") }}" class="capa">
                @if ($item->type_tag == "jpg" | $item->type_tag == "png")
                <img src="{{ url("storage/uploads/{$item->content}") }}" class="arquivo">
                @elseif($item->type_tag == "mp4")
                <video src="{{ url("storage/uploads/{$item->content}") }}" class="arquivo"></video>
                @endif
            </div>
            <div class="date cinza">
                <i class="fa fa-calendar"></i>
                {{ date('d/m/Y', strtotime($item->created_at)) }} |
                <i class="fa fa-clock"></i>
                {{ date(' H', strtotime($item->created_at)) }} H {{ date('m', strtotime($item->created_at)) }} M |
                <i class="fa fa-thumbs-up"></i> {{ $item->likes()->count() }}
            </div>
            <a href="/ver/{{$item->id}}">
                <div class="description">
                        @if(strlen($item->description) > 100)
                            {{ substr($item->description, 0, 120) }}...
                            <span  class="cinza">ver mais...</span>
                        @else
                            {{ $item->description }}
                        @endif
                </div>
            </a>
            @if (session()->has('msg'))
                <div class="">{{ session('success') }}</div>
            @endif
            <div class="comment">
                <div class="c-img">
                    @guest
                    <img src="./imgs/avatar.webp" alt="">
                    @endguest
                    @auth
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                    @endauth
                </div>
                <form wire:submit.prevent="storageComment({{ $item->id }})">
                    <input
                        type="text"
                        placeholder="Digite seu comentário"
                        wire:model='comments.{{ $item->id }}.content'
                    >
                    <button type="submit">
                        <i class="fa-solid fa-paper-plane"></i>
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

                <a href="/ver{{$item->id}}">
                    <i class="fa-regular fa-comments"></i>
                    <div class="contador">{{ $item->Comments }}</div>
                </a>
                <a href="{{ url("storage/uploads/{$item->content}") }}" download>
                    <i class="fa fa-download"></i>
                </a>
                <a wire:click.prevent="toggleShare({{ $item->id }}, @js(url("storage/uploads/{$item->content}")))">
                    <i class="fa fa-share-nodes"></i>
                </a>
            </div>
        </div>
        @endforeach
        </div>

    @else
        <livewire:no-content />
    @endif
    <div wire:offline>
        <livewire:all-pages />
    </div>
</div>
