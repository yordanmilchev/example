<?php

namespace App\Providers;

use UniSharp\LaravelFilemanager\LaravelFilemanagerServiceProvider;

class FilemanagerServiceProvider extends LaravelFilemanagerServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(resource_path('lang'), 'laravel-filemanager'); //copy en translations for each locale -> bg|ro|gr|...

        if (config('lfm.use_package_routes')) {
            \Route::group(['prefix' => 'filemanager', 'middleware' => ['web','can:manage_files']], function () {
                \UniSharp\LaravelFilemanager\Lfm::routes();
            });
        }
    }
}
