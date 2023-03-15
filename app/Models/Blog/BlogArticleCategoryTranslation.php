<?php

namespace App\Models\Blog;

use App\Traits\TranslationsSave;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class BlogArticleCategoryTranslation extends Model
{
    use HasSlug;
    use TranslationsSave;

    public $guarded = [];

    public static $requiredFieldsForSave = ['title'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }
}
