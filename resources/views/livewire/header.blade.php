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
                <input type="text" wire:model.live="search" class="form-control" placeholder="Pesquisar usuário..." />
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
                        <div class="counter">{{ $notification->count() }}</div>
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
                @if (count($notification) > 0 )
                @foreach ($notification as $item)
                <div class="notification-box">
                    <img src="./imgs/avatar.webp" alt="" >
                    <div class="text">
                        <div class="nome">Dionísio Neto</div>
                        <div class="notify">Lorem ipsum, dolor sit amet...</div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <h3>Sem Notificações...</h3>
            @endif
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
    </div>
@endif

</div>
