<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
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

    public function store(CreateCategoryRequest $request)
    {
        $validatedData = $request->validated();
        $data = [
            'name' => $validatedData['name'],
            'category_id' => $validatedData['parent_category'],
        ];

        $category = Category::create($data);

        return redirect()->route('categories.index')->with('success', 'Kategorie byla úspěšně vytvořena.');
    }

    public function edit(Category $category)
    {
        $categories = Category::whereNull('category_id')->get();
        return view('category.edit', compact('category', 'categories'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validatedData = $request->validated();
        $data = [
            'name' => $validatedData['name'],
            'category_id' => $validatedData['parent_category'],
        ];

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'Kategorie byla úspěšně upravena.');
    }

    public function destroy(Category $category)
    {

        try {
            $category->delete();
        } catch(\Exception $ex) {
            return redirect()->back()->with('error', 'Při procesu odstranění kategorie došlo k chybě.'.$ex->getMessage());
        }
        return redirect()->route('categories.index')->with('success', 'Kategorie byla úspěšně odstraněna.');
    }
}
