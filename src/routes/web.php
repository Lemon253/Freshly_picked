<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;


Route::get('/products', [ItemController::class, 'index'])->name('products.index');
Route::get('/products/search', [ItemController::class, 'search'])->name('items.search');
Route::get('/products/{id}', [ItemController::class, 'item'])->name('item');
Route::put('/products/{id}/update', [ItemController::class, 'update'])->name('items.update');
Route::delete('/products/{id}/delete', [ItemController::class, 'destroy'])->name('items.destroy');
Route::get('/register', [ItemController::class, 'register']);
Route::post('/register', [ItemController::class, 'store'])->name('items.store');
