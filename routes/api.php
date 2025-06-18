<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', function(){
    return 'TODOLIST API';
});
Route::prefix('todo')->group(function () {
    Route::post('/', [TodoController::class, 'store']);
    Route::get('/export', [TodoController::class, 'export']);
    Route::get('/chart', [TodoController::class, 'chart']);
});