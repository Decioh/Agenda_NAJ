
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FullCalendarController;

use App\Http\Controllers\EventController;
use App\Models\Event;
use GuzzleHttp\Middleware;

Route::get('/',[EventController::class, 'index']);

Route::get('/novo/create', [EventController::class, 'create'])->middleware('auth');

Route::get('/novo/agendar', [EventController::class, 'schedule'])->middleware('auth');

Route::get('/novo/{id}', [EventController::class, 'show'])->middleware('auth');

Route::put('/novo/update/{id}', [EventController::class, 'update'])->middleware('auth');

Route::post('/novo', [EventController::class, 'store'])->middleware('auth');

Route::get('/novo/show', [EventController::class, 'agendar'])->middleware('auth');

Route::get('/calendario', [FullCalendarController::class, 'index'])->middleware('auth');

Route::post('/calendario/action', [FullCalendarController::class, 'action']);

Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');

//Route::delete('/novo/{id}', [EventController::class, 'destroy']);

//Rotas organizadas

Route::get('/mediacao/criar_agenda', [EventController::class, 'create' ])->middleware('auth');

Route::get('/mediacao/agendamentos', [EventController::class, 'schedule'])->middleware('auth');

Route::get('/cadastroassistido/{id}', [EventController::class, 'show'])->middleware('auth');

Route::put('/mediacao/cadastroassistido/{id}', [EventController::class, 'update'])->middleware('auth');

Route::post('/mediacao/criar_agenda/novo', [EventController::class, 'store'])->middleware('auth');




