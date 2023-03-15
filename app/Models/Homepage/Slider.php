<?php

namespace App\Models\Homepage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
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
