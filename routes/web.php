<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\TenderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebNotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

// Auth::routes();

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('/tenagaAhli', PesertaController::class);
    Route::get('/tenagaAhliz/{id}', [PesertaController::class, 'destroy'])->name('tenagaAhli.del');

    Route::resource('/tender', TenderController::class);
    Route::get('/tender/destroy/{id}', [TenderController::class, 'destroy'])->name('tender.destroy');
    Route::get('/tender/{id}/tenagaAhli', [TenderController::class, 'pesertaIndex'])->name('tender.peserta');
    Route::get('/tender/{id}/show/tenagaAhli', [TenderController::class, 'pesertaShow'])->name('tender.tenagaAhli.show');
    Route::post('/tender/{id}/comment/tenagaAhli', [TenderController::class, 'storeComment'])->name('tender.tenagaAhli.comment');
    Route::get('/tenagaAhlis/showAll', [TenderController::class, 'showPeserta'])->name('tender.showAll');

    Route::get('/tenagaAhli/{id}/choose/tender/{id_tender}', [TenderController::class, 'choosePeserta'])->name('tender.tenagaAhli.choose');
    Route::get('/tenagaAhli/{id}/unchoose/tender/{id_tender}', [TenderController::class, 'unChoosePeserta'])->name('tender.tenagaAhli.unchoose');
    Route::get('/tenagaAhli/{id}/notif/clear', [PesertaController::class, 'changetStatusNotifi'])->name('tenagaAhli.change.status');
    Route::get('/tenagaAhli/{id}/file/delete', [PesertaController::class, 'deleteFile'])->name('tenagaAhli.file.delete');

    Route::get('/push-notificaiton', [WebNotificationController::class, 'index'])->name('push-notificaiton');
    Route::post('/store-token', [WebNotificationController::class, 'storeToken'])->name('store.token');

    Route::resource('user', UserController::class);
    Route::get('/userz/{id}', [UserController::class, 'destroy'])->name('user.del');

    Route::get('/export/peserta/{id}/tender', [PesertaController::class, 'exportPeserta']);
});
