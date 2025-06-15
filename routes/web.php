<?php

use Illuminate\Support\Facades\Route;

use App\Models\todolist;
use Illuminate\Http\Request;
use App\Http\Controllers\TaskController;

Route::resource('tasks', TaskController::class)->only([
    'index', 'store', 'update', 'destroy'
]);
Route::redirect('/', '/tasks');