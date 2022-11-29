
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FullCalendarController;

use App\Http\Controllers\EventController;
use App\Models\Event;
use GuzzleHttp\Middleware;

Route::get('/',[EventController::class, 'index']);
/*
Route::get('/novo/create', [EventController::class, 'create'])->middleware('auth');

//Route::get('/novo/agendar', [EventController::class, 'schedule'])->middleware('auth');

Route::get('/novo/{id}', [EventController::class, 'listar'])->middleware('auth');

Route::put('/novo/update/{id}', [EventController::class, 'update'])->middleware('auth');

Route::post('/novo', [EventController::class, 'store'])->middleware('auth');

Route::get('/novo/show', [EventController::class, 'agendar'])->middleware('auth');*/

//Rotas organizadas

Route::get('/mediacao/criar_agenda', [EventController::class, 'create' ])->middleware('auth');

Route::get('/mediacao/agendamentos', [EventController::class, 'schedule'])->middleware('auth');

Route::put('/cadastroassistido/{id}/novo', [EventController::class, 'update'])->middleware('auth')->name('form.put');

Route::get('/cadastroassistido/{id}', [EventController::class, 'listar'])->name('assistido.get')->middleware('auth');

Route::post('/mediacao/criar_agenda/novo', [EventController::class, 'store'])->middleware('auth')->name('agenda.create');

Route::get('/calendario', [FullCalendarController::class, 'index'])->middleware('auth');

Route::post('/calendario/action', [FullCalendarController::class, 'action']);

Route::get('/dashboard', [EventController::class, 'schedule'])->middleware('auth');




