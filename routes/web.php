<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminAuthController;

Route::middleware(['notLogout'])->group(function () {
    //login
    Route::get('/', [AdminAuthController::class, 'showLoginForm'])->name('admin.showLoginForm');
    Route::post('/', [AdminAuthController::class, 'login'])->name('admin.login');
});

Route::middleware(['isAdminLogin'])->group(function () {

    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //categories
    Route::post('categories/import', [CategoryController::class, 'import'])->name('categories.import');
    Route::get('categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('fetch-categories', [CategoryController::class, 'fetchCategories']);
    Route::get('edit-categories/{id}', [CategoryController::class, 'editCategories']);
    Route::put('update-categories/{id}', [CategoryController::class, 'updateCategories']);
    Route::delete('delete-category/{id}', [CategoryController::class, 'deleteCategory']);


    //products
    Route::get('products', [ProductsController::class, 'index'])->name('products');
    Route::post('products', [ProductsController::class, 'store']);
    Route::get('/products/ajax', [ProductsController::class, 'ajaxProducts'])->name('products.ajax');
    Route::get('edit-products/{id}', [ProductsController::class, 'edit']);
    Route::put('update-product/{id}', [ProductsController::class, 'updateProduct']);
    Route::delete('delete-product/{id}', [ProductsController::class, 'destroy']);

    //logout
    Route::get('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});



