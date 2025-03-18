<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('dashboard',[ChatController::class, 'index'])->name('dashboard');
    Route::post('chat/send',[ChatController::class, 'store'])->name('chat.store');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
