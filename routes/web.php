<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowDetailController;
use App\Http\Controllers\UserController;

Auth::routes();

Route::middleware(['auth'])->group(function () {
    
    // Dashboard / Home
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Books & Borrowing (Accessible by everyone authenticated)
    Route::resource('books', BookController::class);
    Route::resource('borrows', BorrowDetailController::class);

    // REQUIREMENT: Only admin users can manage Users
    Route::middleware(['can:admin-only'])->group(function () {
        Route::resource('users', UserController::class);
    });

    // REQUIREMENT: Users can only view their own account
    Route::get('/my-account', [UserController::class, 'showSelf'])->name('account.me');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
