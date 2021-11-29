<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Panel\UserController;
use App\Http\Controllers\Panel\ProductController;
use App\Http\Controllers\Panel\ProductCategoryController;
use App\Http\Controllers\Profile\CartController;
use App\Http\Controllers\Panel\DashboardController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['cors'])->group(function () {
    // Route::middleware('auth:api')->group(function () {
        Route::get('/logout', [AuthController::class, 'logout']);
        // Private Routes
        // panel routes
        // Route::middleware(['isAdmin'])->group(function() {
            Route::namespace('Panel')->prefix('panel')->group(function () {
                Route::prefix('dashboard')->group(function() {
                    Route::get('/', [DashboardController::class, 'index']);
                });
                Route::prefix('users')->group(function () {
                    // Route::resource('users', UserController::class);
                    Route::get('/{id}', [UserController::class, 'show']);
                    Route::get('/', [UserController::class, 'index']);
                    Route::post('/', [UserController::class, 'store']);
                    Route::patch('/{user}', [UserController::class, 'update']);
                    Route::delete('/{user}', [UserController::class, 'destroy']);
                });
                //Route::apiResource('users', UserController::class);
                Route::prefix('products')->group(function () {
                    Route::get('/{id}', [ProductController::class, 'show']);
                    Route::get('/', [ProductController::class, 'index']);
                    Route::post('/', [ProductController::class, 'store']);
                    Route::patch('/{product}', [ProductController::class, 'update']);
                    Route::delete('/{product}', [ProductController::class, 'destroy']);
                });
                Route::prefix('categories')->group(function () {
                    Route::get('/{id}', [ProductCategoryController::class, 'show']);
                    Route::get('/', [ProductCategoryController::class, 'index']);
                    Route::post('/', [ProductCategoryController::class, 'store']);
                    Route::patch('/{category}', [ProductCategoryController::class, 'update']);
                    Route::delete('/{category}', [ProductCategoryController::class, 'destroy']);
                });
            });
        // });
        // profile routes
        Route::middleware('profile')->group(function() {
            Route::namespace('Profile')->prefix('profile')->middleware('verified')->group(function() {
                Route::get('cart', [CartController::class, 'getCart']);
                //Route::post('remove/cart', [CartController::class], 'removeFromCart');
                //Route::get('add/cart', [CartController::class], 'addToCart');
                //Route::get('cart', [CartController::class], 'getCart');
            });
        });
    });
// });
// Public Routes
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/verify-email/{user:username}/{timestamp}', [AuthController::class, 'verifyEmail'])->name('verify-email');

Route::get('/products', [HomeController::class, 'products']);
Route::get('/categories', [HomeController::class, 'categories']);
Route::get('/brands', [HomeController::class, 'brands']);