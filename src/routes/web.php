<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Middleware\EnsureUserIsRegistered;



Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');
Route::get('/weight_logs/search', [WeightLogController::class, 'search'])->name('weight_logs.search');
Route::post('/weight_logs/store', [WeightLogController::class, 'store'])->name('weight_logs.store');
Route::get('/weight_logs/{id}/edit', [WeightLogController::class, 'edit'])->name('weight_logs.edit');
Route::put('/weight_logs/{id}', [WeightLogController::class, 'update'])->name('weight_logs.update');
Route::get('/weight_logs/{id}/delete', [WeightLogController::class, 'deleteConfirm'])->name('weight_logs.delete');
Route::delete('/weight_logs/{id}', [WeightLogController::class, 'destroy'])->name('weight_logs.destroy');
Route::get('/weight_logs/goal_setting', [WeightLogController::class, 'goalSetting'])->name('weight_logs.goal_setting');
Route::post('/weight_logs/goal_update', [WeightLogController::class, 'goalUpdate'])->name('weight_logs.goal_update');

Route::get('/register/step1', [RegisterUserController::class, 'showStep1Form'])->name('register.step1.form');
Route::post('/register/step1', [RegisterUserController::class, 'storeStep1'])->name('register.step1');
Route::get('/register/step2', [RegisterUserController::class, 'showStep2Form'])->name('register.step2.form');
Route::post('/register/step2', [RegisterUserController::class, 'storeStep2'])->name('register.step2');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


Route::middleware(['auth', EnsureUserIsRegistered::class])->group(function () {
    Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');
});