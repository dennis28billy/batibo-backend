<?php

use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\MidtransController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function(){
    Route::get('user', [UserController::class, 'fetch']);
    Route::post('user', [UserController::class, 'updateProfile']);
    Route::post('user/photo', [UserController::class, 'updatePhoto']);
    Route::post('logout', [UserController::class, 'logout']);

    Route::get('address', [AddressController::class, 'all']);
    Route::post('address/add', [AddressController::class, 'addAddress']);
    Route::post('address/{id}', [AddressController::class, 'updateAddress']);
    Route::delete('address/{id}', [AddressController::class, 'deleteAddress']);

    Route::get('cart', [CartController::class, 'all']);
    Route::post('cart/add', [CartController::class, 'addCart']);
    Route::post('cart/{id}', [CartController::class, 'updateCart']);
    Route::delete('cart/{id}', [CartController::class, 'deleteCart']);

    Route::post('checkout', [TransactionController::class, 'checkout']);

    Route::get('transaction', [TransactionController::class, 'all']);
    Route::post('transaction/{id}', [TransactionController::class, 'update']);
    Route::delete('transaction/{id}', [TransactionController::class, 'delete']);

    Route::get('order', [OrderController::class, 'all']);
    Route::post('order/add', [OrderController::class, 'addOrder']);
});

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

Route::get('product', [ProductController::class, 'all']);

Route::post('midtrans/callback', [MidtransController::class, 'callback']);
