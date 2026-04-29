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
    
    Route::resource('/categories', CategoryController::class);
});
