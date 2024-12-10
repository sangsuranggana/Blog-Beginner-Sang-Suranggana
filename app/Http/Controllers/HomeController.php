<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class HomeController extends Controller
{
    public function index()
    {

        $search = request('search');
        $articles = Article::with('tags', 'category')
            ->latest()
            ->filter($search)
            ->paginate(10);

        return view('dashboard', compact('articles'));
    }
}
