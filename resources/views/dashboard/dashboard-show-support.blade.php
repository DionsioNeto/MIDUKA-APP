<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mensagem de supporte') }}: ({{ $item->count() }})
        </h2>
    </x-slot>

    

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    
            <!-- Cabeçalho -->
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Visualizar Mensagem</h1>
                <a href="/dashboard-support"
                   class="inline-flex items-center text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Voltar
                </a>
            </div>
    
            <!-- Card da Mensagem -->
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 shadow-sm space-y-6">
    
                <!-- Remetente -->
                <a href="/usuario/{{ $item->user->id }}">
                    <div class="flex items-center gap-4">
                        <img src="{{ $item->user->profile_photo_url }}" alt="Foto de perfil"
                             class="w-12 h-12 rounded-full object-cover border border-gray-300 dark:border-gray-600">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $item->user->name }}</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Enviado em {{ $item->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </a>
    
                <!-- Dados do Contato -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Email</p>
                        <p class="text-base text-gray-900 dark:text-white"> {{ $item->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Telefone</p>
                        <p class="text-base text-gray-900 dark:text-white"> {{ $item->phoneNumber }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Problema</p>
                        <p class="text-base text-gray-900 dark:text-white">{{ $item->typeProblem }}</p>
                    </div>
                </div>
    
                <!-- Mensagem -->
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Mensagem</p>
                    <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 text-sm text-gray-800 dark:text-gray-200 leading-relaxed">
                        {{ $item->description }} 
                    </div>
                </div>
    
                <!-- Ações -->
                <div class="flex justify-end">
                    <form method="POST" action="/dashboard-mgs/destroy/{{ $item->id }}" onsubmit="return confirm('Tem certeza que deseja excluir?');">
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
    
    


</x-app-layout>
