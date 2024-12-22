<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Article;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::insert([
            [
                'name' => 'Surangga',
                'email' => 'surangga@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maulana',
                'email' => 'maulana@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seeder untuk tabel categories  
        $categories = Category::insert([
            [
                'name' => 'Technology',
                'slug' => Str::slug('Technology'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Health',
                'slug' => Str::slug('Health'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lifestyle',
                'slug' => Str::slug('Lifestyle'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seeder untuk tabel tags  
        $tags = Tag::insert([
            [
                'name' => 'PHP',
                'slug' => Str::slug('PHP'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Laravel',
                'slug' => Str::slug('Laravel'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Health Tips',
                'slug' => Str::slug('Health Tips'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seeder untuk tabel articles  
        $articles = Article::insert([
            [
                'title' => 'Introduction to PHP',
                'slug' => Str::slug('Introduction to PHP'),
                'full_text' => 'PHP is a popular general-purpose scripting language...',
                'excerpt' => 'An introduction to PHP.',
                'image' => 'path/to/image.jpg',
                'user_id' => 1, // ID user yang sesuai  
                'category_id' => 1, // ID kategori yang sesuai  
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Health Benefits of Yoga',
                'slug' => Str::slug('Health Benefits of Yoga'),
                'full_text' => 'Yoga is an ancient practice that offers numerous health benefits...',
                'excerpt' => 'Exploring the benefits of yoga.',
                'image' => 'path/to/image2.jpg',
                'user_id' => 2, // ID user yang sesuai  
                'category_id' => 2, // ID kategori yang sesuai  
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seeder untuk tabel article_tags  
        DB::table('article_tags')->insert([
            [
                'article_id' => 1, // ID artikel yang sesuai  
                'tag_id' => 1, // ID tag yang sesuai  
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'article_id' => 1,
                'tag_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'article_id' => 2,
                'tag_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
