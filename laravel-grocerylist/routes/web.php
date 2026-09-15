<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

Route::get('/items', [ItemController::class, 'index'])->name('items.index');

Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');

Route::post('/items', [ItemController::class, 'store'])->name('items.store');

Route::get('/items/{id}', function () {})->name('items.show');

Route::get('/items/{id}/edit', [ItemController::class, 'edit'])->name('items.edit');

Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');

Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');

// We voegen ook een redirect toe aan de routes die de hoofdpagina doorverwijst naar de '/items' route
Route::redirect('/', '/items');