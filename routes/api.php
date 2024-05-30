<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::get('/get-all-products', [HomeController::class, 'index'])->name('index');
Route::get('/get-product-details/{id}', [HomeController::class, 'details'])->name('details');
Route::get('/get-categories', [HomeController::class, 'categories'])->name('categories');
Route::get('/get-products-bycate/{id}', [HomeController::class, 'productsByCate'])->name('products.bycate');
Route::get('/search/{searchKeyword}', [HomeController::class, 'search'])->name('search');
Route::post('/register', [HomeController::class, 'register'])->name('register');
Route::post('/login', [HomeController::class, 'login'])->name('login');
Route::post('/like', [HomeController::class, 'like'])->name('like');
Route::post('/like-status', [HomeController::class, 'likeStatus'])->name('like.status');
