<?php

use App\Helpers\FirebaseHelper;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalImunisasiController;
use App\Http\Controllers\StatusImunisasiController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\UsersModel;
use Illuminate\Support\Facades\Log;

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

Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'index')->name('home');
    Route::get('/get-imunisasi/{anakId}', 'getImunisasi');
    Route::get('/grafik-bb-tb', 'grafikBBTB')->name('grafik.bb.tb');
    Route::get('/master-anak/{id}/detail', 'detail')->name('master-anak.detail');
});

Route::controller(UsersController::class)->group(function () {
    Route::get('/master-users', 'index')->name('master-users');
    Route::get('/master-users/create', 'create')->name('master-users.create');
    Route::post('/master-users/store', 'store')->name('master-users.store');
    Route::get('/master-users/{id}/edit', 'edit')->name('master-users.edit');
    Route::get('/master-users/{id}/detail', 'detail')->name('master-users.detail');
    Route::put('/master-users/{id}', 'update')->name('master-users.update');
    Route::delete('/master-users/{id}', 'destroy')->name('master-users.destroy');
});

Route::controller(DokterController::class)->group(function () {
    Route::get('/master-dokter', 'index')->name('master-dokter');
    Route::get('/master-dokter/create', 'create')->name('master-dokter.create');
    Route::post('/master-dokter/store', 'store')->name('master-dokter.store');
    Route::get('/master-dokter/{id}/edit', 'edit')->name('master-dokter.edit');
    Route::get('/master-dokter/{id}/detail', 'detail')->name('master-dokter.detail');
    Route::put('/master-dokter/{id}', 'update')->name('master-dokter.update');
    Route::delete('/master-dokter/{id}', 'destroy')->name('master-dokter.destroy');
});


Route::controller(AnakController::class)->group(function () {
    Route::get('/master-anak', 'index')->name('master-anak');
    Route::get('/master-anak/create', 'create')->name('master-anak.create');
    Route::post('/master-anak/store', 'store')->name('master-anak.store');
    Route::get('/master-anak/{id}/edit', 'edit')->name('master-anak.edit');
    Route::get('/master-anak/{id}/detail', 'detail')->name('master-anak.detail');
    Route::put('/master-anak/{id}', 'update')->name('master-anak.update');
    Route::delete('/master-anak/{id}', 'destroy')->name('master-anak.destroy');
});

Route::controller(JadwalImunisasiController::class)->group(function () {
    Route::get('/jadwal-imunisasi', 'index')->name('jadwal-imunisasi');
    Route::get('/jadwal-imunisasi/create', 'create')->name('jadwal-imunisasi.create');
    Route::post('/jadwal-imunisasi/store', 'store')->name('jadwal-imunisasi.store');
    Route::get('/jadwal-imunisasi/{id}/edit', 'edit')->name('jadwal-imunisasi.edit');
    Route::get('/jadwal-imunisasi/{id}/detail', 'detail')->name('jadwal-imunisasi.detail');
    Route::put('/jadwal-imunisasi/{id}', 'update')->name('jadwal-imunisasi.update');
    Route::delete('/jadwal-imunisasi/{id}', 'destroy')->name('jadwal-imunisasi.destroy');
});


Route::controller(StatusImunisasiController::class)->group(function () {
    Route::get('/status-imunisasi', 'index')->name('status-imunisasi');
    Route::get('/status-imunisasi/{id}/detail', 'detail')->name('status-imunisasi.detail');
    Route::put('/status-imunisasi/{id}', 'update')->name('status-imunisasi.update');
    Route::delete('/status-imunisasi/{id}', 'destroy')->name('status-imunisasi.destroy');
});

Route::controller(FeedbackController::class)->group(function () {
    Route::get('/feedback', 'index')->name('feedback');
    Route::get('/feedback/create', 'create')->name('feedback.create');
    Route::post('/feedback/store', 'store')->name('feedback.store');
    Route::post('/feedback/storedashboard', 'storeDashboard')->name('feedback.storedashboard');
    Route::get('/feedback/{id}/edit', 'edit')->name('feedback.edit');
    Route::get('/feedback/{id}/detail', 'detail')->name('feedback.detail');
    Route::put('/feedback/{id}', 'update')->name('feedback.update');
    Route::delete('/feedback/{id}', 'destroy')->name('feedback.destroy');
});

Route::post('/save-token', [UsersController::class, 'saveToken'])->middleware('auth');
