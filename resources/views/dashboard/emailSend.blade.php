<x-app-layout>
    
    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    
            <!-- Cabeçalho -->
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Gerenciar usuário</h1>
                <a href="/dashboard-usuario"
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
    
                <form action="{{ route('enviar.email') }}" method="POST">
                    @csrf
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" required>
                
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" required>
                
                    <label for="mensagem">Mensagem:</label>
                    <textarea name="mensagem" required></textarea>
                
                    <button type="submit">Enviar</button>
                </form>
    
            </div>
        </div>
    </div>
    
    
</x-app-layout>
