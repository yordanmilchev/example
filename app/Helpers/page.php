<?php

if (!function_exists('page_url')) {

    /**
     * page_url
     * @example  <a href="{{page_url('politika_za_zashtita_na_lichnite_danni')}}">{{trans('Политика за защита на лични данни')}}</a>
     */
    function page_url($routeKey)
    {
        return \App\Services\Page::getUrl($routeKey);
    }
}
