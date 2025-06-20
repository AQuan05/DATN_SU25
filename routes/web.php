<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\BlogController;

// Client Controllers
use App\Http\Controllers\Client\HomeController;

// Trang chủ
Route::get('/', function () {
    return view('coming-soon');
});

// Auth
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ========================= ADMIN =========================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Categories
    Route::get('/categories/data', [CategoryController::class, 'getData'])->name('categories.data');
    Route::resource('categories', CategoryController::class);

    // Products + Trash
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('trash', [ProductController::class, 'trash'])->name('trash');
        Route::post('{id}/restore', [ProductController::class, 'restore'])->name('restore');
        Route::delete('{id}/force-delete', [ProductController::class, 'forceDelete'])->name('forceDelete');
    });
    Route::resource('products', ProductController::class);


    Route::resource('customers', CustomerController::class)->except(['show']);
    Route::get('customers/{id}/show', [CustomerController::class, 'show'])->name('customers.show');
    Route::get('customers/trash', [CustomerController::class, 'trash'])->name('customers.trash');
    Route::get('customers/restore/{id}', [CustomerController::class, 'restore'])->name('customers.restore');
    Route::delete('customers/force-delete/{id}', [CustomerController::class, 'forceDelete'])->name('customers.forceDelete');

    // Users
    Route::resource('users', UserController::class)->except(['show']);
    Route::get('users/{id}/show', [UserController::class, 'show'])->name('users.show');
    Route::get('users/trash', [UserController::class, 'trash'])->name('users.trash');
    Route::get('users/restore/{id}', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('users/force-delete/{id}', [UserController::class, 'forceDelete'])->name('users.forceDelete');

    // Brands, Colors, Sizes
    Route::resource('brands', BrandController::class);
    Route::resource('colors', ColorController::class);
    Route::resource('sizes', SizeController::class);

    // Blogs
    Route::prefix('blogs')->name('blogs.')->group(function () {
        Route::get('trash', [BlogController::class, 'trash'])->name('trash');
        Route::post('{id}/restore', [BlogController::class, 'restore'])->name('restore');
        Route::delete('{id}/force-delete', [BlogController::class, 'forceDelete'])->name('forceDelete');
    });
    Route::resource('blogs', BlogController::class);
});
