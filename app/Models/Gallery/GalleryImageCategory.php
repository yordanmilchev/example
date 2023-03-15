<?php

namespace App\Models\Gallery;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class GalleryImageCategory extends Model
{
    use Translatable;

    public $translatedAttributes = [
        'title', 'slug', 'is_enabled',
    ];

    public $guarded = [];

    public function files()
    {
        return $this->hasMany(GalleryImage::class);
    }

    public function getGalleryFiles()
    {
        return $this->files->sortBy('position');
    }
}
