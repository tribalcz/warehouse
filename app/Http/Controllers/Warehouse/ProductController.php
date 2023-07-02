<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Image;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Storage;

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
        $databaseData = $validatedData;
        unset($databaseData['images']);

        //dd($request->file('images'));

        $product = Product::create($databaseData);
        $product->warehouses()->sync($request->input('warehouses', []));

        if ($request->hasFile('images')) {
            $imageIds = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                $imageModel = new Image();
                $imageModel->path = $path;
                $imageModel->save();
                $imageIds[] = $imageModel->id;
            }
            $product->images()->sync($imageIds);
        }

        return redirect()->route('products.index')->with('success', 'Produkt byl úspěšně vytvořen.');
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
        $product->warehouses()->sync($request->input('warehouses', []));

        return redirect()->route('products.index')->with('success', 'Produkt byl úspěšně upraven.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produkt byl úspěšně smazán.');
    }
}
