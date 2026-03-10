<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

Route::post('/api/tickets', [TicketController::class, 'store'])->name('tickets.store');
Route::get('/', [TicketController::class, 'Welcome'])->name('home');
Route::get('/widget', [TicketController::class, 'showWidget'])->name('tickets.showWidget');