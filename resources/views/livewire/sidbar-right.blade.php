<div class="relactive">
    <div class="sidbar-right">
        @guest
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <h3>{{__('Log in')}}</h3>
                <input type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email" class="btn-simple">
                <input type="password" name="password" required autocomplete="current-password" placeholder="Palavra-passe" class="btn-simple">
                <input type="submit" value="{{ __('Login') }}" class="btn-submit-simple">
                <span>Ainda não tem conta? <a href="/register">{{ __('Create Account') }}</a></span>
            </div>
        </form>
        <hr>
        @endguest
        <div class="inside">
            <a href="/support">Contacto \ Support</a>
            <a href="">Como funciona o Miduka?</a>
            <a href="">Qual é a nossa missão?</a>
            <a href="">Sobre nos</a>
            <a href="/terms-of-service">{{ __('Terms of Service') }}</a>
            <a href="/privacy-policy">Privacidade</a>
            <div>
                By: <a href="">Dionísio Neto</a>
            </div>
            <hr>
            <div>
                Miduka &copy; 2025
            </div>
        </div>
    </div>
</div>
