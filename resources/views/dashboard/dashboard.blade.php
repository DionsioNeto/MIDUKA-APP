<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Painel de control') }}
        </h2>
    </x-slot>


    <div class="min-h-screen bg-white dark:bg-gray-800 px-8 flex justify-center items-start">
        <div class="w-full max-w-7xl">
                    
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6  lg:px-8 px-3 py-4">
      
            <!-- Card Usuários -->
            <a href="/dashboard-usuario" class="bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-2xl p-6 flex flex-col gap-4 transition hover:border-indigo-500 dark:hover:border-indigo-400">
              <div class="flex items-center justify-between">
                <div class="text-indigo-600 dark:text-indigo-400">
                    <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A4 4 0 017 15h10a4 4 0 011.879 2.804M16 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <span class="text-sm text-gray-500 dark:text-gray-400">Usuários</span>
              </div>
              <div>
                <p class="text-3xl font-semibold text-gray-800 dark:text-gray-100">{{ $user->count() }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Cadastrados</p>
              </div>
            </a>
      
            <!-- Card Conteúdos -->
            <a href="/dashboard-conteudos" class="bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-2xl p-6 flex flex-col gap-4 transition hover:border-green-500 dark:hover:border-green-400">
              <div class="flex items-center justify-between">
                <div class="text-green-600 dark:text-green-400">
                    <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1M4 12V8a4 4 0 014-4h8a4 4 0 014 4v4" />
                    </svg>
                </div>
                <span class="text-sm text-gray-500 dark:text-gray-400">Conteúdos</span>
              </div>
              <div>
                <p class="text-3xl font-semibold text-gray-800 dark:text-gray-100">{{ $content->count() }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Publicados</p>
              </div>
            </a>
      
            <!-- Card Denúncias -->
            <a href="dashboard-denuncias" class="bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-2xl p-6 flex flex-col gap-4 transition hover:border-red-500 dark:hover:border-red-400">
              <div class="flex items-center justify-between">
                <div class="text-red-600 dark:text-red-400">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-12.728 12.728m0-12.728l12.728 12.728" />
                    </svg>
                </div>
                <span class="text-sm text-gray-500 dark:text-gray-400">Denúncias</span>
              </div>
              <div>
                <p class="text-3xl font-semibold text-gray-800 dark:text-gray-100">{{ $denun->count() }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Registradas</p>
              </div>
            </a>
      
            <!-- Card Suporte -->
            <a href="dashboard-support" class="bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-2xl p-6 flex flex-col gap-4 transition hover:border-yellow-500 dark:hover:border-yellow-400">
              <div class="flex items-center justify-between">
                <div class="text-yellow-600 dark:text-yellow-400">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M21 16v-5a2 2 0 00-2-2h-1l-3-3H9L6 9H5a2 2 0 00-2 2v5a2 2 0 002 2h14a2 2 0 002-2z" />
                    </svg>
                </div>
                <span class="text-sm text-gray-500 dark:text-gray-400">Suporte</span>
              </div>
              <div>
                <p class="text-3xl font-semibold text-gray-800 dark:text-gray-100">32</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Mensagens</p>
              </div>
            </a>
      
          </div>
        </div>
      </div>
</x-app-layout>
