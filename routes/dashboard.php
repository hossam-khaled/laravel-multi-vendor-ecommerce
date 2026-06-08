<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth', 'verified'],
    'name' => 'dashboard',
    'prefix' => '/dashboard',
    'as'=> 'dashboard.'
],function () {

    Route::get('/', action: [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/categories/trash', action: [CategoryController::class, 'trash'])->name('categories.trash');
    Route::put('/categories/{category}/restore', action: [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('/categories/{category}/force-delete', action: [CategoryController::class, 'forceDelete'])->name('categories.force-delete');
    Route::resource('/categories', CategoryController::class);
});
