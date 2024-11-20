<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/* Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard');
});
 */

 Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('loginn');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [LoginController::class, 'showForm'])->name('register');
Route::post('/register', [LoginController::class, 'register']);  // Ruta para procesar el formulario
