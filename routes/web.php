<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\Administration\DashboardController::class, 'index'])->name('dashboard');

//Produkty
Route::get('/products', [\App\Http\Controllers\Warehouse\ProductController::class, 'index'])->name('product.index');
// Zobrazení formuláře pro vytvoření produktu
Route::get('/products/create', [\App\Http\Controllers\Warehouse\ProductController::class, 'create'])->name('products.create');
// Vytvoření nového produktu
Route::post('/products', [\App\Http\Controllers\Warehouse\ProductController::class, 'store'])->name('products.store');
// Zobrazení formuláře pro úpravu produktu
Route::get('/products/{product}/edit', [\App\Http\Controllers\Warehouse\ProductController::class, 'edit'])->name('products.edit');
// Aktualizace produktu
Route::put('/products/{product}', [\App\Http\Controllers\Warehouse\ProductController::class, 'update'])->name('products.update');
// Smazání produktu
Route::delete('/products/{product}', [\App\Http\Controllers\Warehouse\ProductController::class, 'destroy'])->name('products.destroy');

//Dodavatelé
Route::get('/suppliers', [\App\Http\Controllers\Warehouse\SupplierController::class, 'index'])->name('suppliers.index');
//Zobrazení formuláře pro vytvoření dodavatele
Route::get('/suppliers/create', [\App\Http\Controllers\Warehouse\SupplierController::class, 'create'])->name('suppliers.create');
//Vytvoření nového dodavatele
Route::post('/suppliers', [\App\Http\Controllers\Warehouse\SupplierController::class, 'store'])->name('suppliers.store');
//Zobrazení formuláře pro úpravu dodavatele
Route::get('/suppliers/{supplier}/edit', [\App\Http\Controllers\Warehouse\SupplierController::class, 'edit'])->name('suppliers.edit');
//Aktualizace dodavatele
Route::put('/suppliers/{supplier}', [\App\Http\Controllers\Warehouse\SupplierController::class, 'update'])->name('suppliers.update');
//smazání dodavatele
Route::delete('/suppliers/{supplier}', [\App\Http\Controllers\Warehouse\SupplierController::class, 'destroy'])->name('suppliers.destroy');

//sklady
Route::get('/warehouses', [\App\Http\Controllers\Warehouse\WarehouseController::class, 'index'])->name('warehouses.index');
//Zobrazení formuláře pro vytvoření skladu
Route::get('/warehouses/create', [\App\Http\Controllers\Warehouse\WarehouseController::class, 'create'])->name('warehouses.create');
//Vytvoření nového skladu
Route::post('/warehouses', [\App\Http\Controllers\Warehouse\WarehouseController::class, 'store'])->name('warehouses.store');
//Zobrazení formuláře pro úpravu skladu
Route::get('/warehouses/{warehouse}/edit', [\App\Http\Controllers\Warehouse\WarehouseController::class, 'edit'])->name('warehouses.edit');
//Aktualizace skladu
Route::put('/warehouses/{warehouse}', [\App\Http\Controllers\Warehouse\WarehouseController::class, 'update'])->name('warehouses.update');
//Smazání skladu
Route::delete('/warehouses/{warehouse}', [\App\Http\Controllers\Warehouse\WarehouseController::class, 'destroy'])->name('warehouses.destroy');

