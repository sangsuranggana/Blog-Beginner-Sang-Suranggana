<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;

Route::get('/', [HomeController::class, 'index'])->name('dashboard');

Route::get('/about-us', function () {
    return view('aboutMe');
})->name('about-us');

Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/posts', [PostsController::class, 'index'])->name('posts');
    Route::get('/post/create', [PostsController::class, 'create'])->name('post.create');
    Route::get('/post/checkSlug', [PostsController::class, 'checkSlug'])->name('post.slug');
    Route::post('/post/store', [PostsController::class, 'store'])->name('post.store');
    Route::delete('/post/{article:slug}/delete', [PostsController::class, 'destroy'])->name('post.delete');
    Route::get('/post/{article:slug}/edit', [PostsController::class, 'edit'])->name('post.edit');
    Route::put('/post/{article:slug}/update', [PostsController::class, 'update'])->name('post.update');
    Route::get('/post/detail/{slug}', [PostsController::class, 'show'])->name('post');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/categories/posts/{category:slug}', [CategoryController::class, 'show'])->name('category.show');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/categories/{category}/update', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/categories/{category:slug}/delete', [CategoryController::class, 'destroy'])->name('category.delete');

    Route::get('/tags', [TagController::class, 'index'])->name('tags');
    Route::get('/tags/posts/{tag:slug}', [TagController::class, 'show'])->name('tags.show');
    Route::get('/get-tags', [TagController::class, 'getTag']);
    Route::post('/tags/store', [TagController::class, 'store'])->name('tag.store');
    Route::put('/tags/{tag}/update', [TagController::class, 'update'])->name('tag.update');
    Route::delete('/tags/{tag:slug}/delete', [TagController::class, 'destroy'])->name('tag.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
