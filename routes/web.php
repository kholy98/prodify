<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

    Route::resource('products', ProductController::class);


    Route::post('/upload', [ProductController::class, 'uploadImages']);
    Route::post('/delete', [ProductController::class, 'deleteImages']);
});

Route::post('/upload', [ProductController::class, 'uploadImages'])->name('products.upload');
Route::post('/delete', [ProductController::class, 'deleteImages'])->name('products.delete-image');


require __DIR__.'/auth.php';
