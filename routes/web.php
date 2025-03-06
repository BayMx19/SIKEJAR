<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/master-users', [UsersController::class, 'index'])->name('master-users');
Route::get('/master-users/create', [UsersController::class, 'create'])->name('master-users.create');
Route::post('/master-users/store', [UsersController::class, 'store'])->name('master-users.store');
Route::get('/master-users/{id}/edit', [UsersController::class, 'edit'])->name('master-users.edit');
Route::put('/master-users/{id}', [UsersController::class, 'update'])->name('master-users.update');
Route::delete('/master-users/{id}', [UsersController::class, 'destroy'])->name('master-users.destroy');
