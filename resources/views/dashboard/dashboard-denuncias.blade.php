<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Denúncias') }} ({{  $denuncias->count() }})
        </h2>
    </x-slot>
    @if(session()->has('delete'))
    <div class="w-full p-1 text-center bg-green-500 text-gray-200 font-medium opacity-80">
        {{ session('delete') }}
    </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
            <div class="mb-8">
                <form method="GET" action="/dashboard-denuncias" class="flex items-center max-w-md mx-auto">
                    <div class="relative w-full">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            class="w-full pl-10 pr-4 py-2 text-gray-700 bg-white dark:bg-gray-700 dark:text-gray-200 border border-gray-300 dark:border-gray-600 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                            placeholder="Buscar por denúncias..."
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
            @if ($denuncias->isEmpty())
            <div class="flex flex-col items-center justify-center p-8 text-center text-gray-500 dark:text-gray-400">
                <!-- Ícone expressivo -->
                <svg class="w-16 h-16 mb-4 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="4 2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
                <!-- Mensagem -->
                <h2 class="text-2xl font-semibold">Nenhuma denúncia encontrado</h2>
                <p class="mt-2 text-base text-gray-500 dark:text-gray-400">Tente mais tarde.</p>
            </div>
            
            @else
    
            <!-- Lista de mensagens -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($denuncias as $item)
                    <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
    
                        <!-- Cabeçalho com remetente -->
                        <div class="flex items-center gap-4 mb-4">
                            <img src="{{ $item->user->profile_photo_url }}" alt="Foto de perfil"
                                 class="w-10 h-10 rounded-full object-cover border border-gray-300 dark:border-gray-600">
    
                            <div class="flex flex-col">
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $item->user->name }}</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}
                                </span>
                            </div>
                        </div>
    
                        <!-- Conteúdo da mensagem -->
                        <div class="mb-4">
                            <h1 class="text-sm text-gray-700 dark:text-gray-300">
                                Denúncias vindas de um {{ $item->profile_or_content }}
                            </h1>
                            <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2 list-none p-0 m-0">
                                @foreach ($item->denuncia as $it)
                                    <li class="text-sm text-indigo-600 dark:text-indigo-400 font-semibold">{{ $it }}</li>
                                @endforeach
                            </ul>
                        </div>
    
                        <!-- Ações -->
                        <div class="flex justify-between items-center mt-auto pt-3 border-t border-gray-200 dark:border-gray-700">

                            <div class="flex items-center gap-4">
                                @if(!$item->conteudo_id == null)
                                    <a href="/ver/{{ $item->conteudo->id }}"
                                       class="flex items-center text-sm text-indigo-600 dark:text-indigo-400 hover:underline font-semibold">
                                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Visualizar
                                    </a>
                                @elseif(!$item->denunciado_id == null)
                                    <a href="/usuario/{{ $item->id }}"
                                       class="flex items-center text-sm text-indigo-600 dark:text-indigo-400 hover:underline font-semibold">
                                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Visualizar
                                    </a>
                                @endif

                                @if(!$item->conteudo_id == null)
                                <!-- Botão GERENCIAR -->
                                <a href="/dashboard-show-conteudo/{{ $item->conteudo->id }}"
                                   class="flex items-center text-sm text-yellow-600 dark:text-yellow-400 hover:underline font-semibold">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Gerenciar
                                </a>
                                @elseif(!$item->denunciado_id == null)
                                <!-- Novo botão GERENCIAR -->
                                <a href="/dashboard-manage-support/{{ $item->id }}"
                                   class="flex items-center text-sm text-yellow-600 dark:text-yellow-400 hover:underline font-semibold">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Gerenciar
                                </a>
                                @endif

                            </div>

                            <div class="flex justify-end">
                                <form method="POST" action="/dashboard-denuncias/destroy/{{ $item->id }}" onsubmit="return confirm('Tem certeza que deseja excluir esse registo de denúncia?');">
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
            </div>
            @endif
            <!-- Paginação -->
            <div class="mt-8">
                {{ $denuncias->links() }}
            </div>
        </div>
    </div>
</x-app-layout>