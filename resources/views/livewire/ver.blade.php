<div class="main">

    {{-- Modais --}}

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

    @error("comment")
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

    {{-- Main --}}

    <title>MI | Conteúdo</title>
    <link rel="stylesheet" href="{{ asset('./styles/ver.css') }}">
    <div class="media-section">
        <header>
            <div class="logo">
                <a href="/"><img src="{{ url('storage/more/logo.png') }}" class="Logo" title="Logo"></a>
            </div>
        </header>
        @if (in_array($item->type_tag, ['jpg','jpeg','png','gif','webp','bmp','tiff']))
            <img src="{{ url("storage/uploads/{$item->content}") }}" alt="Imagem">
        @elseif(in_array($item->type_tag, ['mp4','avi','mov','wmv','mpg','mpeg']))
            <div class="custom-player">
                <video id="videoPlayer" src="{{ url("storage/uploads/{$item->content}") }}"></video>
                <div class="controls">
                    <button id="playPauseVideo"><i class="fa fa-play"></i></button>
                    <span id="videoTime">00:00 / 00:00</span>
                    <input type="range" id="videoProgress" value="0">
                    <div class="volume-control">
                        <i class="fa-solid fa-volume-up"></i>
                        <input type="range" id="videoVolume" min="0" max="1" step="0.01" value="1">
                    </div>
                </div>
            </div>
        @elseif (in_array($item->type_tag, ['mp3','wav','m4a']))
            <img src="{{ url("storage/uploads/{$item->capa}") }}" alt="Capa de Áudio">
            <div class="custom-player">
                <audio id="audioPlayer" src="{{ url("storage/uploads/{$item->content}") }}"></audio>
                <div class="controls">
                    <button id="playPauseAudio"><i class="fa fa-play"></i></button>
                    <span id="audioTime">00:00 / 00:00</span>
                    <input type="range" id="audioProgress" value="0">
                    <div class="volume-control">
                        <i class="fa-solid fa-volume-up"></i>
                        <input type="range" id="audioVolume" min="0" max="1" step="0.01" value="1">
                    </div>
                </div>
            </div>
        @elseif ($item->type_tag == 'pdf')
            <iframe src="{{ url("storage/uploads/{$item->content}") }}" frameborder="0" width="100%" height="100%"></iframe>
        @endif 
    </div>

    <div class="post-container">
        <div class="user">
            <a href="/usuario/{{ $item->user->id }}">
                <div class="avatar"><img src="{{ $item->user->profile_photo_url }}"></div>
                <div class="user-info">
                    <strong>{{ $item->user->name }}</strong>
                    <span class="time">{{ date('d/m/Y', strtotime($item->created_at)) }} • {{ date('H:i', strtotime($item->created_at)) }}</span>
                </div>
            </a>
        </div>

        <div class="post-text">{{ $item->description }}</div>

        <div class="reactions">
            <div><span><i class="fa fa-thumbs-up"></i></span> 
                <span>{{ $item->likes->count() }}</span></div>
            <div><span><i class="fa-solid fa-comments"></i> {{ $item->comments->count() }} comentários</span></div>
        </div>

        <div class="actions">
            @auth
                @if ($item->Likes->count())
                    <button>
                        <a wire:click.prevent="unlike({{ $item->id }})"><i class="fa fa-thumbs-up"></i></a>
                    </button>
                @else
                    <button>
                        <a wire:click.prevent="like({{ $item->id }})"><i class="fa-regular fa-thumbs-up"></i></a>
                    </button>
                @endif
            @endauth

            @auth
                @if ($item->Guardados->count())
                    <button>
                        <a wire:click.prevent="unguard({{ $item->id }})">
                            <i class="fa-solid fa-bookmark"></i>
                        </a>
                    </button>
                @else
                    <button>
                        <a wire:click.prevent="guard({{ $item->id }})">
                            <i class="fa-regular fa-bookmark"></i>
                        </a>
                    </button>
                @endif
            @endauth
            
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

        @auth
            <div class="add-comment">
                <div class="avatar">
                    <a href="/perfil">
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                    </a>
                </div>
                <form wire:submit.prevent="storageComment({{ $item->id }})">
                    <textarea 
                        placeholder="Comentar como {{ Auth::user()->name }}..."
                        wire:model.defer="comment"
                    >
                     </textarea>
                    <button type="submit">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        @endauth

        @if ($item->comments->count())
            @foreach ($item->comments as $comment)
                <div class="comment">
                    <a href="/usuario/{{ $comment->user->id }}">
                        <div class="avatar-comment">
                            <img src="{{ $comment->user->profile_photo_url }}">
                            <div class="author">{{ $comment->user->name }}</div>
                        </div>
                    </a>
                    <div class="text">{{ $comment->content }}</div>
                    <div class="time">{{ date('d/m/Y - H:i', strtotime($comment->created_at)) }} • Curtir • Responder</div>
                </div>
            @endforeach
        @else
            <div class="comment"><h1>Sem comentários</h1></div>
        @endif
    </div>
</div>