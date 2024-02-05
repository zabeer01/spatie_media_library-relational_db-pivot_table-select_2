<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;


//products
Route::post('/upload-file', [ProductController::class, 'uploadFile'])->name('upload.file');
Route::post('products/media', [ProductController::class, 'storeMedia'])->name('products.storeMedia');
Route::post('/products/delete-media', [ProductController::class, 'deleteMedia'])->name('products.deleteMedia');
Route::resource('products', ProductController::class);

//category
Route::resource('categories', CategoryController::class);
