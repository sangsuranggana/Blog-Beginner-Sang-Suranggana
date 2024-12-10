<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Article extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'full_text',
        'excerpt',
        'image',
        'user_id',
        'category_id'
    ];

    public $timestamps = true;

    public function scopeFilter($query, $search)
    {
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('full_text', 'like', '%' . $search . '%');
        }

        return $query;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
