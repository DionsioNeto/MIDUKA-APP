<?php
use App\Http\Controllers\indexController;
use App\Http\Controllers\dashboardController;
use App\Http\Middleware\adminAcess;
use Illuminate\Support\Facades\Route;
use App\Livewire\{
    Usuario,
    Ver,
    KeyBoard,
};

// Rota principal da aplicação (index).
Route::get('/', [indexController:: class, 'index']);
// Rota para ver um conteúdo
Route::get('/ver{id}',  [Ver::class, 'render']);
//Rota que nos leva a view de perfis de outros usuários...

Route::get('/usuario{id}',[Usuario::class, 'render']);

Route::get('/Pesquisar', function(){
    return view('project.search');
});

//Rota que nos leva a view do video.blade.php
Route::get('/videos', function(){
    return view('project.videos');
});
//Rota que nos leva a view de imagens.blade.php
Route::get('/imagens', function(){
    return view('project.imagens');
});
//Rota que nos leva a view de Livros & PDFs
Route::get('/livros-pdfs', function(){
    return view('project.livros');
});
//Rota que nos leva a view de audios
Route::get('/audios', function(){
    return view('project.audios');
});

Route::get('/test', function(){
    return view('project.test');
});

//Rotute group, Rotas que requerem autenticação especial do administrador!

Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard-usuario', [dashboardController::class, 'usuarios'])->name('dashboard-usuario');;
    Route::get('/dashboard-support', [dashboardController::class, 'support'])->name('dashboard-support');
    Route::get('/dashboard-denuncias', [dashboardController::class, 'denucias'])->name('dashboard-denuncias');
    Route::get('/dashboard-conteudos', [dashboardController::class, 'conteudos'])->name('dashboard-conteudos');

    Route::get('/tt', function(){
        // return view('project.test');
    });

});

//Rotute group, Rotas que requerem autenticação! (->middleware('auth');)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    ])->group(function () {

         Route::post('/store', [indexController::class, 'store']);

        //Rota que nos leva a view de Support
        Route::get('/support', function(){
            return view('project.suport_contact');
        });

        Route::get('/criar', [indexController:: class, 'criar']);

        Route::get('/guardados', function(){
            return view('project.guardados');
        });

        //Rota que nos mostra as notificações.
        Route::get('/notificacao', function(){
            return view('project.notificacao');
        });

        //Rota que nos leva a view de definições
        Route::get('/definicoes', function(){
            return view('project.definicoes');
        });
        //Rota que nos leva ao perfil de usuário logado.
        Route::get('/perfil', function(){
            return view('project.perfil');
        });

});
