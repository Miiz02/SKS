<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MppController;
use App\Http\Controllers\ErrorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Welcome Page Route
Route::get('/', function () {
    return view('welcome');
});

// Dashboard Route (Only Authenticated and Verified Users)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Error Handling Route
Route::get('/nobruh', [ErrorController::class, 'index'])->name('error.error');

// Logout Route
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Student Routes Group
Route::middleware(['auth', 'role:student'])->prefix('student')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('student.dashboard');
    Route::get('/create', [StudentController::class, 'create'])->name('student.create');
    Route::post('/', [StudentController::class, 'store'])->name('student.store');
    
    // Profile Management for Students
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/view', [ProfileController::class, 'show'])->name('student.profile');
});

// Warden Routes Group
Route::middleware(['auth', 'role:warden'])->prefix('warden')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
});

// MPP Routes Group
Route::middleware(['auth', 'role:mpp'])->prefix('mpp')->group(function () {
    Route::get('/', [MppController::class, 'index'])->name('mpp.dashboard');
    Route::post('/store', [MppController::class, 'store'])->name('mpp.store');
    Route::post('/approve/{id}', [MppController::class, 'confirm'])->name('mpp.confirm');
    Route::get('approve', [MppController::class, 'approve'])->name('mpp.approve');
    
});

// Registration Routes
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'createStudent']);

// Additional Authentication Routes
require __DIR__ . '/auth.php';
