<div>
<livewire:header />
<livewire:sidbar />
<livewire:sidbar-right />
<livewire:responsive-nav />
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
            integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />
    <title>MI | Editar conteúdo</title>
    <link rel="shortcut icon" href="./imgs/docs-dark.svg" type="image/x-icon">
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('./styles/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('./styles/header.css') }}">
    <link rel="stylesheet" href="{{ asset('./styles/sidbar.css') }}">
    <link rel="stylesheet" href="{{ asset('./styles/sidbar-right.css') }}">
    <link rel="stylesheet" href="{{ asset('./styles/responsive-nav.css') }}">
    <link rel="stylesheet" href="{{ asset('./styles/responsive-nav.css') }}">
    <link rel="stylesheet" href="{{ asset('./styles/card.css') }}">
    <main>
        <h1>Editar</h1>


        <div class="grid">
            @foreach ($conteudos as $item)
            @error("comments.{$item->id}.content")
            <div
                x-data="{ show: true }" 
                x-show="show"
                x-init="setTimeout(() => show = false, 5000)"
                x-transition
                class="feedback-comment"
            >
                {{ $message }}
                <button 
                    @click="show = false" 
                >
                    &times;
                </button>
            </div>
            @enderror
            
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
                                    
                                    <li wire:click.prevent="toggleShare({{ $item->id }}, @js(url("storage/uploads/{$item->content}")))">
                                        <i class="fa fa-share-nodes"></i>
                                        Partilhar
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
                                        
                                        @if(auth()->user()->id == $item->user->id)
                                        <li class="vermelho" wire:click.prevent="deletePost({{ $item->id }})">
                                            <i class="fa fa-trash"></i>
                                            Excluir postagem
                                        </li>
                                        @else
                                        <li wire:click.prevent="toggleDenuncia({{ $item->id }})">
                                            <i class="fa fa-flag"></i>
                                            Denunciar
                                        </li>
                                        @endif
                                    @endauth
                                </ul>
                            </details>
                        </div>
                    </div>
                </div>
                <div class="container-conteudo">
                    @if ($item->type_tag == "jpg" | $item->type_tag == "png" | $item->type_tag == "webp" | $item->type_tag == "jpeg" | $item->type_tag == "gif" | $item->type_tag == "bmp" | $item->type_tag == "tiff")
                        <div class="content-type">
                            <i class="fa fa-images"></i>
                            Imagem
                        </div>
                    @elseif($item->type_tag == "mp3" | $item->type_tag ==  "wav" | $item->type_tag == "m4a")
                        <div class="content-type">
                            <i class="fa-solid fa-microphone-lines"></i>
                            Audio
                        </div>
                    @elseif($item->type_tag == "pdf")
                        <div class="content-type">
                            <i class="fa fa-book"></i>
                             Livro/PDF
                        </div>
                    @elseif($item->type_tag == "mp4" | $item->type_tag == "avi" | $item->type_tag == "mov" | $item->type_tag == "wmv" | $item->type_tag == "mpg" | $item->type_tag == "mpeg")
                        <div class="content-type">
                            <i class="fa fa-video"></i>
                            Vídeo
                        </div>
                    @else
                        <div class="content-type">⚠️ O sistema do consegue identificar</div>
                    @endif
                    @if ($item->type_tag == "jpg" | $item->type_tag == "png" | $item->type_tag == "webp" | $item->type_tag == "jpeg" | $item->type_tag == "gif" | $item->type_tag == "bmp" | $item->type_tag == "tiff")
                    <img src="{{ url("storage/uploads/{$item->capa}") }}" class="capa">
                    <div class="arquivo">
                        <i class="fa fa-images"></i>
                        Imagem
                    </div>
                    @elseif($item->type_tag == "pdf")
                    <img src="{{ url("storage/uploads/{$item->capa}") }}" class="capa">
                    <div class="arquivo">
                        <i class="fa fa-book"></i>
                        Livro
                    </div>
                    @elseif($item->type_tag == "mp3" | $item->type_tag ==  "wav" | $item->type_tag == "m4a")
                    <img src="{{ url("storage/uploads/{$item->capa}") }}" class="capa">
                    <div class="arquivo">
                        <i class="fa-solid fa-microphone-lines"></i>
                        Audio
                    </div>
                    @elseif($item->type_tag == "mp4" | $item->type_tag == "avi" | $item->type_tag == "mov" | $item->type_tag == "wmv" | $item->type_tag == "mpg" | $item->type_tag == "mpeg")
                    <img src="{{ url("storage/uploads/{$item->capa}") }}" class="capa">
                    <div class="arquivo">
                        <i class="fa fa-video"></i>
                        Vídeo
                    </div>
                    @else
                    ⚠️ O sistema do consegue identificar
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
                <div class="comment">
                    <div class="c-img">
                        @guest
                        <img src="./imgs/avatar.webp" alt="">
                        @endguest
                        @auth
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                        @endauth
                    </div>
                    <form wire:submit.prevent="storageComment({{ $item->id }}, {{ $item->user->id }})">
                        <input
                            type="text"
                            placeholder="Digite seu comentário"
                            wire:model.defer="comments.{{ $item->id }}.content"
                        >
                        <button type="submit">
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
                <div class="options">
                    @auth
                    @if ($item->likedByAuthUser->count())
                    <a wire:click.prevent="unlike({{ $item->id }})">
                        <i class="fa fa-thumbs-up"></i>
                        <div class="contador">{{ $item->likes()->count() }}</div>
                    </a>
                    @else
                    <a wire:click.prevent="like({{ $item->id }}, {{ $item->user->id }})">
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
    
                    <a href="/ver/{{$item->id}}">
                        <i class="fa-regular fa-comments"></i>
                        <div class="contador">{{ $item->Comments->count() }}</div>
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
    </main>
    <script src="{{ asset('./js/script.js') }}"></script>
</div>
