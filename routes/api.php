<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')->group(function ($router) {
    $router->post('login', [AuthController::class, 'login']);
});

Route::prefix('auth')->middleware('auth:sanctum')->group(function ($router) {
    $router->get('validateToken', [AuthController::class, 'validateToken']);
});

Route::prefix('store')->middleware('auth:sanctum')->group(function ($router) {
    $router->get('index', [StoreController::class, 'index']);
    $router->post('store', [StoreController::class, 'store']);
    $router->post('update', [StoreController::class, 'update']);
    $router->post('inactivate', [StoreController::class, 'inactivate']);
    $router->post('activate', [StoreController::class, 'activate']);
    $router->post('delete', [StoreController::class, 'delete']);
});
