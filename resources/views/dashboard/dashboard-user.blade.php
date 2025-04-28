<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 lg:p-8 bg-white dark:bg-gray-900 shadow rounded-2xl border border-gray-200 dark:border-gray-700">
    
                <!-- Avatar e Menu -->
                <div class="flex flex-col items-center">
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none transition">
                                    <img class="w-24 h-24 rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
                                </button>
                            @endif
                        </x-slot>
    
                        <x-slot name="content">
                            <div class="px-4 py-2 text-xs text-gray-400">
                                {{ __('Gerenciar Conta') }}
                            </div>
    
                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Perfil') }}
                            </x-dropdown-link>
    
                            <div class="border-t border-gray-200 dark:border-gray-600 my-1"></div>
    
                            <x-dropdown-link href="#">
                                {{ __('Notificar Conta') }}
                            </x-dropdown-link>
    
                            <x-dropdown-link class="text-red-600" href="#">
                                {{ __('Deletar Conta') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
    
                    <h1 class="mt-6 text-3xl font-bold text-gray-900 dark:text-white">
                        {{ $user->name }}
                    </h1>
    
                    <!-- Botões -->
                    <div class="mt-6 flex flex-wrap justify-center gap-4">
                        <a href="{{ $user->id }}">
                            <x-button class="bg-indigo-600 hover:bg-indigo-700">
                                Ver Perfil
                            </x-button>
                        </a>
    
                        <a href="{{ $user->id }}">
                            <x-button class="bg-yellow-500 hover:bg-yellow-600">
                                Editar Perfil
                            </x-button>
                        </a>
    
                        <form method="POST" action="{{ $user->id }}" onsubmit="return confirm('Tem certeza que deseja deletar?');">
                            @csrf
                            @method('DELETE')
                            <x-danger-button class="bg-red-500 hover:bg-red-600">
                                Deletar Perfil
                            </x-danger-button>
                        </form>
    
                        <a href="{{ $user->id }}">
                            <x-button class="bg-gray-700 hover:bg-gray-800">
                                Bloquear Usuário
                            </x-button>
                        </a>
                    </div>
                </div>
    
                <!-- Estatísticas -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 mt-10">
                    @php
                        $cards = [
                            [
                                'title' => 'Mensagens de Suporte',
                                'value' => '00',
                                'link' => '#',
                                'link_text' => 'Ver mensagens',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955a.75.75 0 011.06 0l8.954 8.955M4.5 10.5v7.5a.75.75 0 00.75.75h3.75m6 0h3.75a.75.75 0 00.75-.75v-7.5M9 21h6" />',
                            ],
                            [
                                'title' => 'Denúncias Recebidas',
                                'value' => '02',
                                'link' => '#',
                                'link_text' => 'Ver denúncias',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25c.621 0 1.183.214 1.635.571a2.623 2.623 0 011.635-.571h4.5c1.38 0 2.5 1.12 2.5 2.5v13.5a2.5 2.5 0 01-2.5 2.5h-4.5c-.621 0-1.183-.214-1.635-.571a2.623 2.623 0 01-1.635.571h-4.5a2.5 2.5 0 01-2.5-2.5V4.75a2.5 2.5 0 012.5-2.5h4.5z" />',
                            ],
                            [
                                'title' => 'Data de Adesão',
                                'value' => date('d/m/Y', strtotime($user->created_at)),
                                'link' => null,
                                'link_text' => null,
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75v.75m7.5-.75v.75m-9-2.25h10.5a2.25 2.25 0 012.25 2.25v10.5a2.25 2.25 0 01-2.25 2.25H6.75a2.25 2.25 0 01-2.25-2.25V7.5a2.25 2.25 0 012.25-2.25z" />',
                            ],
                            [
                                'title' => 'Conteúdos Publicados',
                                'value' => '01',
                                'link' => '#',
                                'link_text' => 'Ver conteúdos',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M3 12h18M3 18h18" />',
                            ],
                        ];
                    @endphp
    
                    @foreach($cards as $card)
                        <div class="bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-2xl p-6 flex flex-col gap-4 transition hover:border-indigo-500 dark:hover:border-indigo-400">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    {!! $card['icon'] !!}
                                </svg>
                                <h2 class="ml-4 text-lg font-bold text-gray-900 dark:text-white">
                                    {{ $card['title'] }}
                                </h2>
                            </div>
    
                            <p class="mt-4 text-2xl font-extrabold text-gray-700 dark:text-gray-300">
                                {{ $card['value'] }}
                            </p>
    
                            @if($card['link'])
                                <p class="mt-3">
                                    <a href="{{ $card['link'] }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 dark:text-indigo-400">
                                        {{ $card['link_text'] }}
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10.293 15.707a1 1 0 001.414 0l5-5a1 1 0 00-1.414-1.414L12 12.586V4a1 1 0 10-2 0v8.586l-3.293-3.293a1 1 0 00-1.414 1.414l5 5z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </p>
                            @endif
                        </div>
                    @endforeach
                </div>
    
            </div>
        </div>
    </div>
        
    
    
    
    
    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-900  border-b border-gray-200 dark:border-gray-700">
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="size-20 rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
                                </button>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <div class="border-t border-gray-200 dark:border-gray-600"></div>

                            <!-- Authentication -->

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Notify account') }}
                            </x-dropdown-link>

                            <x-dropdown-link class="text-red-600 dark:text-red-600" href="{{ route('profile.show') }}">
                                {{ __('Delete account') }}
                            </x-dropdown-link>

                        </x-slot>
                    </x-dropdown>
                    <h1 class="mt-8 mb-4 text-2xl font-medium text-gray-900 dark:text-white">
                        {{ $user->name }}
                    </h1>
                <a href="/usuario/{{  $user->id }}">
                    <x-button class="bg-red-500 text-">
                        Ver perfil
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 size-5">
                            <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                        </svg>
                    </x-button>
                </a>


                <x-danger-button class="bg-red-500 text-">
                    Deletar perfil
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 size-5 fill-white">
                        <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                    </svg>
                </x-danger-button>
                </div>
                
                <div class="bg-gray-100 dark:bg-gray-900 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
                    <div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="size-6 stroke-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                            <h2 class="ms-3 text-xl font-semibold text-gray-900 dark:text-white">
                                <a href="https://laravel.com/docs">Número de mensagem de support</a>
                            </h2>
                        </div>
                
                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            00
                        </p>
                
                        <p class="mt-4 text-sm">
                            <a href="https://laravel.com/docs" class="inline-flex items-center font-semibold text-indigo-700 dark:text-indigo-300">
                                Visualizar a (s) mensagem (nes) de {{ $user->name }}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 size-5 fill-indigo-500 dark:fill-indigo-200">
                                    <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </p>
                    </div>

                    <div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="size-6 stroke-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            <h2 class="ms-3 text-xl font-semibold text-gray-900 dark:text-white">
                                Número de denúncias contra
                            </h2>
                        </div>
                
                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-xl leading-relaxed">
                            02
                        </p>
                        <p class="mt-4 text-sm">
                            <a href="https://laracasts.com" class="inline-flex items-center font-semibold text-indigo-700 dark:text-indigo-300">
                                Ver denúncia com {{ $user->name }}
                
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 size-5 fill-indigo-500 dark:fill-indigo-200">
                                    <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </p>
                    </div>
                
                    <div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="size-6 stroke-gray-400">
                                <path stroke-linecap="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            <h2 class="ms-3 text-xl font-semibold text-gray-900 dark:text-white">
                                <a href="https://laracasts.com">Data de adesão</a>
                            </h2>
                        </div>
                
                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            {{ date(' H / m / Y', strtotime($user->created_at)) }}
                        </p>                        
                    </div>
                
                    <div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="size-6 stroke-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                            <h2 class="ms-3 text-xl font-semibold text-gray-900 dark:text-white">
                                <a href="https://tailwindcss.com/">Número de conteúdos</a>
                            </h2>
                        </div>
                
                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-xl leading-relaxed">
                            01
                        </p>                        
                    </div>              
                    
                </div>
                
            </div>
        </div>
    </div> --}}
</x-app-layout>
