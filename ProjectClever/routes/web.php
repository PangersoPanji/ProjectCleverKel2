<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/categories/{category}', [ServiceController::class, 'byCategory'])->name('services.category');
Route::get('/help', [ContentController::class, 'index'])->name('help');
Route::get('/categories/{category}', [ServiceController::class, 'byCategory'])
    ->name('services.category');

// Authentication Routes
require __DIR__ . '/auth.php';

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Freelancer Service Routes
Route::middleware(['auth', \App\Http\Middleware\EnsureUserRole::class . ':freelancer'])->group(function () {
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/manage', [ServiceController::class, 'manage'])->name('services.manage');
    Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
    Route::get('/my-orders', [OrderController::class, 'freelancerOrders'])->name('orders.freelancer');
    Route::patch('/orders/{project}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::post('/api/categories', [CategoryController::class, 'store'])->name('categories.store');
});


Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/services/{service}/order', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/services/{service}/order', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{project}/success', [OrderController::class, 'success'])->name('orders.success');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{project}', [OrderController::class, 'show'])->name('orders.show');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/projects/{project}/review', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});
