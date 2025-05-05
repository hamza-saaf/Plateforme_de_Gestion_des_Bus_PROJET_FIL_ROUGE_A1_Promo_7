<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrajetController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
// use App\Http\Controllers\RealtimeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/trajets', [TrajetController::class, 'trajets'])->name('trajets');

// Public Routes
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/search', [TrajetController::class, 'search'])->name('search');

Route::get('login', function () {
    return view('login');
})->name('login');

Route::get('register', function () {
    return view('register');
})->name('register');

// Trips Related Routes
Route::prefix('trips')->name('trips.')->group(function () {
    Route::get('/', [TrajetController::class, 'index'])->name('index');
    Route::get('/popular', [TrajetController::class, 'popular'])->name('popular');
    Route::get('/search', [TrajetController::class, 'search'])->name('search');
    Route::get('/{trip}', [TrajetController::class, 'show'])->name('show');
    Route::get('/{trip}/book', [TrajetController::class, 'book'])->name('book');
    Route::post('/{trip}/reserve', [ReservationController::class, 'store'])->name('reserve');
});

// Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [StatistiqueController::class, 'getStatistics'])->name('dashboard');
    Route::get('/statistics', [StatistiqueController::class, 'getStatistics'])->name('statistics');
    // Route::get('/realtime', [RealtimeController::class, 'index'])->name('realtime');
    
    // User 
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });
    
    // Trajet Management Routes
    Route::prefix('trajets')->name('trajets.')->group(function () {
        Route::get('/', [TrajetController::class, 'index'])->name('index');
        Route::post('/', [TrajetController::class, 'store'])->name('store');
        Route::get('/{trajet}/edit', [TrajetController::class, 'edit'])->name('edit');
        Route::put('/{trajet}', [TrajetController::class, 'update'])->name('update');
        Route::delete('/{trajet}', [TrajetController::class, 'destroy'])->name('destroy');
    });


    // Booking Management Routes
    Route::prefix('bookings')->name('bookings.')->group(function () {
        Route::get('/', [BookingController::class, 'index'])->name('index');
        Route::get('/{booking}', [BookingController::class, 'show'])->name('show');
        Route::put('/{booking}', [BookingController::class, 'update'])->name('update');
        Route::delete('/{booking}', [BookingController::class, 'destroy'])->name('destroy');
    });
});

// Redirect trajetsPopulaires to trips.popular for backward compatibility
Route::get('trajetsPopulaires', function () {
    return redirect()->route('trips.popular');
})->name('trajetsPopulaires');


Route::get('/checkout', [PaymentController::class, 'checkoutForm'])->name('checkout.form');
Route::post('/checkout', [PaymentController::class, 'processPayment'])->name('checkout.process');
