<?php

use App\Http\Controllers\Api\OrderController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware('isNova')->group(function (){

    Route::get('nova/resources/order/confirm/{id}',[OrderController::class,'confirm'])->name('order.confirm');
    Route::get('nova/resources/order/delivery/{id}',[OrderController::class,'delivery'])->name('order.delivery');
    Route::get('nova/resources/order/complete/{id}',[OrderController::class,'complete'])->name('order.complete');
    Route::get('nova/resources/order/cancel/{id}',[OrderController::class,'cancel'])->name('order.canceled');

});
