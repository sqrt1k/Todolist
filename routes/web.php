<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class)->only([
        'index', 'store', 'update', 'destroy'
    ]);
    
    Route::get('/', [TaskController::class, 'redirectToTasks']);
});

Auth::routes();