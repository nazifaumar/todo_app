<?php

use App\Http\Controllers\TodoController;
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

Route::middleware('isGuest')->group(function(){
Route::get('/', [TodoController::class, 'index'])->name('login');
Route::get('/register', [TodoController::class, 'register']);
Route::POST('/register/input', [TodoController::class, 'registerAccount'])->name
('register-input');
Route::post('/login/auth', [TodoController::class, 'auth'])->name('login.auth');
});

Route::middleware('isLogin')->group(function(){
    Route::get('/todo', [TodoController::class, 'todo'])->name('todo');
    Route::get('/home', [TodoController::class, 'home']);
    Route::get('/create', [TodoController::class, 'create']);
    Route::post('/store', [TodoController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [TodoController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [TodoController::class, 'update'])->name('update');
    /*Route::get('/delete/{id}', [TodoController::class, 'destroy'])->name('delete');*/
    Route::delete('/delete/{id}', [TodoController::class, 'destroy'])->name('delete');
    Route::patch('/completed/{id}', [TodoController::class, 'updateCompleted'])->name('update-completed');

});

Route::get('/logout', [TodoController::class, 'logout']);


