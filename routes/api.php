<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
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

Route::middleware('auth:sanctum')->group(function (){
 
         Route::get('/user', function (Request $request) {
            return $request->user();
         });
         /*
         Debemos de asegurarnos de que sea un usuario authenticado para cerrar ese token
         */
         Route::post('/logout',[AuthController::class,'logout']);

         Route::apiResource('/pedidos',PedidoController::class);

         Route::apiResource('/categorias',CategoriaController::class);

         Route::apiResource('/productos',ProductoController::class);

});


//Route::get('/categorias',[CategoriaController::class ,'index']);
/*
Creao una api que por defecto se le añade api/productos
coge el methos idndex
*/
//Route::apiResource('/categorias',CategoriaController::class);

//Route::apiResource('/productos',ProductoController::class);

Route::post('/registro',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
//Route::post('/logout',[AuthController::class,'logout']);

