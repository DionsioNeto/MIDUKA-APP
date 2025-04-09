<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Conteúdos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg">
                <div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-8 p-6 lg:p-8">

                    @foreach ($itens as $item)
                    <div class="border border-gray-200 dark:border-gray-600 p-2 rounded">
                        <div class="flex items-center">
                            <x-dropdown align="left" width="48">
                                <x-slot name="trigger">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="size-8 rounded-full object-cover" src="{{ $item->user->profile_photo_url }}" alt="{{ $item->name }}" />
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
                            <h2 class="ms-3 text-xl font-semibold text-gray-900 dark:text-white">
                                <a href="/dashboard/usuario/{{ $item->id }}">{{ $item->user->name }}</a>
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-8">
                            <div class="inline-flex items-center font-semibold text-indigo-700 dark:text-indigo-300 gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="size-6 stroke-gray-400">
                                    <path stroke-linecap="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                                Postado em: {{ date('d/m/Y', strtotime($item->created_at)) }}
                            </div>
                        </div>
                        
                        <div class="overflow-hidden h-33">
                            <img src="{{ url("storage/uploads/{$item->capa}") }}" alt="Capa do conteúdo" class="w-100">
                        </div>

                        <p class="mt-4 text-sm">
                            <a href="/dashboard/usuario/{{ $item->id }}" class="inline-flex items-center font-semibold text-indigo-700 dark:text-indigo-300">
                                Gerenciar Conteudo
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 size-5 fill-indigo-500 dark:fill-indigo-200">
                                    <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </p>
                    </div>
                    @endforeach

                </div>

               <div class="p-6">
                {{ $itens->links() }}
               </div>
            </div>
        </div>
    </div>
</x-app-layout>
