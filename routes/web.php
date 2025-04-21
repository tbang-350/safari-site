<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public Routes
Route::view('/', 'landing');
Route::view('/tours', 'tours');
Route::view('/about', 'about');
Route::view('/contact', 'contact');

// Booking Form Submission
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');

// Admin Routes (protected by auth middleware)
Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::view('/', 'dashboard');

    // Bookings Management
    Route::prefix('bookings')->name('admin.bookings.')->group(function () {
        Route::get('/', [BookingController::class, 'index'])->name('index');
        Route::get('/{booking}', [BookingController::class, 'show'])->name('show');
        Route::put('/{booking}', [BookingController::class, 'update'])->name('update');
        Route::delete('/{booking}', [BookingController::class, 'destroy'])->name('destroy');
    });

    // Contacts Management
    Route::prefix('contacts')->name('admin.contacts.')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('index');
        Route::get('/{contact}', [ContactController::class, 'show'])->name('show');
        Route::put('/{contact}', [ContactController::class, 'update'])->name('update');
        Route::delete('/{contact}', [ContactController::class, 'destroy'])->name('destroy');
    });

    // Admin Dashboard Pages
    Route::view('/analytics', 'admin.analytics');
    Route::view('/settings', 'admin.settings');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
