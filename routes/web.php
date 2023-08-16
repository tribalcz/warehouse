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

// Produkty
Route::prefix('products')->group(function () {
    Route::get('/', [\App\Http\Controllers\Warehouse\ProductController::class, 'index'])->name('products.index');
    // Zobrazení formuláře pro vytvoření produktu
    Route::get('/create', [\App\Http\Controllers\Warehouse\ProductController::class, 'create'])->name('products.create')->middleware('check.dependencies');
    // Vytvoření nového produktu
    Route::post('/', [\App\Http\Controllers\Warehouse\ProductController::class, 'store'])->name('products.store');
    // Zobrazení formuláře pro úpravu produktu
    Route::get('/{product}/edit', [\App\Http\Controllers\Warehouse\ProductController::class, 'edit'])->name('products.edit');
    // Aktualizace produktu
    Route::put('/{product}', [\App\Http\Controllers\Warehouse\ProductController::class, 'update'])->name('products.update');
    // Zobrazení formuláře pro vytvoření varianty produktu
    Route::get('/{product}/variant', [\App\Http\Controllers\Warehouse\ProductController::class, 'createVariation'])->name('products.variant');
    // Aktualizace produktu
    Route::post('/variant', [\App\Http\Controllers\Warehouse\ProductController::class, 'storeVariant'])->name('products.store_variant');
    // Smazání produktu
    Route::delete('/{product}', [\App\Http\Controllers\Warehouse\ProductController::class, 'destroy'])->name('products.destroy');
});

// Dodavatelé
Route::prefix('suppliers')->group(function () {
    Route::get('/', [\App\Http\Controllers\Warehouse\SupplierController::class, 'index'])->name('suppliers.index');
    // Zobrazení formuláře pro vytvoření dodavatele
    Route::get('/create', [\App\Http\Controllers\Warehouse\SupplierController::class, 'create'])->name('suppliers.create');
    // Vytvoření nového dodavatele
    Route::post('/', [\App\Http\Controllers\Warehouse\SupplierController::class, 'store'])->name('suppliers.store');
    // Zobrazení formuláře pro úpravu dodavatele
    Route::get('/{supplier}/edit', [\App\Http\Controllers\Warehouse\SupplierController::class, 'edit'])->name('suppliers.edit');
    // Aktualizace dodavatele
    Route::put('/{supplier}', [\App\Http\Controllers\Warehouse\SupplierController::class, 'update'])->name('suppliers.update');
    // Smazání dodavatele
    Route::delete('/{supplier}', [\App\Http\Controllers\Warehouse\SupplierController::class, 'destroy'])->name('suppliers.destroy');
});

// Sklady
Route::prefix('warehouses')->group(function () {
    Route::get('/', [\App\Http\Controllers\Warehouse\WarehouseController::class, 'index'])->name('warehouses.index');
    // Zobrazení formuláře pro vytvoření skladu
    Route::get('/create', [\App\Http\Controllers\Warehouse\WarehouseController::class, 'create'])->name('warehouses.create')->middleware('check.dependencies');
    // Vytvoření nového skladu
    Route::post('/', [\App\Http\Controllers\Warehouse\WarehouseController::class, 'store'])->name('warehouses.store');
    // Zobrazení formuláře pro úpravu skladu
    Route::get('/{warehouse}/edit', [\App\Http\Controllers\Warehouse\WarehouseController::class, 'edit'])->name('warehouses.edit');
    // Aktualizace skladu
    Route::put('/{warehouse}', [\App\Http\Controllers\Warehouse\WarehouseController::class, 'update'])->name('warehouses.update');
    // Smazání skladu
    Route::delete('/{warehouse}', [\App\Http\Controllers\Warehouse\WarehouseController::class, 'destroy'])->name('warehouses.destroy');
});

// Výrobce
Route::prefix('manufacturers')->group(function () {
    Route::get('/', [\App\Http\Controllers\Warehouse\ManufacturerController::class, 'index'])->name('manufacturers.index');
    //Zobrazení formuláře pro vytvoření výrobce
    Route::get('/create', [\App\Http\Controllers\Warehouse\ManufacturerController::class, 'create'])->name('manufacturers.create');
    //Vytvoření nového výrobce
    Route::post('/', [\App\Http\Controllers\Warehouse\ManufacturerController::class, 'store'])->name('manufacturers.store');
    //Zobrazení formuláře pro úpravu výrobce
    Route::get('/{manufacturer}/edit', [\App\Http\Controllers\Warehouse\ManufacturerController::class, 'edit'])->name('manufacturers.edit');
    // Aktualizace výrobce
    Route::put('/{manufacturer}', [\App\Http\Controllers\Warehouse\ManufacturerController::class, 'update'])->name('manufacturers.update');
    // Smazání výrobce
    Route::delete('/{manufacturer}', [\App\Http\Controllers\Warehouse\ManufacturerController::class, 'destroy'])->name('manufacturers.destroy');
});
