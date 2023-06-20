<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Warehouse;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(10);
        return view('product.index', compact('products'));
    }

    public function create()
    {
        $suppliers = Supplier::select('id', 'name')->get();
        $warehouses = Warehouse::select('id', 'address')->get();
        return view('product.create', compact('suppliers', 'warehouses'));
    }

    public function store(CreateProductRequest $request)
    {
        $validatedData = $request->validated();

        $product = Product::create($validatedData);

        return redirect()->route('product.index')->with('success', 'Produkt byl úspěšně vytvořen.');
    }

    public function edit(Product $product)
    {
        $suppliers = Supplier::select('id', 'name')->get();
        $warehouses = Warehouse::select('id', 'address')->get();
        return view('product.edit', compact('product', 'suppliers', 'warehouses'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();

        $product->update($validatedData);

        return redirect()->route('product.index')->with('success', 'Produkt byl úspěšně upraven.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Produkt byl úspěšně smazán.');
    }
}
