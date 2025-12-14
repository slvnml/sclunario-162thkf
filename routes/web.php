<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HealthRecordController;
use App\Http\Controllers\DoctorDirectoryController;
use App\Http\Controllers\HealthAndWellnessController;
use App\Http\Controllers\UserController;

Route::view('/', 'welcome');

// Registration and Login Routes
Route::get('register', [UserController::class, 'create'])->name('register');
Route::post('register', [UserController::class, 'store']);
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'authenticate']);

// Health Records Routes
Route::resource('health-records', HealthRecordController::class);
Route::get('calendar-events', [HealthRecordController::class, 'calendarEvents'])->name('health-records.calendar-events');

Route::get('/doctor-directory', [DoctorDirectoryController::class, 'index'])->name('doctor-directory');
Route::get('/health-wellness', [HealthAndWellnessController::class, 'index'])->name('health-wellness');

Route::view('dashboard', 'dashboard')
    ->name('dashboard');

Route::view('profile', 'profile')
    ->name('profile');

require __DIR__.'/auth.php';
