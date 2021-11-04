<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/tasks/{task}/complete', [TaskController::class,'toggleComplete'])->middleware(['auth'])->name('tasks.toggleComplete');
Route::resource('tasks', TaskController::class)->middleware(['auth'])->name('index','tasks');


require __DIR__.'/auth.php';
