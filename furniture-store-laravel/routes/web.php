<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CategoryController::class, 'index']);

Route::get('/products', [ProductController::class, 'allProducts']);

Route::get('/product/{id}', [ProductController::class, 'individualProduct']);

Route::get('/in-stock', [ProductController::class, 'inStockProducts']);

