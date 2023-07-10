<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\api\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(UserController::class)->group(function () {
    Route::post('/register', 'register');
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/get-info', [Controllers\api\UserController::class, 'getInfo']);

    //product
    Route::post('/products', [Controllers\api\ProductController::class, 'getAllProducts']);
    Route::get('/product/{id}', [Controllers\api\ProductController::class, 'getProduct']);
    Route::get('/product/create', [Controllers\api\ProductController::class, 'createProduct']);
    Route::get('/product/update/{id}', [Controllers\api\ProductController::class, 'updateProduct']);
    Route::get('/product/delete/{id}', [Controllers\api\ProductController::class, 'deleteProduct']);

    //shopping cart
    Route::post('/shopping-cart', [Controllers\api\ShoppingCartController::class, 'getAllCart']);
    Route::get('/shopping-cart/{id}', [Controllers\api\ShoppingCartController::class, 'getCart']);
    Route::get('/shopping-cart/create', [Controllers\api\ShoppingCartController::class, 'createCart']);
    Route::get('/shopping-cart/update/{id}', [Controllers\api\ShoppingCartController::class, 'updateCart']);
    Route::get('/shopping-cart/delete/{id}', [Controllers\api\ShoppingCartController::class, 'deleteCart']);

    //Orders
    Route::post('/order', [Controllers\api\OrderController::class, 'getAllOrders']);
    Route::get('/order/{id}', [Controllers\api\OrderController::class, 'getOrder']);
    Route::get('/order/create', [Controllers\api\OrderController::class, 'createOrder']);
    Route::get('/order/update/{id}', [Controllers\api\OrderController::class, 'updateOrder']);
    Route::get('/order/delete/{id}', [Controllers\api\OrderController::class, 'deleteOrder']);

    //shipper
    Route::post('/shipper', [Controllers\api\ShipperController::class, 'getAllShippers']);
    Route::get('/shipper/{id}', [Controllers\api\ShipperController::class, 'getShipper']);
    Route::get('/shipper/create', [Controllers\api\ShipperController::class, 'createShipper']);
    Route::get('/shipper/update/{id}', [Controllers\api\ShipperController::class, 'updateShipper']);
    Route::get('/shipper/delete/{id}', [Controllers\api\ShipperController::class, 'deleteShipper']);

    //suppliers
    Route::post('/supplier', [Controllers\api\SupplierController::class, 'getAllSuppliers']);
    Route::get('/supplier/{id}', [Controllers\api\SupplierController::class, 'getSupplier']);
    Route::get('/supplier/create', [Controllers\api\SupplierController::class, 'createSupplier']);
    Route::get('/supplier/update/{id}', [Controllers\api\SupplierController::class, 'updateSupplier']);
    Route::get('/supplier/delete/{id}', [Controllers\api\SupplierController::class, 'deleteSupplier']);

});

