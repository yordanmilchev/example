<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if(strpos(\Route::current()->getName(), 'admin.') !== false) {

            return $next($request);
        }

        if(config('app.localization_method')=="domain") {
            $domainPartsArr =  explode(".", request()->getHost());
            $domainExtension = $domainPartsArr[count($domainPartsArr)-1];
            app()->setLocale($domainExtension);
        }
        //if app is running in debug environment
        else {
            if(session()->has('locale')) {
                app()->setLocale(session('locale'));
            }
            else {
                app()->setLocale(config('app.locale')); //use default locale
            }
        }

        //You could use the GET parameter locale="bg|ro|gr|..." to test and debug
        if(!empty(request()->query('locale'))) {
            app()->setLocale(request()->query('locale'));
        }

        //disable the website by locale
        if(in_array(app()->getLocale(), explode(',',env('DISABLED_LOCALES')))) {
            app()->abort(503, "Site maintenance. We'll be back soon!");
        }


        return $next($request);
    }
}
