<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Mortezaa97\Brands\Http\Controllers\BrandController;

Route::prefix('api')->middleware('api')->group(function () {
    Route::get('brands', [BrandController::class, 'index'])->name('brands.index');
    Route::get('brands/{brand:slug}', [BrandController::class, 'show'])->name('brands.show');
});
