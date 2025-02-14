<div>
    <div class="nav-down">
        <div class="box">
            <a href="/">
                <button><i class="fa fa-home"></i></button>
            </a>
        </div>
        <div class="box">
            <a href="/criar">
                <button><i class="fa-solid fa-add"></i></button>
            </a>
        </div>
        <div class="box">
            <a wire:click="toggleNavSidbar">
                <button><i class="fa fa-bars"></i></button>
            </a>
        </div>
    </div>
    @if($isNavSidbar)
    <div class="relactive">
        <div class="sidbar-responsive">

                <a href="/">
                    <div class="sib-box {{Request::is('/') ? 'destaque' : ''}}">
                        <button><i class="fa fa-home"></i></button>
                        <div class="text">Home</div>
                    </div>
                </a>

                @auth
                    <a href="/perfil">
                        <div class="sib-box {{ Request::is('perfil') ? 'destaque' : '' }}">
                            <button>
                                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="user">
                            </button>
                            <div class="text">{{ Auth::user()->name }}</div>
                        </div>
                    </a>
                    <a href="{{ url('/dashboard') }}"class="">
                        <div class="sib-box">
                            <button><i class="fa-solid fa-right-to-bracket"></i></button>
                            <div class="text">Dashboard</div>
                        </div>
                    </a>


                @endauth
                <a href="/criar"class="">
                    <div class="sib-box {{ Request::is('criar') ? 'destaque' : '' }}">
                        <button><i class="fa-solid fa-add"></i></button>
                        <div class="text">Criar conteúdo</div>
                    </div>
                </a>
                @guest

                <a href="/perfil">
                    <div class="sib-box {{ Request::is('perfil') ? 'destaque' : '' }}">
                        <button>
                            <i class="fa fa-user"></i>
                        </button>
                        <div class="text">Perfil</div>
                    </div>
                </a>


                @if (Route::has('register'))
                    <a href="{{ route('register') }}">
                        <div class="sib-box">
                            <button><i class="fa fa-share"></i></button>
                            <div class="text">
                                Criar conta
                            </div>
                        </div>
                    </a>
                @endif
                @endguest

                <a href="/guardados">
                    <div class="sib-box">
                        <button>
                            <i class="fa-solid fa-bookmark"></i>
                        </button>
                        <div class="text">Guardados</div>
                    </div>
                </a>

                <a href="/videos">
                    <div class="sib-box {{ Request::is('videos') ? 'destaque' : '' }}">
                        <button><i class="fa fa-video"></i></button>
                        <div class="text">Vídeos</div>
                    </div>
                </a>

                <a href="/imagens">
                    <div class="sib-box {{ Request::is('imagens') ? 'destaque' : '' }}">
                        <button><i class="fa fa-images"></i></button>
                        <div class="text">Imagens</div>
                    </div>
                </a>

                <a href="/livros-pdfs">
                    <div class="sib-box {{ Request::is('livros-pdfs') ? 'destaque' : '' }}">
                        <button><i class="fa fa-book"></i></button>
                        <div class="text">Livros & PDFs</div>
                    </div>
                </a>

                <a href="/audios">
                    <div class="sib-box {{ Request::is('audios') ? 'destaque' : '' }}">
                        <button><i class="fa-solid fa-microphone-lines"></i></button>
                        <div class="text">Audios</div>
                    </div>
                </a>


                <a href="/definicoes">
                    <div class="sib-box {{ Request::is('definicoes') ? 'destaque' : '' }}">
                        <button><i class="fa-solid fa-gear"></i></button>
                        <div class="text">Definições</div>
                    </div>
                </a>

                <a href="/support">
                    <div class="sib-box {{ Request::is('support') ? 'destaque' : '' }}">
                        <button><i class="fa-solid fa-headset"></i></button>
                        <div class="text">Support</div>
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
                                Terminar sessão
                            </div>
                        </div>
                    </a>
                </form>
                @endauth
                @guest
                <a href="{{ route('login') }}">
                    <div class="sib-box">
                        <button><i class="fa-solid fa-right-to-bracket"></i></button>
                        <div class="text">Iniciar sessão</div>
                    </div>
                </a>
                @endguest
                <hr>
                <div class="inside">
                    <a href="/support">Contacto \ Support</a>
                    <a href="">Como funciona o Miduka?</a>
                    <a href="">Qual é a nossa missão?</a>
                    <a href="">Sobre nos</a>
                    <a href="/terms-of-service">Termos</a>
                    <a href="/privacy-policy">Privacidade</a>
                    <div>
                        By: <a href="">Dionísio Neto</a> & <a href="">Claudio Jorge</a>
                    </div>
                    <hr>
                    <div>
                        Miduka &copy; 2025
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
