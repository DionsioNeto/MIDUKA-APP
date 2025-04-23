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
                    <img src="{{ url("storage/more/logo.png") }}" class="Logo">
                </div>
            </a>
            <div class="ol">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>
        </header>
        @session('status')
        <div class="sucesso">
            {{ $value }} <br> Verifique o seu email nos proximos 60 minutos
        </div>
        @endsession
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

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <input type="email" name="email" :value="old('email')" required placeholder="{{__('Your email address')}}"/>

            <button type="submit">{{ __('Email Password Reset Link') }}</button>

            <p class="not">
                <a href="/login">
                    {{ __('Login') }}
                </a>
            </p>

        </form>
</body>
</html>
