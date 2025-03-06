<?php

use App\Http\Controllers\AnakController;
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


Route::get('/master-anak', [AnakController::class, 'index'])->name('master-anak');
Route::get('/master-anak/create', [AnakController::class, 'create'])->name('master-anak.create');
Route::post('/master-anak/store', [AnakController::class, 'store'])->name('master-anak.store');
Route::get('/master-anak/{id}/edit', [AnakController::class, 'edit'])->name('master-anak.edit');
Route::put('/master-anak/{id}', [AnakController::class, 'update'])->name('master-anak.update');
Route::delete('/master-anak/{id}', [AnakController::class, 'destroy'])->name('master-anak.destroy');