
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

Route::post('/novo', [EventController::class, 'store'])->middleware('auth');

Route::get('/novo/show', [EventController::class, 'agendar'])->middleware('auth');

Route::get('/calendario', [FullCalendarController::class, 'index'])->middleware('auth');

Route::post('/calendario/action', [FullCalendarController::class, 'action']);

Route::get('/novo/{id}',[EventController::class, 'destroy'])->middleware('auth');

Route::get('/novo/edit/{id}',[EventController::class, 'edit'])->middleware('auth');

//Route::delete('/novo/{id}', [EventController::class, 'destroy']);

Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');


