
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FullCalendarController;

use App\Http\Controllers\EventController;

Route::get('/',[EventController::class, 'index']);

Route::get('/novo/create', [EventController::class, 'create']);

Route::get('/novo/agendar', [EventController::class, 'schedule']);

Route::get('/novo/{id}', [EventController::class, 'show']);

Route::post('/novo', [EventController::class, 'store']);

Route::get('/novo/show', [EventController::class, 'agendar']);/*->middleware('auth');*/

Route::get('calendario', [FullCalendarController::class, 'index']);

Route::post('calendario/action', [FullCalendarController::class, 'action']);

?>