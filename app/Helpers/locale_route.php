<?php

if (!function_exists('locale_route')) {
    function locale_route($url, $locale)
    {
        $urlParts = parse_url($url);
        if(config('app.localization_method')=="domain") {
            $originalRoot = request()->root();
            $urlRootPartsArr = explode(".", $originalRoot);
            $urlRootPartsArr[count($urlRootPartsArr)-1] = $locale;
            $localizedRoot = implode(".", $urlRootPartsArr);
            $url = str_replace($originalRoot,$localizedRoot,$url);
            return $url;
        } else {
            return $url;
        }
    }
}
