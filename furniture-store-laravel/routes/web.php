<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'allProducts']);

Route::get('/product/{id}', [ProductController::class, 'individualProduct']);

Route::get('/in-stock', [ProductController::class, 'inStockProducts']);

