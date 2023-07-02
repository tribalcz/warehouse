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

    public function createVariation($productId)
    {
        $product = Product::select('id','name', 'description', 'content', 'price', 'weight')->findOrFail($productId);
        $product->title = $product->name;
        unset($product->name);
        unset($product->id);

        $suppliers = Supplier::select('id', 'name')->get();
        $warehouses = Warehouse::select('id', 'address')->get();

        return view('product.variant', compact('product', 'suppliers', 'warehouses'));

    }

    public function storeVariant(CreateProductRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['isVariant'] = 1;

        $product = Product::create($validatedData);
        $product->warehouses()->sync($request->input('warehouses', []));

        return redirect()->route('products.index')->with('success', 'Produkt byl úspěšně vytvořen.');
    }

    public function destroy(Product $product)
    {
        try {
            $product->warehouses()->detach();
            $product->images()->each(function ($image) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            });
            $product->delete();
        } catch(\Exception $ex) {
            return redirect()->back()->with('error', 'Při procesu odstranění produktu došlo k chybě.');
        }

        return redirect()->route('products.index')->with('success', 'Produkt byl úspěšně smazán.');
    }
}
