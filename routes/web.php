<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MoodController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $moods = \App\Models\Mood::where('user_id', auth()->id())
            ->latest('date')
            ->get();
        return view('dashboard', compact('moods'));
    })->name('dashboard');

    Route::post('/moods', [MoodController::class, 'store'])->name('moods.store');
    Route::put('/moods/{mood}', [MoodController::class, 'update'])->name('moods.update');
    Route::delete('/moods/{mood}', [MoodController::class, 'destroy'])->name('moods.destroy');
});

