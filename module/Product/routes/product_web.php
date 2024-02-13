<?php

use Illuminate\Support\Facades\Route;
use Module\Product\Controllers\UnitController;
use Module\Product\Controllers\ProductController;
use Module\Product\Controllers\ChangePasswordController;
use Module\Product\Controllers\QRCodeGenerateController;
use Module\Product\Controllers\UserController;
use Module\Product\Controllers\BusinessSettingController;
use Module\Product\Controllers\CustomerController;
use Module\Product\Controllers\ReferralEmployeeController;
use Module\Product\Controllers\WithdrawRequestController;






Route::group(['prefix' => 'product', 'as' => 'product.', 'middleware' => ['auth', 'permission']], function () {


    /*
        |--------------------------------------------------
        | Resource Route
        |--------------------------------------------------
        */
    Route::resources([
        'units'                 => UnitController::class,
        'products'              => ProductController::class,
        'qr-generates'          => QRCodeGenerateController::class,
        'users'                 => UserController::class,
        'business-settings'     => BusinessSettingController::class,
        'customers'             => CustomerController::class,
        'referral_employees'    => ReferralEmployeeController::class,
        'withdraw_requests'     => WithdrawRequestController::class,

    ]);

    Route::get('change-password', [ChangePasswordController::class, 'index'])->name('change.password');
    Route::post('change-password-update', [ChangePasswordController::class, 'update'])->name('change.password.update');

    Route::get('qr_code/print/{id}', [QRCodeGenerateController::class, 'print'])->name('qr_code.print');
    Route::get('generate-pdf/{id}', [QRCodeGenerateController::class, 'generatePDF'])->name('qr.pdf');
    Route::get('generate-pdf/small/{id}', [QRCodeGenerateController::class, 'generateSmallPDF'])->name('qr.pdf.small');
    Route::get('approved/{id}', [QRCodeGenerateController::class, 'approved'])->name('qr.approved');

});
