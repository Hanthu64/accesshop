<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [App\Http\Controllers\ProductController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', [\App\Http\Controllers\ProductController::class, 'index'])->name('index');

Route::get('/advanced-search', [\App\Http\Controllers\ProductController::class, 'advancedSearch'])->name('advanced-search');

Route::get('/category/{category}', [\App\Http\Controllers\ProductController::class, 'filter'])->name('index.filter');

Route::get('/product/{product}', [\App\Http\Controllers\ProductController::class, 'show'])->name('show.product');

Route::get('/users', [\App\Http\Controllers\UserController::class, 'list']) -> name('users.list');

Route::get('/profile', [\App\Http\Controllers\UserController::class, 'profile']) -> name('profile');

Route::get('/profile/product-create', [\App\Http\Controllers\ProductController::class, 'create']) -> name('product.create');

Route::put('/profile/product-create', [\App\Http\Controllers\ProductController::class, 'store']) -> name('product.store');

Route::delete('/profile/product/{product}', [\App\Http\Controllers\ProductController::class, 'delete']) -> name('product.delete');

Route::get('/profile/product-edit/{product}', [\App\Http\Controllers\ProductController::class, 'edit']) -> name('product.edit');

Route::put('/profile/product/{product}', [\App\Http\Controllers\ProductController::class, 'update']) -> name('product.update');

Route::delete('/profile/user/{user}', [\App\Http\Controllers\UserController::class, 'delete']) -> name('user.delete');

Route::get('/profile/user-edit/{user}', [\App\Http\Controllers\UserController::class, 'edit']) -> name('user.edit');

Route::put('/profile/user/{user}', [\App\Http\Controllers\UserController::class, 'update']) -> name('user.update');
