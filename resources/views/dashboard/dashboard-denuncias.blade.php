<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Denúncias') }}
        </h2>
    </x-slot>

    
    
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden relative group">
    
                <!-- Botão de Excluir -->
                <div class="absolute top-4 right-4 z-10">
                    <button
                        {{-- wire:click="deletar({{ $conteudo->id }})" --}}
                        class="flex items-center gap-1 px-3 py-1.5 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-800 text-sm font-semibold rounded-lg transition"
                        title="Excluir conteúdo"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Excluir
                    </button>
                </div>
    
                <!-- Header: Perfil e Data -->
                <div class="flex items-center gap-4 px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                    <img src="{{-- $conteudo->user->profile_photo_url --}}" alt="Foto de perfil"
                         class="w-14 h-14 rounded-full border border-gray-300 dark:border-gray-600 object-cover">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                            {{-- $conteudo->user->name --}}
                        </h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Postado em {{-- $conteudo->created_at->format('d/m/Y H:i') --}} 2025
                        </p>
                    </div>
                </div>
    
                <!-- Capa do Conteúdo -->
                <div class="relative w-full h-64 bg-gray-100 dark:bg-gray-700 overflow-hidden">
                    <img src="{{-- url("storage/uploads/{$conteudo->capa}") --}}" alt="Capa"
                         class="w-full h-full object-cover">
                </div>
    
                <!-- Detalhes -->
                <div class="px-6 py-6 space-y-4">
    
                    <!-- Tipo de Conteúdo -->
                    <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-500" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            {{-- @if(...) --}}
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14V10z M4 6h8a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2z"/>
                            {{-- @endif --}}
                        </svg>
                        <span class="capitalize">{{-- $conteudo->tipo --}}</span>
                    </div>
    
                    <!-- Descrição -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">Descrição</h3>
                        <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line">
                            {{-- {{ $conteudo->descricao }} --}}Lorem ipsum dollar
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    


</x-app-layout>
