<div class="relactive">
    <header>
        <a href="/">
            <div class="logo">
                <img src="{{ url("storage/more/logo.png") }}" class="Logo"  title="Logo">
            </div>
        </a>
        <div class="search-input search">
            <button wire:click='openKeyBoard'>
                <i class="fa fa-keyboard"></i>
            </button>

            <form class="search">
                <input type="text" wire:model.live="search" class="form-control" placeholder="Pesquisar usuário..."/>
                <div>
                    <i class="fa fa-search"></i>
                </div>
            </form>

        </div>
        <div class="last-header">
            <a href="/Pesquisar"  title="Pesquisar">
                <button class="search-btn">
                    <i class="fa fa-search"></i>
                </button>
            </a>

            <button class="dark-mode" id="toggle-mode">
                <i class="fa-solid fa-circle-half-stroke"></i>
            </button>

            <a wire:click="openNotification"  title="Notificações">
                <button>
                    <div class="notification">
                            <i class="fa fa-bell"></i>
                           @auth
                           @if ($notification_verify->count())
                           <div class="counter">
                            {{ $notification_verify->count() }}
                           </div>
                           @endif
                           @endauth
                    </div>
                </button>
            </a>
            @guest
            <a href="/perfil" title="Iniciar sessão">
                <div class="img-photo">
                    <img src="./imgs/avatar.webp" alt="">
                </div>  
            </a>
            @endguest
            @auth
            <a href="/perfil" title="{{ Auth::user()->name }}">
                <div class="img-photo">
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="">
                </div>
            </a>
            @endauth
        </div>

        @if ($isNotification)
        <div class="modalNotification">
            <h2>Notificações</h2>
            <div class="notification-content">
            @auth
            @if ($notification->count() > 0)
            @foreach ($notification as $item)
            <a href="/ver/{{ $item->conteudo_id }}">
                <div class="notification-box">
                    <img src="{{ $item->user->profile_photo_url }}" alt="Foto de perfil" >
                    <div class="text">
                        <div class="nome">
                            <span>{{ $item->user->name }}</span>
                            <span class="time">
                                {{ date('d/m/Y', strtotime($item->created_at)) }} |
                                {{ date(' H', strtotime($item->created_at)) }} H {{ date('m', strtotime($item->created_at)) }} M 
                            </span>
                        </div>
                        <div class="notify">{{ $item->content_notification }}</div>
                    </div>
                    @if($item->verify == true)
                    <div class="red-ball-nt">
                    </div>
                    @endif
                </div>
            </a>
            @endforeach  
            @else
            <div class="center">
                Sem alguma notificações
            </div>
            @endif
            @endauth
            @guest
                <div class="center">
                    Inicie sessão para ter acesso.
                </div>
            @endguest
        </div>
        </div>
        @endif
    </header>

    
    @if($search)
    <div class="result">
        <p>Resultados de usuários: {{ $search }}</p>
        <hr>

        @if ($users->count() > 0)
            <ul class="list-group">
                @foreach($users as $user)
                <a href="/usuario/{{ $user->id }}">
                    <li class="list-group-item">
                            <img src="{{ $user->profile_photo_url }}" alt="Profile photo">
                            {{ $user->name }}
                    </li>
                </a>
                @endforeach
            </ul>
        @else
            <h4>⚠️ Usuário não encontrado</h4>
        @endif
        <hr>
        <p>Resultados de conteúdos: {{ $search }}</p>
        <hr>
        @if ($cont->count() > 0)
            <ul class="list-group">
                @foreach($cont as $conts)
                <a href="/ver/{{ $conts->id }}">
                    <li class="list-group-item">
                        <img src="{{ url("storage/uploads/{$conts->capa}") }}" alt="Profile photo">
                        {{ strlen($conts->description) > 17 ? substr($conts->description, 0, 17) . ' ver mais ...' : $conts->description }}
                        @if ($conts->type_tag == "jpg" | $conts->type_tag == "png")
                            <i class="fa fa-images"></i>
                        @elseif($conts->type_tag == "mp3")
                            <i class="fa-solid fa-microphone-lines"></i>
                        @elseif($conts->type_tag == "pdf")
                            <i class="fa fa-book"></i>
                        @elseif($conts->type_tag == "mp4")
                            <i class="fa fa-video"></i>
                        @else
                            ⚠️
                        @endif
                    </li>
                </a>
                @endforeach
            </ul>
        @else
            <h4>⚠️ Usuário não encontrado</h4>
        @endif
    </div>
@endif

    @if ($beyBoard)
        <div 
            x-data="draggable()" 
            x-init="init()" 
            :style="{ left: x + 'px', top: y + 'px' }" 
            @mousedown="startDrag($event)" 
            class="draggable"
        >
            <!-- Cabeçalho do teclado -->
            <div class="flex">
                <h4>Teclado</h4>
                <button type="button" wire:click='openKeyBoard'>&times;</button>
            </div>

            <!-- Letras A-Z -->
            <div class="all">
                @foreach(range('A', 'Z') as $letra)
                    <button 
                        type="button"
                        wire:click="addChar('{{ $letra }}')"
                    >{{ $letra }}</button>
                @endforeach
            </div>

            <!-- Espaço e Apagar -->
            <div class="flex" style="margin-top: 5px;">
                <button type="button" wire:click="addChar(' ')">Espaço</button>
                <button type="button" wire:click="backspace">Apagar</button>
            </div>
        </div>
    @endif
</div>