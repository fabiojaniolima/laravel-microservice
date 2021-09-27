<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::paginate(25);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'is_active' => 'boolean',
            'description' => 'string',
        ]);

        return Category::create($request->all());
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'string',
            'is_active' => 'boolean',
            'description' => 'string',
        ]);

        $category->update($request->all());

        return response()->noContent();
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->noContent();
    }
}
