<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar conta</title>
</head>
<body>
    <style>

        body {
            background-color: #1E1E20;
            color: #908d8d;
            font-family: system-ui;
            margin: 0;
            text-align: center;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        * {
            padding: 0;
            margin: 0;
            list-style: none;
            color: #908d8d;
            text-decoration: none;
        }

        .erro{
            max-width: 75%;
            margin: 5px 0px;
            padding: 5px;
            border-radius: 10px;
            border: 4px solid red;
            background-color: #c52b2b;
            color: #fff;
        }

        .logo img {
            width: 40px;
            opacity: .4;
        }
        .logo {
            width: 60px;
            height: 60px;
            margin: auto;
            background-color: #2C2C2E;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            box-shadow: 0 10px 30px #0004;
            margin-bottom: 10px;
        }
        h1 {
            color: #fff;
            font-size: x-large;
            margin-bottom: 5px;
        }
        .text-white {
            color: #fff;
        }
        form {
            display: flex;
            margin: auto;
            margin-block: 30px;
            width: min(300px, 90vw);
            gap: 15px;
            flex-wrap: wrap;
        }
        form input:not(input[type="checkbox"]),
        form button {
            all: unset;
            padding: 10px;
            border-radius: 15px;
            background-color: #1C1C1E;
            box-shadow: 0 10px 30px #0005;
            border: 1px solid #71717188;
            transition: background-image 0.5s, opacity .5s, border .5s;

        }
        form * {
            width: 100%!important;
        }
        form input {
            color: #fff;
        }
        form button {
            cursor: pointer;
        }
        form button[type="submit"] {
            background-color: #fff;
            color: #1C1C1E;
        }
        .or {
            position: relative;
        }
        .or::before {
            position: absolute;
            width: 100%;
            height: 1px;
            content: '';
            left: 0;
            top: 45%;
            background-image: linear-gradient(
                to right,
                #71717155 0 40%, transparent 40% 60%, #71717155 60%
            );
        }
        p a {
            border-bottom: 1px solid #717171;
        }
        input + p {
            font-size: small;
            text-align: left;
        }
        .sso {
            margin-bottom: 30px;
        }
        .sso + p {
            font-size: small;
        }
        input:invalid:not(:placeholder-shown) {
            border-color: red;
            background-image: url(checked_red.png);
        }
        input:valid:not(:placeholder-shown) {
            background-image: url(checked_green.png);
        }
        input:invalid:not(:placeholder-shown),
        input:valid:not(:placeholder-shown) {
            background-size: 20px;
            background-repeat: no-repeat;
            background-position: calc(100% - 10px);
        }
        input:invalid:not(:placeholder-shown) + p {
            color: #a20e0e;
        }
        input:invalid ~ button[type="submit"] {
            opacity: .6;
            pointer-events: none;
        }
        .flex-inside p{
            display: grid;
            grid-auto-flow: column;
            font-size: small;
        }
        .flex-inside p a{
            display: block;
        }
    </style>



        <header>
            <a href="/">
                <div class="logo">

                </div>
            </a>
            <h1>Bem-vido (a) !</h1>
            <p>Já tenho uma conta
                <a href="/login">Iniciar sessão</a>
            </p>
        </header>
        @if ($errors->any())
        <div class="erro">
            <div class="font-medium text-red-600 dark:text-red-400">{{ __('Whoops! Something went wrong.') }}</div>
                <ul class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Digite seu nome" />

            <input type="email" name="email" :value="old('email')" required placeholder="Digite seu Email"/>

            <input type="password" name="password" required autocomplete="new-password" placeholder="Digite sua palavra-passe" minlength="8" />

            <p>O campo acima precisa ter no minímo 8 caracteres</p>

            <input type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirme a sua palavra-passe" minlength="8"/>

            <p>O campo acima precisa ter no minímo 8 caracteres</p>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="flex-inside">
                <p>
                    <input type="checkbox" name="terms" required />

                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Terms of Service').'</a>',
                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Privacy Policy').'</a>',
                    ]) !!}
                </p>
            </div>
            @endif

            <button type="submit">Iniciar sessão</button>

            <div class="or">OU</div>
            <button class="sso" type="button">Login Com a Google</button>
            <p>
                You acknowledge that you read, and agree, to our <a href="/terms-of-service">Termos de serviços</a> e nossas <a href="/privacy-policy">Politicas no geral</a>.
            </p>
        </form>
</body>
</html>
