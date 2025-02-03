<div>
    @if($isModalVisible)
        <div>
            <div class="modalAccount">
                <div class="contentModal">
                    <h4>Tem a certeza que pretende excluir a sua conta?</h4>
                    <p>Lembrando que se excluir a conta {{ Auth::user()->name }}, você perderá alguns previlégios</p>
                    <div class="buttons">
                        <div class="btn" wire:click="destroy">Excluir conta</div>
                        <div class="btn" wire:click="toggleModal">Cancelar</div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <main>
    <h1>Definições</h1>
    <a href="/">
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
    <a href="/">
        <div class="box">
            <div class="icons">
                <i class="fa fa-edit"></i>
                <span>Alterar seu email</span>
            </div>
            <div>
                <i class="fa-solid fa-angle-right"></i>
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
                <i class="fa-solid fa-angle-right"></i>
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
    </main>
</div>
