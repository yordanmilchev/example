<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;

class CacheController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('manage_system');

        if(!empty($request->cache_clear)) {
            if($request->cache_clear=="clear_all") {
                Cache::flush(); //clear all tags
                Artisan::call('optimize');
            }
            else if($request->cache_clear=="clear_cache_driver") {
                Cache::flush(); //clear all tags
                Artisan::call('cache:clear');
            }
            else if($request->cache_clear=="clear_views_cache") {
                Artisan::call('view:clear');
            }
            else if($request->cache_clear=="clear_route_cache") {
                Artisan::call('route:clear');
            }
            else if($request->cache_clear=="clear_config_cache") {
                Artisan::call('config:clear');
            }
            else {
                Cache::tags($request->cache_clear)->flush(); // clear by tag
            }

            return response()->json(true);
        }

        return response()->json(false);
    }
}
