<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

Route::middleware('api')->group(function () {
    Route::get('/products', [ProductoController::class, 'index']);
});
