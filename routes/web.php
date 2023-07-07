<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [LoginController::class, 'show'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::name("user.")->prefix('/user')->group(function () {
	Route::get('/{id}/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
});
Route::name("admin.")->prefix('/admin')->group(function () {
	Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
});
Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.store');
