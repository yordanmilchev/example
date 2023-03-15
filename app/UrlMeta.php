<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UrlMeta extends Model
{
    public static function getUrlNames($allUrls) {
        $allUrlNames = [];
        foreach ($allUrls as $id => $url) {
            $allUrlNames[$id] = $url->url_name;
        }

        return $allUrlNames;
    }
}
