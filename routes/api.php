<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
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
Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
    Route::get('/user', [UserController::class, 'show']);
    });
    //Categories
    Route::get('category/{id}', [CategoriesController::class, 'show']);
    Route::post('categories', [CategoriesController::class, 'create']);
    Route::get('categories', [CategoriesController::class, 'index']);
    //Products
    Route::get('productsbycategory/{categoryName}', [ProductsController::class, 'ProductsByCategory']);
    Route::get('product/{id}', [ProductsController::class, 'show']);
    Route::post('products', [ProductsController::class, 'store']);
    Route::get('products', [ProductsController::class, 'index']);
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);

