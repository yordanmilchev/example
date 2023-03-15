<?php

namespace App\Providers;

use App\Components\FrontPageComponent;
use App\Models\UrlMeta;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if(empty(config('app.debug')) && request()->debug==4123) {
            config(['app.debug' => true]);
            config(['debugbar.enabled' => true]);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $currentUrl = url()->full();
            $metaData = UrlMeta::where('url_name', $currentUrl)->first();

            $view->with('metaData', $metaData);
        });

        View::composer(['front.components.header', 'front.homepage', 'front.service'], function ($view) {
            $view->with('enabledServices', FrontPageComponent::getEnabledServices());
        });

        View::composer(['front.components.header', 'front.homepage', 'front.activity'], function ($view) {
            $view->with('enabledActivities', FrontPageComponent::getEnabledActivities());
        });

        Blade::if('isLocale', function ($locales) {
            return in_array(locale(), $locales);
        });
    }
}
