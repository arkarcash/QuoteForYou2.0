<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\NoteController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\ReportController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function ($q){

    Route::post('logout',[AuthController::class,'logout']);
//    Route::resource('cart', CartController::class)->only('index','store');
//    Route::post('single/cart',[CartController::class,'singleStore']);
//    Route::delete('cart/delete/{user_id}', [CartController::class,'deleteCart']);
//    Route::resource('order', OrderController::class)->only('index','store','show');

    Route::get('delete/user/{user_id}',[AuthController::class,'deleteUser']);
    Route::post('change/password',[AuthController::class,'changePassword']);

    Route::get('toggle/save/note/{note_id}',[NoteController::class,'toggleSaveNote']);
    Route::get('saved/notes',[NoteController::class,'savedNotes']);

    Route::get('save/book/{book_id}',[BookController::class,'toggleSaveBook']);
    Route::get('saved/books',[BookController::class,'savedBooks']);

    Route::get('add/point/{points}',[AuthController::class,'addPoint']);
    Route::get('detail',[AuthController::class,'detail']);
    Route::post('report',[ReportController::class,'report']);

});

Route::get('/books',[BookController::class,'books']);
Route::get('/category/books',[BookController::class,'CategoryBooks']);

Route::get('/blogs',[BookController::class,'blogs']);

Route::get('voice/categories',[NoteController::class,'voiceCategories']);

//note route
Route::get('poems',[NoteController::class,'poems']);
Route::get('quote',[NoteController::class,'quote']);

Route::get('voices',[NoteController::class,'voices']);
Route::get('ads',[NoteController::class,'ads']);

Route::get('analysis',[BookController::class,'analysis']);
Route::get('tags',[BookController::class,'tags']);
Route::get('authors',[BookController::class,'bookAuthor']);


Route::get('note/views/{note_id}',[NoteController::class,'increaseNote']);
Route::get('voice/views/{voice_id}',[NoteController::class,'increaseVoice']);

Route::get('banners',[ReportController::class,'banners']);
//Route::get('product/{product_id}',[ProductController::class,'show']);
