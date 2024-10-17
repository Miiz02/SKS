<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MppController;
use App\Http\Controllers\ErrorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard route with middleware for authenticated users
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Management for Students
// Profile Management for Students
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Error Handling
Route::get('/nobruh', [ErrorController::class, 'index'])->name('error.error');

// Logout route
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Warden Role Routes
Route::middleware(['role:warden'])->group(function () {
    Route::get('/warden', [AdminController::class, 'index'])->name('admin.dashboard');
});

// Student Routes
Route::middleware(['role:student'])->group(function () {
    Route::get('/student', [StudentController::class, 'index'])->name('student.dashboard');
    Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
    Route::post('/student', [StudentController::class, 'store'])->name('student.store');
    Route::get('/profile/view', [ProfileController::class, 'show'])->name('student.view');
});

// MPP Role Routes
Route::middleware(['role:mpp'])->group(function () {
    Route::get('/mpp', [MppController::class, 'index'])->name('mpp.dashboard');
    Route::post('/mpp/store', [MppController::class, 'store'])->name('mpp.store');
    Route::post('/mpp/confirm/{id}', [MppController::class, 'confirm'])->name('mpp.confirm');
});

// Registration Routes
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'createStudent']);

// Include additional authentication routes
require __DIR__.'/auth.php';
