<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Conteúdo') }}: ({{ $item->count() }})
        </h2>
    </x-slot>
   
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Cabeçalho -->
                <div class="flex items-center justify-between mb-8">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Visualizar conteúdo</h1>
                    <a href="/dashboard-conteudos"
                       class="inline-flex items-center text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                        Voltar
                    </a>
                </div>
                <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 shadow-xl rounded-2xl overflow-hidden relative group">
                    <!-- Header: Perfil e Data -->
                    <div class="flex items-center gap-4 px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                        <img src="{{ $item->user->profile_photo_url }}" alt="Foto de perfil"
                            class="w-14 h-14 rounded-full border border-gray-300 dark:border-gray-600 object-cover">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                                {{ $item->user->name }}
                            </h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Postado em {{ $item->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                    </div>
                    <!-- Capa do Conteúdo -->
                    <div class="relative w-full h-64 bg-gray-100 dark:bg-gray-800 overflow-hidden">
                        <img src="{{ url("storage/uploads/{$item->capa}") }}" alt="Capa"
                            class="w-full h-full object-contain">
                    </div>
                    <!-- Detalhes -->
                    <div class="px-2 py-2 space-y-4">
                        <!-- Tipo de Conteúdo -->
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Tipo de conteúdo</p>
                            <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 text-sm text-gray-800 dark:text-gray-200 leading-relaxed">
                            {{ $item->type_tag }}
                            </div>
                        </div>
        
                        <!-- Descrição -->
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Descrição</p>
                        <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 text-sm text-gray-800 dark:text-gray-200 leading-relaxed">
                        {{ $item->description }}
                        </div>
                    </div>
                        <!-- Ações -->
                        <div class="flex justify-end gap-1">
                            <a href="/ver/{{ $item->id }}">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-lg transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 w-5 h-5 fill-indigo-500 dark:fill-indigo-200 rotate-180">
                                        <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                                    </svg>
                                    Ver conteúdo
                                </button>
                            </a>
                            <form  action="/dashboard-conteudo/destroy/{{ $item->id }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 rounded-lg transition">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Excluir Mensagem
                                </button>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
