<?php

namespace App\Models\Service;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Service extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = [
        'title', 'slug', 'excerpt', 'description', 'is_enabled'
    ];

    public $guarded = [];

    /**
     * Override weight mutator
     * @param $value
     */
    public function setWeightAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['weight'] = $value;
        } else {
            $this->attributes['weight'] = 9;
        }
    }
}
