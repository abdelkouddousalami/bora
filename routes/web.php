<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/services', [ServicesController::class, 'index'])->name('services');

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('language/{lang}', [LanguageController::class, 'switch'])->name('language.switch');

Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');

// User routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/my-reservations', [DashboardController::class, 'userReservations'])->name('user.reservations');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
    Route::get('/users', [DashboardController::class, 'getUsers'])->name('users');
    
    // Reservation management routes
    Route::patch('/reservations/{reservation}/status', [DashboardController::class, 'updateReservationStatus'])->name('reservations.update-status');
    Route::delete('/reservations/{reservation}', [DashboardController::class, 'deleteReservation'])->name('reservations.delete');
});
