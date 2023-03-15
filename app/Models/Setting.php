<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Setting extends Model implements TranslatableContract
{
    use Translatable;

    protected $guarded = [];

    public $translatedAttributes = ['value_by_locale'];

    public $useTranslationFallback = false;
}
