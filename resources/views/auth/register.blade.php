<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar conta</title>
</head>
<link rel="stylesheet" href="./styles/login.css">

<body>
        <header>
            <a href="/">
                <div class="logo">
                    <img src="{{ url("storage/more/logo.png") }}" class="Logo">
                </div>
            </a>
            <h1>{{__('Welcome!')}}</h1>
            <p>{{__('I already have an account')}}
                <a href="/login">{{__('Log in')}}</a>
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

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Digite seu nome" />

            <input type="email" name="email" :value="old('email')" required placeholder="{{__('Your email address')}}"/>

            <input type="password" name="password" required autocomplete="new-password" placeholder="{{__('Your password')}}" minlength="8" />

            <p>{{__('The field above must have at least 8 characters')}}</p>

            <input type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirme a sua palavra-passe" minlength="8"/>

            <p>{{__('The field above must have at least 8 characters')}}</p>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <label for="check">
                <div class="flex-inside">
                    <p class="not">
                        <input type="checkbox" id="check" name="terms" required />

                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="">'.__('Terms of Service').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="">'.__('Privacy Policy').'</a>',
                        ]) !!}
                    </p>
                </div>
            </label>
            @endif

            <button type="submit">{{__('Create Account')}}</button>

            
            <div class="or">{{ __('or') }}</div>
            <button class="sso" type="button">{{ __('Login with Google') }}</button>
            <p>
                {{__('You acknowledge that you read, and agree, to our')}} <a href="/terms-of-service">{{__('Terms of Service')}}</a> {{__('and our')}} <a href="/privacy-policy">{{__('General Policy')}}</a>.
            </p>
        </form>
</body>
</html>
