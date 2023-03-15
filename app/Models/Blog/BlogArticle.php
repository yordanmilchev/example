<?php

namespace App\Models\Blog;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Model;

class BlogArticle extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = [
        'title', 'slug', 'body', 'is_enabled', 'excerpt', 'meta_description'
    ];

    public $guarded = [];

    public function categories() {
        return $this->belongsToMany(BlogArticleCategory::class, 'blog_article_category');
    }

    public function hasCategoryById($categoryId)
    {
        return $this->categories->contains('id', $categoryId);
    }

    public function edited()
    {
        return $this->hasMany(BlogArticleEditLog::class);
    }
}
