<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MppController;
use App\Http\Controllers\ErrorController;
use Illuminate\Support\Facades\Route;
use app\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/nobruh', [ErrorController::class, 'index'])->name('error.error');
// routes/web.php
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


require __DIR__.'/auth.php';


// Only allow 'warden' role
Route::middleware(['role:warden'])->group(function () {
    Route::get('/warden', [AdminController::class, 'index'])->name('admin.dashboard');
});
Route::middleware(['role:student'])->group(function () {
    Route::get('/student', [StudentController::class, 'index'])->name('student.dashboard');
});



// Allow both 'warden' and 'teacher' roles
Route::middleware(['role:mpp'])->group(function () {
    Route::get('/mpp', [MppController::class, 'index'])->name('mpp.dashboard');
});
