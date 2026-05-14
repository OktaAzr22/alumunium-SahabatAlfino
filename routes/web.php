<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');


Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', fn() => view('user.dashboard'));
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', fn() => view('admin.dashboard'));
});


Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/super-admin', fn() => view('superadmin.dashboard'));
});