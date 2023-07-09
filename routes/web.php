<?php

use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [\App\Http\Controllers\HomeController::class, "index"]);


Route::resource('admin/product', AdminProductController::class)->middleware('auth');
Route::get('admin/product/{product}/delete', [AdminProductController::class, 'destroy'])->middleware('auth');
Route::post('admin/product/{product}', [AdminProductController::class, 'update'])->middleware('auth');

Route::resource('admin/attribute', AttributeController::class)->middleware('auth');
Route::get('admin/attribute/{attribute}/delete', [AttributeController::class, 'destroy'])->middleware('auth');
Route::post('admin/attribute/{attribute}', [AttributeController::class, 'update'])->middleware('auth');

Route::resource('admin/user', UserController::class)->middleware('auth');
Route::get('admin/user/{user}/delete', [UserController::class, 'destroy'])->middleware('auth');
Route::post('admin/user/{user}', [UserController::class, 'update'])->middleware('auth');

Route::get('product', [ProductController::class, 'index']);
Route::get('product/{product}', [ProductController::class, 'show']);

Route::get('cart', [CartController::class, 'index'])->middleware('auth');
Route::post('add-to-cart', [CartController::class, 'add'])->middleware('auth');
Route::post('delete-from-cart', [CartController::class, 'remove'])->middleware('auth');
Route::post('checkout', [CartController::class, 'checkout'])->middleware('auth');


Auth::routes();
