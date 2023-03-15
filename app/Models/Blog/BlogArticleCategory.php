<?php

namespace App\Models\Blog;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class BlogArticleCategory extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = [
        'title', 'slug', 'description', 'is_enabled',
    ];

    public $guarded = [];
}
