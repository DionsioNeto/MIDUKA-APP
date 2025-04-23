<x-guest-layout>
    <x-authentication-card>
        
        <header>
            <a href="/">
                <div class="logo">
                    <x-slot name="logo">
                    </x-slot>
                    <img src="{{ url("storage/more/logo.png") }}" class="Logo">
                </div>
            </a>
            <h1>Redefinir sua palavra passe</h1>
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
        

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" placeholder="Digite seu email" />
            </div>

            <div class="mt-4">
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Digite sua noma palavra-passe"/>
            </div>

            <div class="mt-4">
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirme sua noma palavra-passe"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>


    <link rel="stylesheet" href="{{ asset('./styles/login.css') }}">

    
