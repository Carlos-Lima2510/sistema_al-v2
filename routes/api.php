<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CodigoColorController;
use App\Http\Controllers\TipoMaterialController;

// Rutas públicas
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('productos/activos', [ProductoController::class, 'activos']);
    // Rutas protegidas
    Route::apiResource('productos', ProductoController::class);
    Route::apiResource('marcas', MarcaController::class);
    Route::apiResource('categorias', CategoriaController::class);
    Route::apiResource('materiales', TipoMaterialController::class);
    Route::apiResource('codigo-color', CodigoColorController::class);
});


