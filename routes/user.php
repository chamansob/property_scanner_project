<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('frontend.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard')->middleware(RedirectIfAuthenticated::class);

Route::middleware(['auth', 'roles:user'])->prefix('user')->group(function () {
    // User Routes
    Route::controller(UserController::class)->group(function () {
        Route::get('/profile', 'UserProfile')->name('user.profile');
        Route::post('/profile/store', 'UserProfileStore')->name('user.profile.store');
        Route::get('/change/password', 'UserChangePassword')->name('user.change.password');
        Route::post('/password/update', 'UserPasswordUpdate')->name('user.password.update');
        Route::get('/schedule/request', 'UserScheduleRequest')->name('user.schedule.request');
    });
});