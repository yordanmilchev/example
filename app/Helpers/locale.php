<?php

if (!function_exists('locale')) {

    /**
     * locale - get or set locale
     *
     * @param  mixed $lang
     * @return string|void
     */
    function locale($lang = null)
    {
        if(empty($lang)) {
            return app()->getLocale();
        }
        else {
            app()->setLocale($lang);
        }
    }
}


if (!function_exists('locales')) {

    /**
     * locales - return all app locales in array
     * @return array example: ['bg', 'ro', 'gr']
     */
    function locales()
    {
        return array_keys(config('app.locales'));
    }
}

if (!function_exists('country')) {

    /**
     * country - return country by current locale or locale set in param
     * @return array example: ['bg', 'ro', 'gr']
     */
    function country($locale=null)
    {
        if(empty($locale)) {
            return config('app.locales')[locale()];
        }
        else {
            return config('app.locales')[$locale];
        }
    }
}


if (!function_exists('currency')) {

    /**
     * currency - returns the currency for current locale
     * @param (optional) string values: 'iso'
     * @return string
     */
    function currency($asIso=null)
    {
        if(empty($asIso)) {
            return config('app.currencies')[locale()]; //returns 'лв.', '€', ...
        }
        else {
            return config('app.currencies_iso')[locale()]; //returns BGN, EUR, ...
        }
    }
}

if (!function_exists('domain')) {
    function domain()
    {
        return config('app.domains')[locale()];
    }
}

if (!function_exists('domain_by_locale')) {
    function domain_by_locale($locale)
    {
        $urlRootPartsArr = explode(".", request()->root()); //request()->root() i.e.:
        $urlRootPartsArr[count($urlRootPartsArr)-1] = $locale;
        return config('app.domains')[$locale];
    }
}
