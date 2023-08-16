<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function deleteImage(Request $request, $productId, $imagePath)
    {
        try{
            $product = Product::findOrFail($productId);
            $pathPrefix = 'product_images/' ;

            $image = $product->images()->where('path', $pathPrefix .$imagePath)->first();

            if($image) {
                $product->images()->detach($image->id);
                Storage::disk('public')->delete($pathPrefix . $imagePath);
                $image->delete();
            } else {
                return response()->json(['message' => 'Obrázek nebyl nalezen'], 404);
            }
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }

        return response()->json(['message' => 'Obrázek byl úspěšně odstraněn']);
    }
    //TODO: implementovat js do pohledu a routy
    public function increaseStock(Request $request, $productId)
    {
        try {
            $product = Product::findOrFail($productId);

            $request->validate([
                'qty' => 'required|integer|min:1',
            ]);

            $quantityToAdd = $request->input('qty');
            $product->qty += $quantityToAdd;
            $product->save();
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }

        return response()->json(['message' => 'Počet kusů na skladě byl navýšen o '. $quantityToAdd]);
    }
}
