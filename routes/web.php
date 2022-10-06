<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FullCalendarController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('calendario', [FullCalendarController::class, 'index']);

Route::post('calendario/action', [FullCalendarController::class, 'action']);

?>
