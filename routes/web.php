<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrajetController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Protected routes for different roles
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });

    Route::middleware('role:traveler')->group(function () {
        Route::get('/bookings', function () {
            return view('traveler.bookings');
        })->name('bookings');
    });

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
});

// Public routes accessible to all users including visitors
Route::get('/trajets', function () {
    return view('trajets.index');
})->name('trajets');

Route::get('/trajets', [TrajetController::class, 'trajets'])->name('trajets');

// Public Routes
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/search', [TrajetController::class, 'search'])->name('search');

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


Route::get('checkout', function () {
    return view('voyageur.checkout');
})->name('checkout');

Route::get('/checkout/{id}', [PaymentController::class, 'show'])->name('checkout');
Route::post('/payment/create-intent/{id}', [PaymentController::class, 'createPaymentIntent'])->name('payment.create-intent');
Route::post('/payment/process/{id}', [PaymentController::class, 'processPayment'])->name('payment.process');
