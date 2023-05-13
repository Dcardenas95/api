<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CoordinateDeliveryController;
use App\Http\Controllers\DeliveryAvailabilityController;
use App\Http\Controllers\EstablishmentsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::put('availability' , [DeliveryAvailabilityController::class, 'update']);
    Route::put('coordinates' , [CoordinateDeliveryController::class, 'update']);

    Route::get('establishment' , [EstablishmentsController::class, 'index']);
    Route::get('establishment/{establishment}' , [EstablishmentsController::class , 'show']);

    Route::post('cart/add-product/{product}' , [CartController::class, 'store']);
    Route::put('cart/update/{rowId}' , [CartController::class, 'update']);
    Route::delete('cart/delete/{rowId}' , [CartController::class, 'destroy']);
    Route::get('cart' , [CartController::class , 'index']);
    
    Route::get('products/{product}' , [ProductController::class , 'store'])->name('product.show');


    Route::get('orders', [OrderController::class , 'index']);
    Route::post('orders', [OrderController::class , 'store']);

    Route::get('/user', function (Request $request) {
        return Auth::user();
    });

});

Route::post('login', [LoginController::class,'login']);
