<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\UserController;

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

// Authentication Routes (disable registration)
Auth::routes(['register' => false]);

// Admin Routes (protected by auth middleware)
Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('admin.dashboard');

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

    // User Management
    Route::prefix('users')->name('admin.users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });

    // Tours Management
    Route::prefix('tours')->name('admin.tours.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\TourController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\Admin\TourController::class, 'store'])->name('store');
        Route::put('/{tour}', [App\Http\Controllers\Admin\TourController::class, 'update'])->name('update');
        Route::delete('/{tour}', [App\Http\Controllers\Admin\TourController::class, 'destroy'])->name('destroy');
    });

    // Admin Dashboard Pages
    Route::view('/analytics', 'admin.analytics')->name('admin.analytics');
    Route::view('/settings', 'admin.settings')->name('admin.settings');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
