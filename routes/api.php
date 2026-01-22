<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::post('/products', [ProductController::class, 'store']);
Route::get('/products/search/name/{name}', [ProductController::class, 'showByName']);
Route::delete('/products/{name}', [ProductController::class, 'destroy']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/search/category/{category}', [ProductController::class, 'showByCategory']);
Route::put('/products', [ProductController::class, 'update']);
