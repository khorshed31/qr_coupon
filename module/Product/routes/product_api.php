<?php


use Illuminate\Support\Facades\Route;
use Module\Product\Controllers\Api\CustomerController;
use Module\Product\Controllers\Api\AuthController;
use Module\Product\Controllers\Api\QRCodeController;
use Module\Product\Controllers\Api\WithdrawController;



    Route::group(['prefix' => 'qr'], function () {

        //Customer
        Route::post('customer/register', [CustomerController::class, 'register']);
        Route::post('login',              [AuthController::class, 'login']);
        Route::post('check-customer',     [AuthController::class, 'checkCustomer']);
    });


    Route::group(['prefix' => 'qr', 'middleware' => ['auth:sanctum']], function () {

        Route::get('customer', [CustomerController::class, 'index']);
        Route::post('customer/update', [CustomerController::class, 'update']);
        Route::post('customer/change-password', [CustomerController::class, 'change_password']);




        Route::post('qr-code/check', [QRCodeController::class, 'checkQrCode']);
        Route::post('withdraw', [WithdrawController::class, 'withdraw']);





    });
