
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FullCalendarController;

use App\Http\Controllers\EventController;
use App\Http\Controllers\AgendaController;
use App\Models\Event;
use GuzzleHttp\Middleware;

Route::get('/',[EventController::class, 'index']);

Route::get('/mediacao/criar_agenda', [EventController::class, 'create' ])->middleware('auth');

Route::get('/mediacao/agendamentos', [EventController::class, 'schedule'])->name('mediacao.agendamentos')->middleware('auth');

Route::put('/cadastroassistido/{id}/novo', [EventController::class, 'update'])->name('form.put')->middleware('auth');

Route::get('/cadastroassistido/{id}', [EventController::class, 'listar'])->name('assistido.get')->middleware('auth');

/*Route::post('/mediacao/criar_agenda/novo', [EventController::class, 'store'])->middleware('auth')->name('agenda.create');->Movido para novo model*/

Route::get('/calendario', [FullCalendarController::class, 'index'])->name('calendario.get')->middleware('auth');

Route::post('/calendario/action', [FullCalendarController::class, 'action']);

Route::get('/dashboard', [EventController::class, 'schedule'])->middleware('auth');

/*Rotas Agenda*/

Route::post('/mediacao/criar_agenda/novo', [AgendaController::class, 'store'])->name('agenda.store')->middleware('auth');
Route::get('/mediacao/agendamentos', [AgendaController::class, 'show'])->name('mediacao.agendamentos')->middleware('auth');
Route::get('/',[AgendaController::class, 'index']);

/*Rotas Assistido*/

Route::get('/cadastroassistido/{id}', [AssistidoController::class, 'create'])->name('assistido.create')->middleware('auth');
Route::put('/cadastroassistido/{id}/novo', [AssistidoController::class, 'store'])->name('assistido.store')->middleware('auth');

