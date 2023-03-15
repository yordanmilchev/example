<?php

if (!function_exists('is_mobile')) {
    /**
     * Checks if browser is mobile
     *
     * @param $type
     * @return string
     */
    function is_mobile()
    {
        if(array_key_exists("HTTP_USER_AGENT",$_SERVER)) {
            return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
        }
        else {
            return 0;
        }
    }
}

if (!function_exists('is_local')) {
    /**
     * Checks if app is running in dev environment
     *
     * @return boolean
     */
    function is_local()
    {
        if (App::environment('local')) {
            return true;
        }
        else {
            return false;
        }
    }
}