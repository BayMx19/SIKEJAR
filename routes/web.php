<?php

use App\Http\Controllers\AnakController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalImunisasiController;
use App\Http\Controllers\StatusImunisasiController;
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
Route::get('/get-imunisasi/{anakId}', [HomeController::class, 'getImunisasi']);
Route::post('/feedback/storedashboard', [FeedbackController::class, 'storeDashboard'])->name('feedback.storedashboard');

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

Route::get('/jadwal-imunisasi', [JadwalImunisasiController::class, 'index'])->name('jadwal-imunisasi');
Route::get('/jadwal-imunisasi/create', [JadwalImunisasiController::class, 'create'])->name('jadwal-imunisasi.create');
Route::post('/jadwal-imunisasi/store', [JadwalImunisasiController::class, 'store'])->name('jadwal-imunisasi.store');
Route::get('/jadwal-imunisasi/{id}/edit', [JadwalImunisasiController::class, 'edit'])->name('jadwal-imunisasi.edit');
Route::put('/jadwal-imunisasi/{id}', [JadwalImunisasiController::class, 'update'])->name('jadwal-imunisasi.update');
Route::delete('/jadwal-imunisasi/{id}', [JadwalImunisasiController::class, 'destroy'])->name('jadwal-imunisasi.destroy');

Route::get('/status-imunisasi', [StatusImunisasiController::class, 'index'])->name('status-imunisasi');
Route::get('/status-imunisasi/{id}/detail', [StatusImunisasiController::class, 'detail'])->name('status-imunisasi.detail');
Route::put('/status-imunisasi/{id}', [StatusImunisasiController::class, 'update'])->name('status-imunisasi.update');
Route::delete('/status-imunisasi/{id}', [StatusImunisasiController::class, 'destroy'])->name('status-imunisasi.destroy');

Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');
Route::get('/feedback/create', [FeedbackController::class, 'create'])->name('feedback.create');
Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('feedback.store');

Route::get('/feedback/{id}/edit', [FeedbackController::class, 'edit'])->name('feedback.edit');
Route::get('/feedback/{id}/detail', [FeedbackController::class, 'detail'])->name('feedback.detail');
Route::put('/feedback/{id}', [FeedbackController::class, 'update'])->name('feedback.update');
Route::delete('/feedback/{id}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');
