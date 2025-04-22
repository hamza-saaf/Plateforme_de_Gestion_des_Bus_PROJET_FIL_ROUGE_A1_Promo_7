<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrajetController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('trajets', [TrajetController::class, 'index']);
Route::post('trajets', [TrajetController::class, 'store']);
Route::get('search', [TrajetController::class, 'search'])->name('search');
Route::get('login', function () {
    return view('login');
})->name('login');
Route::get('trajetsPopulaires', function () {
    return view('trajetsPopulaires');
})->name('trajetsPopulaires');
Route::get('dashboard', function () {
    return view('Admin.dashboard');
})->name('dashboard');
