<?php

namespace App\Services;

use App\Constant\CacheTagConstant;
use App\Constant\PageConstant;
use Illuminate\Support\Facades\Cache;

class Page
{
    public static $allPages = [];
    public static function getUrl($routeKey)
    {
        if (empty(self::$allPages)) {
            self::$allPages = \App\Models\Page\Page::where('is_enabled',1)->with('translations')->get()->keyBy('route_key');
        }

        $cacheKey = locale().'_page_url_'.$routeKey;
        if (Cache::tags(CacheTagConstant::PAGES)->has($cacheKey)) { //get the url from cache if key exists
            return Cache::tags(CacheTagConstant::PAGES)->get($cacheKey);
        }

        // If page is not stored in cache
        $page = isset(self::$allPages[$routeKey]) ? self::$allPages[$routeKey] : null;

        if(empty($page)) {
            $resultUrl = '#PAGE_NOT_FOUND';
        } else {
            $pageTranslated = $page->translate(locale());

            if(empty($pageTranslated) || (!empty($pageTranslated) && (empty($pageTranslated->slug) || empty($pageTranslated->title)))) {
                $resultUrl = '#PAGE_NOT_TRANSLATED';
            } else {
                $resultUrl = route('page', ['slug'=>$pageTranslated->slug]);
            }
        }

        Cache::tags(CacheTagConstant::PAGES)->put($cacheKey, $resultUrl); //will be stored indefinitely

        return $resultUrl;
    }
}
