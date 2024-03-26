<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendTaskController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontendTaskController::class, 'index'])->name('tasks.index');
Route::post('/tasks', [FrontendTaskController::class, 'store'])->name('tasks.store');

Route::get('/tasks/create', [FrontendTaskController::class, 'create'])->name('tasks.create');
Route::get('/tasks/{task}/edit', [FrontendTaskController::class, 'edit'])->name('tasks.edit');

