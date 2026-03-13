<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Admin\AdminTicketController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| Публічні маршрути
|--------------------------------------------------------------------------
*/
Route::get('/', [TicketController::class, 'Welcome'])->name('home');
Route::get('/widget', [TicketController::class, 'showWidget'])->name('tickets.showWidget');
Route::post('/api/tickets', [TicketController::class, 'store'])->name('tickets.store');

/*
|--------------------------------------------------------------------------
| Авторизація 
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

/*
|--------------------------------------------------------------------------
| Адмін-панель 
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminTicketController::class, 'index'])->name('dashboard');
    Route::get('/tickets/statistics', [AdminTicketController::class, 'statistics'])->name('tickets.statistics');
    Route::patch('/tickets/{ticket}/status', [AdminTicketController::class, 'updateStatus'])->name('tickets.updateStatus');
    Route::get('/tickets/media/{media}/download', [AdminTicketController::class, 'downloadMedia'])->name('tickets.download');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});