<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// you need to call the controller file on route
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::get('/products', function() {
    return 'Ini Product loh';
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/categories', [ProductController::class, 'getCategory']);
Route::get('/brand', [ProductController::class, 'getBrand']);
Route::get('/location', [ProductController::class, 'getlocation']);
Route::get('/supplier', [ProductController::class, 'getSupplier']);

Route::get('/product', [ProductController::class, 'getProducts']);
Route::delete('/product/{id}', [ProductController::class, 'deleteProduct']);
Route::put('/product/{id}', [ProductController::class, 'updateProduct']);
Route::post('/product/find', [ProductController::class, 'findProduct']);
Route::post('/product/scan', [ProductController::class, 'findModel']);

Route::get('/productcategory/{id}', [ProductController::class, 'getProductsByCategory']);
Route::get('/productlocation/{id}', [ProductController::class, 'getProductsByLocation']);

Route::post('/location', [ProductController::class, 'createLocation']);

Route::post('/order', [OrderController::class, 'createOrder']);
Route::post('/orderdetail', [OrderController::class, 'createOrderDetail']);
Route::post('/deductquantity/{id}', [OrderController::class, 'updateProductQty']);
Route::get('/order', [OrderController::class, 'getOrders']);
Route::post('/orderdetail/{id}', [OrderController::class, 'getOrderDetail']);
Route::post('/orderreturn', [OrderController::class, 'setReturnProduct']);

Route::get('/profit', [OrderController::class, 'sumProfit']);

Route::post('/categories', [ProductController::class, 'createCategory']);

// protected Routed, required TOKEN access
Route::group(['middleware' => ['auth:sanctum']], function () {
   
    
    Route::put('/categories/{id}', [ProductController::class, 'updateCategory']);
    Route::delete('/categories/{id}', [ProductController::class, 'deleteCategory']);

    Route::post('/brand', [ProductController::class, 'createBrand']);
    Route::put('/brand/{id}', [ProductController::class, 'updateBrand']);
    Route::delete('/brand/{id}', [ProductController::class, 'deleteBrand']);

   
    Route::put('/location/{id}', [ProductController::class, 'updateLocation']);
    Route::delete('/location/{id}', [ProductController::class, 'deleteLocation']);

    Route::post('/supplier', [ProductController::class, 'createSupplier']);
    Route::put('/supplier/{id}', [ProductController::class, 'updateSupplier']);
    Route::delete('/supplier/{id}', [ProductController::class, 'deleteSupplier']);

    Route::post('/product', [ProductController::class, 'createProduct']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
