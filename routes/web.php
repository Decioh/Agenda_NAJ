
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AssistidoController;
use App\Http\Controllers\HistoricoController;
use GuzzleHttp\Middleware;

//Route::get('/calendario', [FullCalendarController::class, 'index'])->name('calendario.get')->middleware('auth');

//Route::post('/calendario/action', [FullCalendarController::class, 'action']);

//Route::get('/', [AssistidoController::class, 'index']);

/*Rotas Agenda*/
Route::get('/', [AgendaController::class, 'index'])->name('mediacao.agendamentos')->middleware('auth');
Route::get('/mediacao/criar_agenda', [AgendaController::class, 'create'])->name('mediacao.create')->middleware('auth');
Route::post('/mediacao/criar_agenda/novo', [AgendaController::class, 'store'])->name('agenda.store')->middleware('auth');
Route::delete('/mediacao/agendamentos/{id}/{agenda_id}', [AgendaController::class, 'destroy'])->name('agenda.destroy')->middleware('auth');
Route::get  ('/mediacao/agendamentos/{id}/edit', [AgendaController::class, 'edit'])->name('agenda.edit')->middleware('auth');

/*Rotas para agendar assistido já cadastrado*/
Route::get('/assistido/{id}/agendar/{agenda_id}',[AgendaController::class, 'criar'])->name('assistido.agendar')->middleware('auth');
Route::get('/assistido/{id}/agendar',[AgendaController::class, 'list'])->name('agenda.list')->middleware('auth');
Route::post('/agendar/{agenda_id}/info',[AgendaController::class, 'info'])->name('agenda.info')->middleware('auth');
Route::get('/agendar/{agenda_id}/novaparte',[AgendaController::class, 'novaparte'])->name('agenda.nova_parte')->middleware('auth');
Route::get('/novaparte/{agenda_id}/{id}',[AgendaController::class, 'joinAgenda'])->name('agenda.join')->middleware('auth');
Route::get ('/assistido/{assistido_id}/agenda/{agenda_id}/delete', [AgendaController::class, 'delete'])->name('delete.parte')->middleware('auth');

/*Rotas Assistido*/
Route::get  ('/assistido', [AssistidoController::class, 'list'])->name('assistido.list');
Route::get  ('/assistido/{id}', [AssistidoController::class, 'create'])->name('assistido.create')->middleware('auth');
Route::get ('/assistido/{id}/novo', [AssistidoController::class, 'store'])->name('assistido.store')->middleware('auth');
Route::get  ('/assistido/{id}/edit', [AssistidoController::class, 'edit'])->name('assistido.edit')->middleware('auth');
Route::post ('/assistido/{id}/update', [AssistidoController::class, 'update'])->name('assistido.update')->middleware('auth');
Route::delete('/assistido/{id}', [AssistidoController::class, 'destroy'])->name('assistido.destroy')->middleware('auth');
Route::get  ('/assistido/{id}/info', [AssistidoController::class, 'info'])->name('assistido.info')->middleware('auth');



//rotas para criar assistido antes de agendar;
Route::get ('/novo/assistido', [AssistidoController::class, 'novo'])->name('assistido.novo')->middleware('auth');
Route::post  ('/assistido/criar', [AssistidoController::class, 'criar'])->name('assistido.criar')->middleware('auth');

/*Rotas Historico*/

Route::get('/historico', [HistoricoController::class, 'index'])->name('historico.index')->middleware('auth');
Route::get('/historico/{agenda_id}', [HistoricoController::class, 'create'])->name('historico.create')->middleware('auth');
Route::post('/historico/agenda/{agenda_id}', [HistoricoController::class, 'store'])->name('historico.store')->middleware('auth');
Route::get('/historico/info/{agenda_id}', [HistoricoController::class, 'info'])->name('historico.info')->middleware('auth');
Route::get('/estatisticas', [HistoricoController::class, 'dashboard'])->name('historico.dashboard')->middleware('auth');