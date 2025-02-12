<div>
    {{-- Model excluir conta! --}}
    @if($isModalVisible)
        <div>
            <div class="modalAccount">
                <div class="contentModal">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <h4>Tem a certeza que pretende excluir a sua conta?</h4>
                    <p>Lembrando que se excluir a conta <strong>{{ Auth::user()->name }}</strong> , você perderá alguns previlégios</p>
                    <div class="buttons">
                        <div class="btn" wire:click="destroy">Excluir conta</div>
                        <div class="btn" wire:click="toggleModal">Cancelar</div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- Modal da imagens de perfil --}}
    @if($plofileImage)
        <div>
            <div class="modalAccount">
                <div class="contentModal">
                    <h1>foto de perfil</h1>
                </div>
            </div>
        </div>
    @endif
    {{-- Modal de alteração de email --}}
    @if($isProfileEmail)
        <div>
            <div class="modalAccount">
                <div class="contentModal">
                    <h1>email</h1>
                </div>
            </div>
        </div>
    @endif
    {{-- Modal de alteração de nome do perfil --}}
    @if($isPlofileImage)
        <div>
            <div class="modalAccount">
                <div class="contentModal">
                    <h1>imagem de perfil</h1>
                </div>
            </div>
        </div>
    @endif
    {{-- Modal de alteração de palavra-passe --}}
    @if($isPassWord)
        <div>
            <div class="modalAccount">
                <div class="contentModal">
                    <h1>password</h1>
                </div>
            </div>
        </div>
    @endif

    @if ($imageProfileCap)
        <div>
            <div class="modalAccount">
                <div class="contentModal">
                    <h1>imagem de capa</h1>
                </div>
            </div>
        </div>
    @endif



    <main>
    <h1>Definições</h1>
    <a id="toggle-mode">
        <div class="box">
            <div class="icons">
                <i class="fa-solid fa-circle-half-stroke"></i>
                <span>Alterar modo de fundo</span>
            </div>
            <div>
                <i class="fa-solid fa-arrow-right-long"></i>
            </div>
        </div>
    </a>

    <a wire:click="toggleProfileImage">
        <div class="box">
            <div class="icons">
                <i class="fa fa-edit"></i>
                <span>Alterar do seu perfil</span>
            </div>
            <div>
                <i class="fa-solid fa-arrow-right-long"></i>
            </div>
        </div>
    </a>

    <a wire:click="toggleImageProfileCap">
        <div class="box">
            <div class="icons">
                <i class="fa fa-edit"></i>
                <span>Alterar imagem de capa do seu perfil</span>
            </div>
            <div>
                <i class="fa-solid fa-arrow-right-long"></i>
            </div>
        </div>
    </a>

    <a wire:click="toggleProfileEmail">
        <div class="box">
            <div class="icons">
                <i class="fa fa-edit"></i>
                <span>Alterar seu email</span>
            </div>
            <div>
                <i class="fa-solid fa-arrow-right-long"></i>
            </div>
        </div>
    </a>

    <a wire:click="toggleModalImage">
        <div class="box">
            <div class="icons">
                <i class="fa fa-edit"></i>
                <span>Alterar sua foto de perfil</span>
            </div>
            <div>
                <i class="fa-solid fa-arrow-right-long"></i>
            </div>
        </div>
    </a>

    <a wire:click="togglePassWord">
        <div class="box">
            <div class="icons">
                <i class="fa fa-edit"></i>
                <span>Alterar sua palavra-passe</span>
            </div>
            <div>
                <i class="fa-solid fa-arrow-right-long"></i>
            </div>
        </div>
    </a>

    <a href="/">
        <div class="box">
            <div class="icons">
                <i class="fa fa-user"></i>
                <span>Canta</span>
            </div>
            <div>
                <i class="fa-solid fa-arrow-right-long"></i>
            </div>
        </div>
    </a>

    <a href="/">
        <div class="box">
            <div class="icons">
                <i class="fa fa-user"></i>
                <span>Canta</span>
            </div>
            <div>
                <i class="fa-solid fa-arrow-right-long"></i>
            </div>
        </div>
    </a>

    <hr>

    <h3>Zona perigosa</h3>

    <a href="/">
        <div class="box red">
            <div class="icons">
                <i class="fa-regular fa-snowflake"></i>
                <span>Congelar a sua conta</span>
            </div>
            <div>
                <i class="fa-solid fa-arrow-right-long"></i>
            </div>
        </div>
    </a>

    <a wire:click="toggleModal">
        <div class="box red">
            <div class="icons">
                <i class="fa fa-trash"></i>
                <span>Excluir a sua conta</span>
            </div>
            <div>
                <i class="fa-solid fa-arrow-right-long"></i>
            </div>
        </div>
    </a>

    <form action="/logout" method="post">
        @csrf
        <a href="./logout"
            onclick="event.preventDefault();
            this.closest('form').submit();"
        >
            <div class="box red">
                <div class="icons">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Terminar sessão</span>
                </div>
                <div>
                    <i class="fa-solid fa-arrow-right-long"></i>
                </div>
            </div>
        </a>

    </form>
    <div wire:offline>
        <livewire:all-pages />
    </div>
    </main>
</div>
