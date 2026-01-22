<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::post('/products', [ProductController::class, 'store']);
Route::get('/products/search/{name}', [ProductController::class, 'showByName']);
Route::delete('/products/{name}', [ProductController::class, 'destroy']);
