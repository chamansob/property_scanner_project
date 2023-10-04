<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\PaymentController;

Route::get('/welcome', function () {
    return view('welcome');
});

// User Frontend All Route
Route::get('/', [UserController::class, 'Index']);
//Clear Cache facade value:
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('optimize');
    $exitCode = Artisan::call('route:cache');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');
    return '<h1>Cache facade value cleared</h1>';
});
//Clear Cache facade value:
Route::get('/make', function () {
    $exitCode = Artisan::call('make:component BackendAgentLayout');
    return '<h1>Backend</h1>';
});

Route::controller(PaymentController::class)
    ->prefix('paypal')
    ->group(function () {
        Route::view('payment', 'paypal.index')->name('create.payment');
        Route::get('handle-payment', 'handlePayment')->name('make.payment');
        Route::get('cancel-payment', 'paymentCancel')->name('cancel.payment');
        Route::get('payment-success', 'paymentSuccess')->name('success.payment');
    });
