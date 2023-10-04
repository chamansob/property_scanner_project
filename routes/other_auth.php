<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

Route::get('/agent/login', [AgentController::class, 'AgentLogin'])->name('agent.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/agent/register', [AgentController::class, 'AgentRegisterview'])->name('agent.register');
Route::post('/agent/register', [AgentController::class, 'AgentRegister']);

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
Route::get('/agent/logout', [AgentController::class, 'AgentLogout'])->name('agent.logout');
Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');