<div>
    @extends('layouts.principal')
@section('title', 'Mi | Perfil')
@session('content')

@endsession

<livewire:header />
<livewire:sidbar />
<livewire:sidbar-right />

    @if($share)
    <div class="modalAccount" style="z-index: 6;">
        <div class="contentModal">
            <div class="share-top">
                <h4>Partilhar conteúdo</h4>
                <button wire:click.prevent="toggleShare(null, null)">&times;</button>
            </div>
            Link para o conteúdo: 
            <div class="flex-share"
                x-data="{
                    copied: false,
                    copyToClipboard() {
                        const content = document.getElementById('copy').innerText;
                        navigator.clipboard.writeText(content).then(() => {
                            this.copied = true;
                            setTimeout(() => this.copied = false, 2000);
                        }).catch(err => {
                            console.error('Erro ao copiar:', err);
                        });
                    }
                }"
            >
                <div>
                    <i class="fa fa-link"></i>
                </div>
                <div class="input-share" id="copy">
                    {{ $text_id }}
                </div>
                <div class="btn-share" @click="copyToClipboard">
                    <template x-if="!copied">
                        <i class="fa-regular fa-copy"></i>
                    </template>
                    <template x-if="copied">
                        <i class="fa-solid fa-check"></i>
                    </template>
                </div>
            </div>

            
            <div class="flex-share"
                x-data="{
                    copied: false,
                    copyToClipboard() {
                        const content = document.getElementById('embed-code').innerText;
                        navigator.clipboard.writeText(content).then(() => {
                            this.copied = true;
                            setTimeout(() => this.copied = false, 2000);
                        }).catch(err => {
                            console.error('Erro ao copiar:', err);
                        });
                    }
                }"
            >
                <div>
                    <i class="fa fa-code"></i>
                </div>
                <div class="input-share" id="embed-code">
                    &lt;iframe src="{{ $text_link }}"&gt;&lt;/iframe&gt;
                </div>
                <div class="btn-share" @click="copyToClipboard">
                    <template x-if="!copied">
                        <i class="fa-regular fa-copy"></i>
                    </template>
                    <template x-if="copied">
                        <i class="fa-solid fa-check"></i>
                    </template>
                </div>
            </div>
 
            <div class="social-media">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($text_id) }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="center"
                >
                    <i class="fa-brands fa-facebook"></i>
                </a>

                <a href="https://twitter.com/intent/tweet?url={{ urlencode($text_id) }}&text={{ urlencode('Confira este conteúdo incrível!') }}" target="_blank">
                    <div  class="center">
                        <i class="fa-brands fa-square-x-twitter"></i>
                    </div>
                </a>
                <a href="https://wa.me/?text={{ urlencode('Confira este link: ' . $text_id) }}" target="_blank">
                    <div  class="center">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>    
                </a>
                <a href="mailto:?subject={{ urlencode('Confira este conteúdo!') }}&body={{ urlencode('Olha esse link interessante: ' . $text_id) }}">
                    <div  class="center">
                        <i class="fa fa-envelope"></i>
                    </div>    
                </a>
            </div>          
        </div>
    </div>
    @endif

    @if($denun)
    <div class="modalAccount" style="z-index: 6;">
        <div class="contentModal">
            <div class="share-top">
                <h4>Denúncia</h4> 
                <button wire:click.prevent="toggleDenuncia(null)">&times;</button>
            </div>
            <div class="radios-group">
                <form wire:submit.prevent="submitDen('{{ $den_id }}')">
                    @if (session()->has('denNull'))
                        <div class="">{{ session('denNull') }}</div>
                    @endif
                    @if (session()->has('denNullSucess'))
                        {{ session('denNullSucess') }}
                    @endif
                    @if (session()->has('denNullError'))
                        {{ session('denNullError') }}
                    @endif
                    <label for="den1">
                        <div>
                            <input type="checkbox" value="sexual" wire:model="denuncia" id="den1">
                            <span>Conteúdo sexual</span>
                        </div>
                    </label> 
                    <label for="den2">
                        <div>
                            <input type="checkbox" value="violencia" wire:model="denuncia" id="den2">
                            <span>Conteúdo violento</span>
                        </div>
                    </label> 
                    <label for="den3">
                        <div>
                            <input type="checkbox" value="odio" wire:model="denuncia" id="den3">
                            <span>Expressão de ódio</span>
                        </div>
                    </label>
                    <label for="den4">
                        <div>
                            <input type="checkbox" value="outros" wire:model="denuncia" id="den4">
                            <span>Outros...</span>
                        </div>
                    </label>  
                    <div class="btn-denuncia">
                        <button class="btn-share">Enviar</button>
                        <button class="btn-submit-simple" wire:click.prevent="toggleDenuncia(null)">Fechar</button>
                    </div>   
                </form>    
            </div> 
        </div>
    </div>
    @endif

<main>
<div>
@if($id != null)
    <div>
        <h1>Perfil</h1>
        <div class="main-img">
            @if ($usuario->profile_photo_capa_path == null)
            @else
            <img src="{{ asset('storage/' . $usuario->profile_photo_capa_path) }}" alt="Capa do usuário">
            @endif
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
                            @php
                                $profileLink = url('/usuario/' . $usuario->id);
                            @endphp

                            <li x-data="{ copied: false }"
                                @click="
                                    navigator.clipboard.writeText('{{ $profileLink }}')
                                    .then(() => {
                                        copied = true;
                                        setTimeout(() => copied = false, 2000);
                                    });
                                "
                                class="cursor-pointer flex items-center space-x-2 text-gray-700 hover:text-blue-500 transition"
                            >
                                <i :class="copied ? 'fa-solid fa-check text-green-500' : 'fa-regular fa-copy'"></i>
                                <span x-text="copied ? 'Link copiado!' : 'Copiar link do perfil'"></span>
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

</div>