<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminTicketController;
use App\Http\Controllers\Admin\LocationController;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function (){

    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    /** Profile  */
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    /** Slider Routes */
    Route::resource('slider', SliderController::class);
    Route::resource('user', UserController::class);

    /** Ticket */
    Route::resource('tickets', AdminTicketController::class);
    Route::post('admin/tickets/{id}/update', [AdminTicketController::class, 'update'])->name('admin.tickets.update');
    Route::get('tickets/{id}/view', [AdminTicketController::class, 'view'])->name('tickets.view');

    /** Location */
    Route::resource('location', LocationController::class);
});

