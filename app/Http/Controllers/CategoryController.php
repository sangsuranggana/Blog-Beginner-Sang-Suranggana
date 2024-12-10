<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest();

        if (request('search')) {
            $categories->where('name', 'like', '%' . request('search') . '%');
        }

        $categories = $categories->paginate(10);

        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $articles = $category->articles()->with('tags')->paginate(10);

        return view('categories.show', compact('articles', 'category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $category = Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('categories')->with('create', 'Kategori berhasil dibuat!');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        if ($request->name != $category->name) {
            $category->name = $request->name;
            $category->slug = null;
        }

        $category->save();

        return redirect()->route('categories')->with('edit', 'Kategori berhasil diubah');
    }

    public function destroy(Category $category)
    {
        Article::with('category')->delete();

        $category->delete();

        return redirect()->route('categories')->with('delete', 'Kategori berhasil dihapus!');
    }
}
