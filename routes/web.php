<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\TenantSettingsController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/tenant-settings-integration', [TenantSettingsController::class, 'update'])->name('tenant-settings-integration.update');
    Route::get('/tenant-settings', [TenantController::class, 'edit'])->name('tenant-settings.edit');
    Route::post('/tenant-settings', [TenantController::class, 'update'])->name('tenant-settings.update');
    Route::get('/tenant-subscription-inactive', [TenantController::class, 'subscriptionInactive'])->name('tenant.subscription-inactive');
    
});

require __DIR__.'/auth.php';
