<div class="relactive">

    <div x-data="{ path: window.location.pathname }" class="sidbar">
        <a href="/">
            <div :class="path === '/' ? 'sib-box destaque' : 'sib-box'">
                <button><i class="fa fa-home"></i></button>
                <div class="text">Home</div>
            </div>
        </a>
    
        @auth
        <a href="/perfil">
            <div :class="path.startsWith('/perfil') ? 'sib-box destaque' : 'sib-box'">
                <button>
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="user">
                </button>
                <div class="text">{{ Auth::user()->name }}</div>
            </div>
        </a>
        @endauth
    
        <a href="/criar">
            <div :class="path.startsWith('/criar') ? 'sib-box destaque' : 'sib-box'">
                <button><i class="fa-solid fa-add"></i></button>
                <div class="text">Criar conteúdo</div>
            </div>
        </a>
    
        @guest
        <a href="/perfil">
            <div :class="path.startsWith('/perfil') ? 'sib-box destaque' : 'sib-box'">
                <button><i class="fa fa-user"></i></button>
                <div class="text">{{ __('Profile') }}</div>
            </div>
        </a>
        @endguest
    
        <a href="/guardados">
            <div :class="path.startsWith('/guardados') ? 'sib-box destaque' : 'sib-box'">
                <button><i class="fa-solid fa-bookmark"></i></button>
                <div class="text">Guardados</div>
            </div>
        </a>
    
        <a href="/videos">
            <div :class="path.startsWith('/videos') ? 'sib-box destaque' : 'sib-box'">
                <button><i class="fa fa-video"></i></button>
                <div class="text">Vídeos</div>
            </div>
        </a>
    
        <a href="/imagens">
            <div :class="path.startsWith('/imagens') ? 'sib-box destaque' : 'sib-box'">
                <button><i class="fa fa-images"></i></button>
                <div class="text">Imagens</div>
            </div>
        </a>
    
        <a href="/livros-pdfs">
            <div :class="path.startsWith('/livros-pdfs') ? 'sib-box destaque' : 'sib-box'">
                <button><i class="fa fa-book"></i></button>
                <div class="text">Livros & PDFs</div>
            </div>
        </a>
    
        <a href="/audios">
            <div :class="path.startsWith('/audios') ? 'sib-box destaque' : 'sib-box'">
                <button><i class="fa-solid fa-microphone-lines"></i></button>
                <div class="text">Áudios</div>
            </div>
        </a>
    
        <a href="/definicoes">
            <div :class="path.startsWith('/definicoes') ? 'sib-box destaque' : 'sib-box'">
                <button><i class="fa-solid fa-gear"></i></button>
                <div class="text">Definições</div>
            </div>
        </a>
    
        <a href="/support">
            <div :class="path.startsWith('/support') ? 'sib-box destaque' : 'sib-box'">
                <button><i class="fa-solid fa-headset"></i></button>
                <div class="text">Suporte</div>
            </div>
        </a>

            @auth
        <form action="/logout" method="post">
            @csrf
            <a href="./logout"
                onclick="event.preventDefault();
                this.closest('form').submit();"
            >
                <div class="sib-box">
                    <button><i class="fa-solid fa-right-from-bracket"></i></button>
                    <div class="text">
                        {{__('Log Out')}}
                    </div>
                </div>
            </a>
        </form>
        @endauth
        @guest

        @if (Route::has('register'))
        <a href="{{ route('register') }}">
            <div class="sib-box">
                <button><i class="fa fa-user-plus"></i></button>
                <div class="text">
                    {{ __('Create Account') }}
                </div>
            </div>
        </a>
        @endif
        <a href="{{ route('login') }}">
            <div class="sib-box">
                <button><i class="fa-solid fa-right-to-bracket"></i></button>
                <div class="text">{{__('Log in')}}</div>
            </div>
        </a>
        @endguest
    </div>
</div>
