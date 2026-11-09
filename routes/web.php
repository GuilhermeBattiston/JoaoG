<?php

use App\Http\Controllers\HelpdeskController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProjetoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('/helpdesk', [HelpdeskController::class, 'index'])->name('helpdesk');
Route::post('/helpdesk', [HelpdeskController::class, 'salvar'])->name('helpdesk.salvar');

foreach (['idade', 'notas', 'login-basico', 'jogos', 'poo2'] as $projeto) {
    Route::match(['get', 'post'], '/projetos/'.$projeto, [ProjetoController::class, 'exibir'])
        ->defaults('projeto', $projeto)->name($projeto);
    Route::redirect('/resources/views/projetos/'.$projeto.'.php', '/projetos/'.$projeto);
}
Route::redirect('/resources/views/projetos/helpdesk.php', '/helpdesk');
