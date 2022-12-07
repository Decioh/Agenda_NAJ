
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FullCalendarController;

use App\Http\Controllers\EventController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AssistidoController;
use App\Models\Event;
use GuzzleHttp\Middleware;

Route::get('/calendario', [FullCalendarController::class, 'index'])->name('calendario.get')->middleware('auth');

Route::post('/calendario/action', [FullCalendarController::class, 'action']);

//Route::get('/dashboard', [EventController::class, 'schedule'])->middleware('auth');
/*Rotas Agenda*/

Route::post('/mediacao/criar_agenda/novo', [AgendaController::class, 'store'])->name('agenda.store')->middleware('auth');
Route::get('/mediacao/agendamentos', [AgendaController::class, 'show'])->name('mediacao.agendamentos')->middleware('auth');

Route::get('/',[AgendaController::class, 'index']);

/*Rotas Assistido*/

Route::get('/cadastroassistido/{id}', [AssistidoController::class, 'create'])->name('assistido.create')->middleware('auth');
Route::post('/cadastroassistido/{id}/novo', [AssistidoController::class, 'store'])->name('assistido.store')->middleware('auth');

