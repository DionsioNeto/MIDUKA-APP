<p align="center"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/laravel/laravel-original-wordmark.svg"  width="100" alt="laravel"/></p>



## About this Laravel project:


- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Para poder rodar esta aplicação web, você vai precisar de ter instalado em sua máquina:
- composer
- PHP
- Qualquer CMD ou linha de comando

## Depois de importar esta a plicação em sua máquina você precisará de seguir os seguintes passos dentro da linha de comando:
  Você precisa abrir o CMD dentro da pasta do arquivo.<br>Se vc não estiver dentro da pasta então você precisará navegar até lá com o comando "cd ./o caminho do arquivo"

- cd nome-do-projeto // Navegue para o diretório do projeto
- composer install // Instalar dependências PHP com o Composer
- cp .env.example .env // Criar o arquivo .env a partir do exemplo
- php artisan key:generate // Gerar a chave da aplicação
# Configure o banco de dados no arquivo .env
- php artisan migrate // Rodar as migrações
- (Não é de todo necessário neste projecto) npm install // Instalar dependências do Node.js (se houver frontend)
- (Não é de todo necessário neste projecto) npm run dev  // Compilar arquivos frontend para desenvolvimento
- php artisan serve // Rodar o servidor de desenvolvimento


