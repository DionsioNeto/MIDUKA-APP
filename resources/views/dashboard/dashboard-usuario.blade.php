<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users list:') }} ({{ $users->count() }})
        </h2>
    </x-slot>

    @if(session()->has('delete'))
    <div class="w-full p-1 text-center bg-green-500 text-gray-200 font-medium opacity-80">
        {{ session('delete') }}
    </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                
                <!-- Campo de pesquisa -->
                <div class="mb-8">
                    <form method="GET" action="/dashboard-usuario" class="flex items-center max-w-md mx-auto">
                        <div class="relative w-full">
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}" 
                                class="w-full pl-10 pr-4 py-2 text-gray-700 bg-white dark:bg-gray-700 dark:text-gray-200 border border-gray-300 dark:border-gray-600 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                                placeholder="Pesquisar usuário..."
                            >
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <!-- Ícone de lupa -->
                                <svg class="w-5 h-5 text-gray-400 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
    
                        <button 
                            type="submit" 
                            class="ml-3 inline-flex items-center px-4 py-2 bg-indigo-600 dark:bg-indigo-500 hover:bg-indigo-700 dark:hover:bg-indigo-600 text-white text-sm font-medium rounded-full shadow transition"
                        >
                            Buscar
                        </button>
                    </form>
                </div>
                @if ($users->isEmpty())
                <div class="flex flex-col items-center justify-center p-8 text-center text-gray-500 dark:text-gray-400">
                    <!-- Ícone expressivo -->
                    <svg class="w-16 h-16 mb-4 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="4 2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                    </svg>
                    <!-- Mensagem -->
                    <h2 class="text-2xl font-semibold">Nenhum usuário encontrado</h2>
                    <p class="mt-2 text-base text-gray-500 dark:text-gray-400">Tente ajustar a sua pesquisa e tente novamente.</p>
                </div>
                
                @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 p-6 lg:p-8">
                    
                        @foreach ($users as $item)
                        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl shadow hover:shadow-lg transition-all duration-300 ease-in-out p-4">
                            <div class="flex items-center justify-between p-1">
                                <div class="flex items-center">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-14 w-14 rounded-full object-cover" src="{{ $item->profile_photo_url }}" alt="{{ $item->name }}" />
                                        </button>
                                    @endif
                                    <h2 class="ml-3 text-xl font-semibold text-gray-900 dark:text-white">
                                        <a href="/dashboard/usuario/{{ $item->id }}">{{ $item->name }}</a>
                                    </h2>
                                </div>
        
                                <!-- Dropdown -->
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <svg class="w-6 h-6 text-gray-500 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                                            </svg>
                                        </button>
                                    </x-slot>
        
                                    <x-slot name="content">
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Manage Account') }}
                                        </div>

                                        <div class="border-t border-gray-200 dark:border-gray-600"></div>
        
                                        <x-dropdown-link href="/usuario/{{ $item->id }}">
                                            {{ __('Profile') }}
                                        </x-dropdown-link>
                                        

                                        <x-dropdown-link href="/dashboard/usuario/{{ $item->id }}}">
                                            Gerenciar perfil
                                        </x-dropdown-link>
        
                                        <x-dropdown-link href="/dashboard/notify/{{ $item->id }}}">
                                            {{ __('Notify account') }}
                                        </x-dropdown-link>
                                        <form method="POST" action="/dashboard-user/destroy/{{ $item->id }}" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                            class="block w-full px-4 py-2 text-start text-sm leading-5 text-red-600 dark:text-red-600 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out">
                                                Excluir
                                            </button>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
        
                            <div class="px-4 py-2">
                                <div class="inline-flex items-center font-semibold text-indigo-700 dark:text-indigo-300 gap-2 mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-gray-400 dark:stroke-indigo-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75v.75m7.5-.75v.75m-9-2.25h10.5a2.25 2.25 0 012.25 2.25v10.5a2.25 2.25 0 01-2.25 2.25H6.75a2.25 2.25 0 01-2.25-2.25V7.5a2.25 2.25 0 012.25-2.25z" />
                                    </svg>
                                    <span>Desde: {{ date('d/m/Y', strtotime($item->created_at)) }}</span>
                                </div>
                            </div>
        
                            <div class="flex justify-between items-center mt-auto  p-1 border-t border-gray-200 dark:border-gray-700">
                                <a href="/dashboard/usuario/{{ $item->id }}"
                                   class="flex items-center text-sm text-indigo-600 dark:text-indigo-400 hover:underline font-semibold">
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 w-5 h-5 fill-indigo-600 dark:fill-indigo-400 rotate-180">
                                        <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                                    </svg>
                                    Gerenciar este perfil
                                </a>
    
                                <div class="flex justify-end">
                                    <form method="POST" action="/dashboard-user/destroy/{{ $item->id }}" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                        class="text-sm text-red-600 dark:text-red-400 hover:underline flex items-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                   
    
                </div>
    
                <!-- Paginação -->
                <div class="p-6">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
