<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusUpdateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

/*
|---------------------------------------------------------------------------------------
|CUSTOM LOGIN
|---------------------------------------------------------------------------------------
*/

Route::post('signin', [LoginController::class, 'signin'])->name('signin');
Route::post('verify', [LoginController::class, 'verify'])->name('verify');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'], function () {


    Route::get('test', function () {

        $user = [
            'name' => 'Khorshed Alom',
            'info' => 'Laravel Devloper'
        ];

        \Mail::to('khorshed.smartsoftware@gmail.com')->send(new \App\Mail\LoginMail($user));

        dd("success");

    });


    Route::post('status-update', [StatusUpdateController::class, 'statusUpdate'])->name('status-update');
});
