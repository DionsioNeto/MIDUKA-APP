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
                            <small>Nome</small>
                            <input type="text" placeholder="Este espaço não pode ficar vázio!" id="name" wire:model='name'>
                        </div>
                    </label>

                    <label for="email">
                        @error('email')
                        <small class="erro">{{ $message }}</small>
                        @enderror
                        <div class="info-text">
                            <small>E-mail</small>
                            <input type="text" placeholder="Este espaço não pode ficar vázio!" id="email" wire:model='email'>
                        </div>
                    </label>

                    <label for="userName">
                        @error('user_name')
                            <small class="erro">{{ $message }}</small>
                        @enderror
                        <div class="info-text">
                            <small>Nome de usuário (sem espaços ou caracteres especiais)</small>
                            <input type="text" placeholder="Digite seu nome de usuário" id="userName" wire:model='user_name'>
                        </div>
                    </label>
                
                    @if(Auth::user()->site)
                    <!-- Campo Site -->
                    <label for="site">
                        @error('site')
                            <small class="erro">{{ $message }}</small>
                        @enderror
                        <div class="info-text">
                            <small>Site (opcional)</small>
                            <input type="text" placeholder="https://exemplo.com" id="site" wire:model='site'>
                        </div>
                    </label>
                    @endif
                
                    @if(Auth::user()->bio)
                    <!-- Campo Bio -->
                    <label for="bio">
                        @error('bio')
                            <small class="erro">{{ $message }}</small>
                        @enderror
                        <div class="info-text">
                            <small>Bio (opcional)</small>
                            <textarea id="bio" placeholder="Conte um pouco sobre você" wire:model='bio'></textarea>
                        </div>
                    </label>
                    @endif

                    <div class="btn">
                        <button type="submit">Salvar</button>
                    </div>
                </form>
                <form wire:submit.prevent='insert' method="post" enctype="multipart/form-data">

                    @if(empty(Auth::user()->site))
                    <!-- Campo Site -->
                    <label for="site">
                        @error('site')
                            <small class="erro">{{ $message }}</small>
                        @enderror
                        <div class="info-text">
                            <small>Site (opcional)</small>
                            <input type="text" placeholder="https://exemplo.com" id="site" wire:model='site'>
                        </div>
                    </label>
                    @endif
                
                    @if(empty(Auth::user()->bio))
                    <!-- Campo Bio -->
                    <label for="bio">
                        @error('bio')
                            <small class="erro">{{ $message }}</small>
                        @enderror
                        <div class="info-text">
                            <small>Bio (opcional)</small>
                            <textarea id="bio" placeholder="Conte um pouco sobre você" wire:model='bio'></textarea>
                        </div>
                    </label>
                    @endif
                    @if(empty(Auth::user()->bio) | empty(Auth::user()->site))
                    <div class="btn">
                        <button type="submit">Salvar</button>
                    </div>
                    @endif

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
                            <i class="fa fa-envelope"></i>
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
                    <div class="information">
                        <a>
                            <i class="fa-regular fa-clock"></i>
                            Data de adesão: 
                            {{ date('Y', strtotime(Auth::user()->created_at)) }}
                        </a>
                    </div>

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
