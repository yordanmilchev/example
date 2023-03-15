<?php

if (!function_exists('setting_val')) {

    function setting_val($settingConstantKey, $locale=null)
    {
        $setting = \App\Models\Setting::with('translations')->where('setting_type', constant("\App\Constant\SettingConstant::$settingConstantKey"))->first();
        if(empty($setting)) {
            return null;
        }

        $translateToLocale = empty($locale) ? app()->getLocale() : $locale;
        $settingTranslation = $setting->translate($translateToLocale);
        if(!empty($settingTranslation) && !empty($settingTranslation->value_by_locale)) {
            return $settingTranslation->value_by_locale;
        }
        else {
            return $setting->setting_value;
        }
    }
}

if (!function_exists('setting')) {

    function setting($settingConstantKey)
    {
        return \App\Models\Setting::with('translations')->where('setting_type', constant("\App\Constant\SettingConstant::$settingConstantKey"))->first();
    }
}

if (!function_exists('put_env')) {

    function put_env($key, $value)
    {
        $path = app()->environmentFilePath();

        $escaped = preg_quote('='.env($key), '/');

        file_put_contents($path, preg_replace(
            "/^{$key}{$escaped}/m",
           "{$key}={$value}",
           file_get_contents($path)
        ));
    }
}
