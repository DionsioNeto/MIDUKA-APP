<div class="relactive">
    <div class="sidbar-right">
        @guest
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <h3>Inicie sua sessão</h3>
                <input type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email">
                <input type="password" name="password" required autocomplete="current-password" placeholder="Palavra-passe">
                <input type="submit" value="Iniciar sessão">
                <span>Ainda não tem conta? <a href="/register">Criar conta</a></span>
            </div>
        </form>
        <hr>
        @endguest
        <div class="inside">
            <a href="">Contacto \ Support</a>
            <a href="">Como funciona o Miduka?</a>
            <a href="">Qual é a nossa missão?</a>
            <a href="">Sobre nos</a>
            <a href="/terms-of-service">Termos</a>
            <a href="">Privacidade</a>
            <div>
                By: <a href="">Dionísio Neto</a> & <a href="">Claudio Jorge</a>
            </div>
            <hr>
            <div>
                Miduka &copy; 2024
            </div>
        </div>
    </div>
</div>
