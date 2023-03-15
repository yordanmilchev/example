<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Constant\PageConstant;

class Page extends Model implements TranslatableContract
{
    use Translatable;

    protected $fillable = ['is_enabled', 'route_key', 'template'];

    public $translatedAttributes = [
        'title', 'slug', 'content'
    ];
}
