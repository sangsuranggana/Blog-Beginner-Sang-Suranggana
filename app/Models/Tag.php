<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Tag extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_tags');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
