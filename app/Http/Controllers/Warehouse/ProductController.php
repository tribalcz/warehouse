<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Manufacturer;
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
        $manufacturers = Manufacturer::select('id', 'name')->get();
        $suppliers = Supplier::select('id', 'name')->get();
        $warehouses = Warehouse::select('id', 'address')->get();
        $categories = Category::whereNull('category_id')->get();
        return view('product.create', compact('suppliers', 'warehouses', 'manufacturers', 'categories'));
    }

    public function store(CreateProductRequest $request)
    {
        $validatedData = $request->validated();
        $data = $validatedData;
        unset($data['images']);

        $product = Product::create($data);
        $product->warehouses()->sync($request->input('warehouses', []));
        $product->manufacturers()->sync($request->input('manufacturer_id'));
        $product->categories()->sync($request->input('category_id', []));

        if ($request->hasFile('images')) {
            $this->saveImages($product, $request->file('images'));
        }

        return redirect()->route('products.index')->with('success', 'Produkt byl úspěšně vytvořen.');
    }

    public function edit(Product $product)
    {
        $manufacturers = Manufacturer::select('id', 'name')->get();
        $suppliers = Supplier::select('id', 'name')->get();
        $warehouses = Warehouse::select('id', 'address')->get();
        $categories = Category::whereNull('category_id')->get();
        return view('product.edit', compact('product', 'suppliers', 'warehouses', 'manufacturers', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();

        $product->update($validatedData);
        $product->warehouses()->sync($request->input('warehouses', []));
        $product->manufacturers()->sync($request->input('manufacturer_id'));
        $product->categories()->sync($request->input('category_id', []));

        $existingImages = $product->images->pluck('id')->toArray();

        if ($request->hasFile('images')) {
            $newImageIds = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                $imageModel = new Image();
                $imageModel->path = $path;
                $imageModel->save();
                $newImageIds[] = $imageModel->id;
            }
            $product->images()->attach($newImageIds);
        }

        $product->images()->syncWithoutDetaching($existingImages);

        return redirect()->route('products.index')->with('success', 'Produkt byl úspěšně upraven.');
    }

    public function createVariation($productId)
    {
        $product = Product::select('id','name', 'description', 'content', 'price', 'weight')->findOrFail($productId);
        $product->title = $product->name;
        unset($product->name);
        unset($product->id);

        $manufacturers = Manufacturer::select('id', 'name')->get();
        $suppliers = Supplier::select('id', 'name')->get();
        $warehouses = Warehouse::select('id', 'address')->get();
        $categories = Category::whereNull('category_id')->get();

        return view('product.variant', compact('product', 'suppliers', 'warehouses', 'manufacturers', 'categories'));

    }

    public function storeVariant(CreateProductRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['isVariant'] = 1;
        $data = $validatedData;
        unset($data['images']);

        $product = Product::create($data);
        $product->warehouses()->sync($request->input('warehouses', []));
        $product->manufacturers()->sync($request->input('manufacturer_id'));
        $product->categories()->sync($request->input('category_id', []));

        if($request->hasFile('images')) {
            $this->saveImages($product, $request->file('images'));
        }

        return redirect()->route('products.index')->with('success', 'Produkt byl úspěšně vytvořen.');
    }

    public function destroy(Product $product)
    {
        try {
            $product->warehouses()->detach();
            $product->category()->detach();
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

    private function saveImages(Product $product, array $images)
    {
        $imageIds = [];
        foreach ($images as $image) {
            $path = $image->store('product_images', 'public');
            $imageModel = new Image();
            $imageModel->path = $path;
            $imageModel->save();
            $imageIds[] = $imageModel->id;
        }
        $product->images()->sync($imageIds);


    }
}
