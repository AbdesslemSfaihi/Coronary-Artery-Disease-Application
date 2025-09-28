<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PredictionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SeverityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;

// Homepage
Route::get('/', function () {
    return view('welcome');
});

// Breeze default dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dash', [DashboardController::class, 'index'])->name('dash');
    Route::get('/patients', [DashboardController::class, 'patients'])->name('patients');

    // ✅ Correct placement so routes are named admin.users.*
    Route::resource('users', UserController::class);
});


// Breeze's profile management routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/predict/form/{step?}', [PredictionController::class, 'showForm'])->name('predict.form');
    Route::post('/predict/extract-image', [PredictionController::class, 'extractFromImage'])->name('predict.extract.image');
    Route::post('/predict/form/{step}', [PredictionController::class, 'submitForm'])->name('predict.submit');
    Route::get('/predict/result', [PredictionController::class, 'showResult'])->name('predict.result');


    // Severity prediction
    Route::post('/coro/severity', [SeverityController::class, 'predictSeverity'])->name('coro.severity');
});


// Auth routes (login, register, etc.)
require __DIR__ . '/auth.php';
