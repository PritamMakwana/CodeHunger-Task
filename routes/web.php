<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminAuthController;

Route::middleware(['notLogout'])->group(function () {
    Route::get('/', [AdminAuthController::class, 'showLoginForm'])->name('admin.showLoginForm');
    Route::post('/', [AdminAuthController::class, 'login'])->name('admin.login');
});

Route::middleware(['isAdminLogin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('categories/import', [CategoryController::class, 'import'])->name('categories.import');
    Route::get('categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('fetch-categories', [CategoryController::class, 'fetchCategories']);
    Route::get('edit-categories/{id}', [CategoryController::class, 'editCategories']);
    Route::put('update-categories/{id}', [CategoryController::class, 'updateCategories']);
    Route::delete('delete-category/{id}', [CategoryController::class, 'deleteCategory']);

    Route::get('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});



