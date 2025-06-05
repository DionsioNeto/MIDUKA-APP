<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verificação de email</title>
    <link rel="stylesheet" href="{{ asset('./styles/login.css') }}">
</head>
<body>
    <header>
        <a href="/">
            <div class="logo">
                <x-slot name="logo">
                </x-slot>
                <img src="{{ url("storage/more/logo.png") }}" class="Logo">
            </div>
        </a>
        <h1>Verifique seu email!</h1>
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
    </header>
    <div>
        Antes de continuar, você deve verificar seu endereço de e-mail, 
        <br> Clicando no link que acabamos de enviar para o seu e-mail.
        <br> Se você não recebeu o e-mail de verificação, teremos o prazer em enviar outro.
    </div>

    @if (session('status') == 'verification-link-sent')
    <div>
        {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
    </div>
    @endif

    <div>
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-button type="submit">
                    {{ __('Resend Verification Email') }}
                </x-button>
            </div>
        </form>
    </div>
    <div>
        <form action="/logout" method="post">
            @csrf
            <a href="./logout"
                onclick="event.preventDefault();
                this.closest('form').submit();"
            >
                <div class="sib-box">
                    <div class="text">
                        {{__('Log Out')}}
                    </div>
                </div>
            </a>
        </form>
    </div>
</body>
</html>