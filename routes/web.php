<?php

use Illuminate\Support\Facades\Route;

use App\Models\todolist;
use Illuminate\Http\Request;
use App\Http\Controllers\TaskController;

Route::middleware(['auth'])->group(function(){
    Route::resource('tasks', TaskController::class)->only([
        'index', 'store', 'update', 'destroy'
    ]);
    Route::redirect('/', '/tasks');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
