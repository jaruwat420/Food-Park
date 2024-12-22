<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StaffDashboardController;
use App\Http\Controllers\Admin\StaffTicketController;

Route::group([
    'prefix' => 'staff',
    'as' => 'staff.',
    'middleware' => ['auth', 'role:staff']
], function () {
    // หน้า Dashboard
    Route::get('dashboard', [StaffDashboardController::class, 'index'])->name('dashboard');

    // จัดการ Profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile');
        Route::put('/', [ProfileController::class, 'updateProfile'])->name('profile.update');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    });

    // จัดการ Ticket
    Route::prefix('staff')->group(function () {
        Route::prefix('tickets')->group(function () {
            Route::resource('/', StaffTicketController::class)->names('tickets');
            Route::get('{ticketId}/view', [StaffTicketController::class, 'view'])->name('tickets.view');
            Route::get('{ticketId}/edit', [StaffTicketController::class, 'edit'])->name('tickets.edit');
            Route::post('tickets/{id}/update', [StaffTicketController::class, 'update'])->name('tickets.update');
        });
    });
});
