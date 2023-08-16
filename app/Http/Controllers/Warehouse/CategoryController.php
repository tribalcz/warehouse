<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('category_id')->get();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::whereNull('category_id')->get();
        return view('category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'parent_category' => 'nullable|exists:categories,id',
        ]);

        $category = new Category();
        $category->name = $validatedData['name'];
        $category->category_id = $validatedData['parent_category'];
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Kategorie byla úspěšně vytvořena.');
    }

    public function edit(Category $category)
    {
        $categories = Category::whereNull('category_id')->get();
        return view('category.edit', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
            'parent_category' => 'nullable|exists:categories,id',
        ]);

        $category->name = $validatedData['name'];
        $category->category_id = $validatedData['parent_category'];
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Kategorie byla úspěšně upravena.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategorie byla úspěšně odstraněna.');
    }
}
