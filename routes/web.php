<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoController::class,'index'])->name('home');
Route::get('/all-todo', [TodoController::class,'allTodoIndex']);
Route::get('/add-todo', [TodoController::class,'addToDoIndex']);
Route::post('/add-todo', [TodoController::class,'addToDo']);
Route::get('/edit-todo/{id}', [TodoController::class,'editToDoIndex']);
Route::post('/edit-todo/{id}', [TodoController::class,'editToDo']);
Route::get('/view-todo', [TodoController::class,'viewToDo'])->name('view-todo');
Route::get('/view-todo/{id}', [TodoController::class,'viewToDoIndex']);

Route::post('/delete-todo/{id}', [TodoController::class,'deleteToDo']);
