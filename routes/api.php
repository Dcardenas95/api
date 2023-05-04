<?php

use App\Http\Controllers\EstablishmentsController;
use App\Http\Controllers\LoginController;
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

    Route::get('establishment' , [EstablishmentsController::class , 'index']);
    Route::get('establishment/{establishment}' , [EstablishmentsController::class , 'show']);

    Route::get('products/{product}' , [ProductController::class , 'show'])->name('product.show');


    Route::post('orders' , function() {
        abort_unless(Auth::user()->tokenCan('orders:create') , 403 , "You dont create order");
        return [
            'message' => 'order created'
        ];
    });

    Route::get('/user', function (Request $request) {
        return Auth::user();
    });

});

Route::post('login', [LoginController::class,'login']);
