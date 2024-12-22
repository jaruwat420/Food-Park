<?php

// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\UploadsController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\TicketController;
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

/** Admin Auth Routes */
Route::group(['middleware' => 'guest'], function(){
    Route::get('admin/login', [AdminAuthController::class, 'index'])->name('admin.login');
    Route::get('admin/forget-password', [AdminAuthController::class, 'forgetPassword'])->name('admin.forget-password');
});

/** profile route */
Route::group(['middleware' => 'auth', 'as' => 'profile.'], function(){
    Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');
    Route::put('profile',[ProfileController::class, 'updateProfile'])->name('update');
    Route::put('profile/password',[ProfileController::class, 'updatePassword'])->name('password.update');
    Route::post('profile/avatar',[ProfileController::class, 'updateAvatar'])->name('avatar.update');
});

/** profile route */
Route::get('/', [FrontendController::class, 'index'])->name('home');

/** Tickets Route */
Route::middleware(['auth'])->group(function () {
    Route::resource('ticket', TicketController::class);
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets', [TicketController::class, 'getUserTickets'])->name('tickets.user');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::patch('/tickets/{ticket}/status', [TicketController::class, 'updateStatus'])->name('tickets.update.status');
    Route::patch('/tickets/{ticket}/assign', [TicketController::class, 'assign'])->name('tickets.assign');
    Route::get('tickets/{id}/detail', [TicketController::class, 'detail'])->name('tickets.detail');
    Route::get('tickets/{id}/comments', [TicketController::class, 'getComments']);
    Route::post('tickets/comments/storeComment', [TicketController::class, 'storeComment'])->name('tickets.comment.store');
    // upload file
    Route::post('/upload/temp', [UploadsController::class, 'tempUpload'])->name('upload.temp');
    Route::post('/upload/remove', [UploadsController::class, 'removeFile'])->name('upload.remove');
});

require __DIR__.'/auth.php';



