<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', [\App\Http\Controllers\ProductController::class, 'index'])->name('index');

Route::get('/category/{category}', [\App\Http\Controllers\ProductController::class, 'filter'])->name('index.filter');

Route::get('/product/{product}', [\App\Http\Controllers\ProductController::class, 'show'])->name('show.product');

Route::get('/users', [\App\Http\Controllers\UserController::class, 'list']) -> name('users.list');





