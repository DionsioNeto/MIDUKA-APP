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

            <button class="dark-mode">
                <i class="fa-solid fa-circle-half-stroke"></i>
            </button>

            <button wire:click="openNotification">
                <div class="notification">
                        <i class="fa fa-bell"></i>
                    <div class="counter">15</div>
                </div>
            </button>
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



    @if ($isNotification)
    <div class="modalNotification">
        <h1>Notificações</h1>
    </div>
    @endif

</div>
