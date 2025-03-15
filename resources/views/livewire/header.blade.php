<div class="relactive">
    <header>
        <a href="/">
            <div class="logo">
                <img src="./IMG_8610.JPG" alt="">
            </div>
        </a>
        <div class="search-input search">
            <button wire:click='openKeyBoard'>
                <i class="fa fa-keyboard"></i>
            </button>

            <form action="/Pesquisar" method="get" class="search">
                @csrf
                <input type="text" wire:model.live="search" class="form-control" placeholder="Pesquisar usuário..." />
                <button>
                    <i class="fa fa-search"></i>
                </button>
            </form>

        </div>
        <div class="last-header">
            <a href="/Pesquisar">
                <button class="search-btn">
                    <i class="fa fa-search"></i>
                </button>
            </a>

            <button class="dark-mode" id="toggle-mode">
                <i class="fa-solid fa-circle-half-stroke"></i>
            </button>

            <a wire:click="openNotification">
                <button>
                    <div class="notification">
                            <i class="fa fa-bell"></i>
                        <div class="counter">{{ $notification->count() }}</div>
                    </div>
                </button>
            </a>
            @guest
            <a href="/login">
                <div class="img-photo">
                    <img src="./imgs/avatar.webp" alt="">
                </div>
            </a>
            @endguest
            @auth
            <a href="/perfil">
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
        <p>Resultados para: {{ $search }}</p>
        <ul class="list-group">
            @foreach($users as $user)
            <li class="list-group-item">
                <a href="/usuario/{{ $user->id }}">
                    {{ $user->name }} ({{ $user->email }})
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    @endif





</div>
