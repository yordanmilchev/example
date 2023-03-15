<?php

namespace App\Http\Controllers;

use App\Constant\CacheTagConstant;
use App\Models\Page\Page;
use App\Constant\PageConstant;
use Illuminate\Support\Facades\Cache;


class PageController extends Controller
{
    public function show($slug)
    {
        $cacheKey = locale().'_page_'.md5($slug);

        // retrieve  the page from cache if key exists
        if (Cache::tags(CacheTagConstant::PAGES)->has($cacheKey)) {
            $viewParams = Cache::tags(CacheTagConstant::PAGES)->get($cacheKey);
        } else {
            $page = Page::with('translations')
                ->whereTranslationLike('slug', $slug)
                ->where('is_enabled', 1)
                ->firstOrFail();

            $pageTranslated = $page->translate(locale());

            $viewParams = [
                'templateName' => $page->template,
                'content' => $pageTranslated,
            ];

            Cache::tags(CacheTagConstant::PAGES)->put($cacheKey, $viewParams); // will be stored indefinitely
        }

        return view(PageConstant::getTemplatePath($viewParams['templateName']), ['content'=>$viewParams['content']]);
    }
}
