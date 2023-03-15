<?php

if (!function_exists('gallery_image')) {

    function gallery_image($fileName, $imageType, $styleType, $width = null, $height = null, $protocol = null, $compressed = false, $manipulation = \Spatie\Image\Manipulations::FIT_FILL)
    {

        $path = \App\Constant\GalleryFileConstant::GALLERY_STYLES[$styleType][$imageType].$fileName;

        if ($protocol) {
            $urlRoot = $protocol .domain().'/';
        } else {
            $urlRoot = $protocol . '/';
        }


        if (!\File::exists(public_path($path))) {
            $originalFile = public_path(\App\Constant\GalleryFileConstant::GALLERY_FILE_DIRECTORIES[$imageType]).$fileName;
            if (file_exists($originalFile)) {
                $pathToSave = public_path(\App\Constant\GalleryFileConstant::GALLERY_STYLES[$styleType][$imageType]);
                if (!file_exists($pathToSave)) {
                    mkdir($pathToSave, 0777, true);
                }
                $saveWorker = \Spatie\Image\Image::load($originalFile)
                    ->background('ffffff')
                    ->optimize();

                if ($compressed) {
                    $saveWorker->quality(75);
                }

                if (!empty($width) && !empty($height)) {
                    $saveWorker->fit($manipulation, $width, $height);
                }

                $saveWorker->save($pathToSave.$fileName);

//                $urlRoot = env('APP_URL') . '/';
            } else {
                // do nothing
            }
        } else {
            //$urlRoot = env('APP_URL') . '/';
        }

        return $urlRoot.$path;
    }
}

