<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController;


//
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function (){

    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    /**Profile */
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

