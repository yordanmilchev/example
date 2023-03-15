<?php

if (!function_exists('res_file')) {

    function res_file($path, $protocol = null)
    {
        if ($protocol) {
            $urlRoot = $protocol .domain().'/';
        } else {
            $urlRoot = '//'.domain().'/';
        }

        if (App::environment('local')) {
            if(file_exists(public_path($path))) {
                $urlRoot = env('STORES_IMAGE_FILE_PATH').'/';
            }
        }

        return $urlRoot.$path;
    }
}

if (!function_exists('image_exists')) {

    function image_exists($pathToFile)
    {
       return file_exists(public_path($pathToFile));
    }
}
