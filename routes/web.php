<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


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

// Route::get('/dashboard/categories', [CategoryController::class, 'index'])->middleware(['auth'])->name('dashboard.categories');
// Route::get('/dashboard/categories/create', [CategoryController::class, 'create'])->middleware(['auth'])->name('dashboard.categories.create');
// Route::post('/dashboard/categories', [CategoryController::class, 'store'])->middleware(['auth'])->name('dashboard.categories.store');
// Route::get('/dashboard/categories/{id}', [CategoryController::class, 'show'])->middleware(['auth'])->name('dashboard.categories.show');
// Route::get('/dashboard/categories/{id}/edit', [CategoryController::class, 'edit'])->middleware(['auth'])->name('dashboard.categories.edit');
// Route::put('/dashboard/categories/{id}', [CategoryController::class, 'update'])->middleware(['auth'])->name('dashboard.categories.update');
// Route::delete('/dashboard/categories/{id}', [CategoryController::class, 'destroy'])->middleware(['auth'])->name('dashboard.categories.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';
