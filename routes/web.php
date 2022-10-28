
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FullCalendarController;

use App\Http\Controllers\EventController;

Route::get('/',[EventController::class, 'index']);

Route::get('/novo/create', [EventController::class, 'create'])->middleware('auth');

Route::get('/novo/agendar', [EventController::class, 'schedule'])->middleware('auth');

Route::get('/novo/{id}', [EventController::class, 'show'])->middleware('auth');

Route::post('/novo', [EventController::class, 'store'])->middleware('auth');

Route::get('/novo/show', [EventController::class, 'agendar'])->middleware('auth');

Route::get('calendario', [FullCalendarController::class, 'index']);

Route::post('calendario/action', [FullCalendarController::class, 'action']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
