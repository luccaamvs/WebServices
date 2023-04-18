<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\MarcaController;
use App\Http\Controllers\Api\ProdutoController;
use App\Http\Controllers\Api\PedidoController;

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

Route::middleware("localization")->group(function(){
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
    //Marcas
    route::apiResource('marcas', MarcaController::class);

    //Clientes
    route::apiResource('clientes', MarcaController::class);

    //Produtos
    route::apiResource('produtos', CategoriaController::class);

    //Pedidos
    route::apiResource('clientes.pedidos', CategoriaController::class);

    //Itens Pedidos
    route::apiResource('pedidos.itensdopedido', CategoriaController::class);

    //Categorias
    route::apiResource('categorias', CategoriaController::class);
});





