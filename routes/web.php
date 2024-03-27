<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoController::class,'index'])->name('home');
Route::get('/add-todo', [TodoController::class,'addToDoIndex']);
Route::post('/add-todo', [TodoController::class,'addToDo']);
