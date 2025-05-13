<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Conteúdos') }}: ({{ $itens->count() }})
        </h2>
    </x-slot>
    @if (session()->has('delete'))
    <div class="w-full p-1 text-center bg-green-500 text-gray-200 font-medium opacity-80">
        {{ session('delete') }}
    </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <!-- Pesquisa (inalterada) -->
            <div>
                <form method="GET" action="/dashboard-conteudos" class="flex items-center max-w-md mx-auto">
                    <div class="relative w-full">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request()->search }}" 
                            class="w-full pl-10 pr-4 py-2 text-gray-700 bg-white dark:bg-gray-700 dark:text-gray-200 border border-gray-300 dark:border-gray-600 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                            placeholder="Pesquisar usuário..."
                        >
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                    <button type="submit"
                            class="ml-3 inline-flex items-center px-4 py-2 bg-indigo-600 dark:bg-indigo-500 hover:bg-indigo-700 dark:hover:bg-indigo-600 text-white text-sm font-medium rounded-full shadow transition">
                        Buscar
                    </button>
                </form>
            </div>
            @if ($itens->isEmpty())
                <div class="flex flex-col items-center justify-center p-12 text-center text-gray-500 dark:text-gray-400">
                    <svg class="w-16 h-16 mb-4 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/>
                    </svg>
                    <h2 class="text-2xl font-semibold">Nenhum conteúdo encontrado</h2>
                    <p class="mt-2 text-base">Tente ajustar sua pesquisa e tentar novamente.</p>
                </div>
            @else
                <!-- Lista de Conteúdos -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($itens as $item)
                        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-sm hover:shadow-md transition">
    
                            <!-- Cabeçalho -->
                            <div class="flex items-center gap-3 p-4">
                                <img class="w-10 h-10 rounded-full object-cover border border-gray-300 dark:border-gray-600"
                                     src="{{ $item->user->profile_photo_url }}" alt="{{ $item->user->name }}">
                                <div class="flex-1">
                                    <h2 class="text-base font-semibold text-gray-900 dark:text-white">
                                        <a href="/dashboard/usuario/{{ $item->user->id }}" class="hover:underline">
                                            {{ $item->user->name }}
                                        </a>
                                    </h2>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        Postado em: {{ date('d/m/Y', strtotime($item->created_at)) }}
                                    </p>
                                </div>
                            </div>
    
                            <!-- Imagem de Capa -->
                            <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 overflow-hidden rounded-b-none rounded-t-2xl">
                                <img src="{{ url("storage/uploads/{$item->capa}") }}" alt="Capa"
                                     class="w-full h-full object-cover">
                            </div>
    
                            <!-- Ações -->
                            <div class="flex justify-between items-center p-4 border-t border-gray-200 dark:border-gray-700">
                                <a href="/dashboard-show-conteudo/{{ $item->id }}"
                                   class="inline-flex items-center text-sm text-indigo-600 dark:text-indigo-400 font-medium hover:underline">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="1.5"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Visualizar
                                </a>
    
                                <form action="/dashboard-conteudo/destroy/{{ $item->id }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center text-sm text-red-600 dark:text-red-400 font-medium hover:underline">
                                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="1.5"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <!-- Paginação -->
            <div class="p-4">
                {{ $itens->appends(['search' => request()->search])->links() }}
            </div>
    
        </div>
    </div>
</x-app-layout>