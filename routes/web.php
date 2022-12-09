
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FullCalendarController;

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AssistidoController;
use GuzzleHttp\Middleware;

Route::get('/calendario', [FullCalendarController::class, 'index'])->name('calendario.get')->middleware('auth');

Route::post('/calendario/action', [FullCalendarController::class, 'action']);

//Route::get('/dashboard', [EventController::class, 'schedule'])->middleware('auth');

Route::get('/', [AssistidoController::class, 'index']);
/*Rotas Agenda*/

Route::get('/mediacao/criar_agenda', [AgendaController::class, 'create'])->name('mediacao.create')->middleware('auth');
Route::post('/mediacao/criar_agenda/novo', [AgendaController::class, 'store'])->name('agenda.store')->middleware('auth');
Route::get('/mediacao/agendamentos', [AgendaController::class, 'show'])->name('mediacao.agendamentos')->middleware('auth');

/*Rotas Assistido*/

Route::get('/cadastroassistido/{id}', [AssistidoController::class, 'create'])->name('assistido.create')->middleware('auth');
Route::post('/cadastroassistido/{id}/novo', [AssistidoController::class, 'store'])->name('assistido.store')->middleware('auth');
Route::get('/cadastroassistido/{id}/edit', [AssistidoController::class, 'edit'])->name('assistido.edit')->middleware('auth');
Route::post('/cadastroassistido/{id}/update', [AssistidoController::class, 'update'])->name('assistido.update')->middleware('auth');

