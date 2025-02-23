<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Login' )}}</title>
    <link rel="stylesheet" href="./styles/login.css">
</head>
<body>


        <header>
            <a href="/">
                <div class="logo">

                </div>
            </a>
            <h1>{{ __('Welcome back!')}}</h1>
            <p>Ainda não tem conta?
                <a href="/register">{{ __('Create Account') }}</a>
            </p>
        </header>
        @if ($errors->any())
        <div class="erro">
            <div>{{ __('Whoops! Something went wrong.') }}</div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <input type="email" name="email" :value="old('email')" required placeholder="{{__('Your email address')}}"/>

            <input type="password" name="password" required placeholder="{{__('Your password')}}" minlength="8" />
            <p>Palavra-passe precisa ter no mínimo 8 caracteres</p>

            <button type="submit">{{ __('Log in') }}</button>

            <p class="not">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </p>

            <div class="or">{{ __('or') }}</div>
            <button class="sso" type="button">{{ __('Login with Google') }}</button>
            <p>
                You acknowledge that you read, and agree, to our <a href="/terms-of-service">Termos de serviços</a> e nossas <a href="/privacy-policy">Politicas no geral</a>.
            </p>
        </form>
</body>
</html>
