<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminAuthController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login']);
Route::post('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


Route::get('categories/import', [CategoryController::class, 'showImportForm'])->name('categories.importForm');
Route::post('categories/import', [CategoryController::class, 'import'])->name('categories.import');

Route::get('categories', [CategoryController::class, 'index']);
Route::get('fetch-categories', [CategoryController::class, 'fetchCategories']);
Route::get('edit-categories/{id}', [CategoryController::class, 'editCategories']);
Route::put('update-categories/{id}', [CategoryController::class, 'updateCategories']);
Route::delete('delete-category/{id}', [CategoryController::class, 'deleteCategory']);

