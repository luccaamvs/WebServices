<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\MarcaController;
use App\Http\Controllers\Api\ProdutoController;
use App\Http\Controllers\Api\PassportAuthController;

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

//Ropa para Seguranca do Usuario

Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);
Route::post('logout', [PassportAuthController::class, 'logout'])->middleware('auth:api');
Route::get('user', [PassportAuthController::class, 'userInfo'])->middleware('auth:api');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Categorias
route::apiResource('categorias', CategoriaController::class)->middleware('auth:api');

//Marcas
route::apiResource('marcas', MarcaController::class);

//Produtos
route::apiResource('produtos', ProdutoController::class);


