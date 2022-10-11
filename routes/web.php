
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FullCalendarController;

use App\Http\Controllers\EventController;

Route::get('/',[EventController::class, 'index']);

Route::get('/novo/create', [EventController::class,'create']);

Route::post('/novo', [EventController::class,'store']);

Route::post('/novo', [EventController::class,'calcular']);

Route::get('calendario', [FullCalendarController::class, 'index']);

Route::post('calendario/action', [FullCalendarController::class, 'action']);

?>