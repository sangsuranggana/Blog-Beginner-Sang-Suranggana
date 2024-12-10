<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Tag;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function index()
    {
        $articles = Article::with('tags', 'category')->where('user_id', auth()->id())->latest();

        if (request('search')) {
            $articles->where('title', 'like', '%' . request('search') . '%');
        }

        $articles = $articles->paginate(10);

        return view('posts.index', compact('articles'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        return view('posts.post', compact('article'));
    }

    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('posts.create', compact('tags', 'categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:articles',
            'category_id' => 'required',
            'image' => 'image|file|max:8192',
            'full_text' => 'required',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);
        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-image', 'public');
        }
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->full_text), 450, '...');
        $article = Article::create($validatedData);

        if ($request->tags) {
            $article->tags()->attach($request->tags);
        }

        return redirect()->route('posts')->with('create', 'Artikel berhasil dibuat!');
    }

    public function edit(Article $article)
    {
        return view('posts.edit', [
            'article' => $article,
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, Article $article)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:8192',
            'full_text' => 'required',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ];

        if ($request->slug != $article->slug) {
            $rules['slug'] = 'required|unique:articles';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-image', 'public');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->full_text), 450, '...');
        $article->update($validatedData);

        if ($request->tags) {
            $article->tags()->sync($request->tags); // Menggunakan sync untuk memperbarui tag  
        } else {
            $article->tags()->detach(); // Hapus semua tag jika tidak ada yang dipilih  
        }

        return redirect()->route('posts')->with('edit', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Article $article)
    {
        if ($article->image) {
            Storage::delete($article->image);
        }

        Article::destroy($article->id);
        return redirect()->route('posts')->with('delete', 'Artikel berhasil dihapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Article::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
