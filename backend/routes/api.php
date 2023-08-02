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
    Route::post('/update-info/{$id}', [Controllers\api\UserController::class, 'updateInfo']);
    Route::post('/update-password/{$id}', [Controllers\api\UserController::class, 'updatePassword']);
    Route::post('/remove-user/{id}', [Controllers\api\UserController::class, 'removeUser']);

    //product
    Route::post('/products', [Controllers\api\ProductController::class, 'index']);
    Route::get('/product/{id}', [Controllers\api\ProductController::class, 'getProduct']);
    Route::post('/product/create', [Controllers\api\ProductController::class, 'createProduct']);
    Route::post('/product/update/{id}', [Controllers\api\ProductController::class, 'updateProduct']);
    Route::post('/product/delete/{id}', [Controllers\api\ProductController::class, 'deleteProduct']);

    //cart
    Route::post('/cart', [Controllers\api\CartController::class, 'index']);
    Route::post('/cart/create', [Controllers\api\CartController::class, 'addProductToCart']);
    Route::post('/cart/update/{id}', [Controllers\api\CartController::class, 'updateCart']);
    Route::post('/cart/delete/{id}', [Controllers\api\CartController::class, 'deleteCart']);

    //orders
    Route::post('/order', [Controllers\api\OrderController::class, 'index']);
    Route::get('/order/{id}', [Controllers\api\OrderController::class, 'getOrder']);
    Route::post('/order/create', [Controllers\api\OrderController::class, 'createOrder']);
    Route::post('/order/update/{id}', [Controllers\api\OrderController::class, 'updateOrderStatusAndShipper']);
    Route::post('/order/canceled/{id}', [Controllers\api\OrderController::class, 'canceledOrder']);
    Route::post('/order/delete/{id}', [Controllers\api\OrderController::class, 'deleteOrder']);

    //shipper
    Route::post('/shippers', [Controllers\api\ShipperController::class, 'index']);
    Route::get('/shipper/{id}', [Controllers\api\ShipperController::class, 'getShipper']);
    Route::post('/shipper/create', [Controllers\api\ShipperController::class, 'createShipper']);
    Route::post('/shipper/update/{id}', [Controllers\api\ShipperController::class, 'updateShipper']);
    Route::post('/shipper/delete/{id}', [Controllers\api\ShipperController::class, 'deleteShipper']);

    //suppliers
    Route::post('/suppliers', [Controllers\api\SupplierController::class, 'index']);
    Route::get('/supplier/{id}', [Controllers\api\SupplierController::class, 'getSupplier']);
    Route::post('/supplier/create', [Controllers\api\SupplierController::class, 'createSupplier']);
    Route::post('/supplier/update/{id}', [Controllers\api\SupplierController::class, 'updateSupplier']);
    Route::post('/supplier/delete/{id}', [Controllers\api\SupplierController::class, 'deleteSupplier']);

    //category
    Route::post('/categories', [Controllers\api\CategoryController::class, 'index']);
    Route::get('/category/{id}', [Controllers\api\CategoryController::class, 'getCategory']);
    Route::post('/category/create', [Controllers\api\CategoryController::class, 'createCategory']);
    Route::post('/category/update/{id}', [Controllers\api\CategoryController::class, 'updateCategory']);
    Route::post('/category/delete/{id}', [Controllers\api\CategoryController::class, 'deleteCategory']);

});

