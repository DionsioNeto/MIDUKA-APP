<div>
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
        
        @if(session('comment'))
        <div
            x-data="{ show: true }" 
            x-show="show"
            x-init="setTimeout(() => show = false, 5000)"
            x-transition
            class="feedback-comment"
        >
            {{ session('comment') }}
            <button 
                @click="show = false" 
            >
                &times;
            </button>
        </div>
        @endif

       

        <div class="relactive">
            @if (count($conteudos) > 0)
            <div
            x-data="{
                observe() {
                    const observer = new IntersectionObserver(entries => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                @this.call('loadMore');
                            }
                        });
                    }, { threshold: 1 });
        
                    observer.observe(this.$refs.loadMoreTrigger);
                }
            }"
            x-init="observe()"
            >

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
                            <form wire:submit.prevent="storageComment({{ $item->id }})">
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
            
                            <a href="/ver/{{$item->id}}">
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
            
                    {{-- <div class="card-video">
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
            
                            <div class="grid-img-conteudo">
                                <div>
                                    <img src="./imgs/bg.jpg" alt="">
                                </div>
                                <div>
                                    <img src="./imgs/bg.jpg" alt="">
                                </div>
                                <div>
                                    <img src="./imgs/pdf1.jpg" alt="">
                                </div>
                                <div>
                                    <img src="./imgs/tumdavala.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="date cinza">
                            <i class="fa fa-calendar"></i>
                            {{ date('d/m/Y', strtotime($item->created_at)) }} |
                            <i class="fa fa-clock"></i>
                            {{ date(' H', strtotime($item->created_at)) }} H {{ date('m', strtotime($item->created_at)) }} M |
                            <i class="fa-regular fa-eye"></i> 0 |
                            <i class="fa fa-thumbs-up"></i> {{ $item->likes()->count() }}
                        </div>
                        <a href="/ver{{$item->id}}">
                            <div class="description">
                                {{ strlen($item->description) > 100 ? substr($item->description, 0, 120) . ' ver mais ...' : $item->description }}
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
                            <form wire:submit.prevent="storageComment({{ $item->id }})" method="post">
                                <input type="text" placeholder="Digite seu comentário" wire:model='content'>
                                <button type="submit">
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
            
                            <a href="/ver{{$item->id}}">
                                <i class="fa-regular fa-comments"></i>
                                <div class="contador">{{ $item->Comments }}</div>
                            </a>
                            <a href="{{ url("storage/uploads/{$item->content}") }}" download>
                                <i class="fa fa-download"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-share-nodes"></i>
                            </a>
                        </div>
                    </div> --}}
                    
                @endforeach
                </div> 

                <div class="pag">
                    <div x-ref="loadMoreTrigger"></div>

                    @if ($conteudos->hasMorePages())
                        <img src="{{ url("storage/more/loading.gif") }}" width="20px">
                        <div class="cinza">Carregando mais...</div>
                    @else
                        <div>Nenhum conteúdo adicional.</div>
                    @endif
                </div>
            </div>
                
            @else
                <livewire:no-content />
            @endif
                <div wire:offline>
                    <livewire:all-pages />
                </div>
            </div>
    </main>
</div>