<?php

use App\Http\Controllers\Auth\LoginSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('plans/{plan:slug}', [PlanController::class, 'show'])->name('plan.show');

Route::post('/buy-plan/webhook', [PlanController::class, 'webhook'])->name('plan.webhook');

Route::get('/buy-plan/success', [PlanController::class, 'success'])->name('plan.success');
Route::get('/buy-plan/cancel', [PlanController::class, 'cancel'])->name('plan.cancel');
Route::post('/buy-plan/{plan:slug}', [PlanController::class, 'buyPlan'])->name('plan.buy');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [LoginSessionController::class, 'create'])->name('login');
    Route::post('/login', [LoginSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::delete('/logout', [LoginSessionController::class, 'destroy']);
});
