<?php
namespace App\Components;

use App\Constant\GalleryFileConstant;
use App\Models\Activity\Activity;
use App\Models\Service\Service;
use Illuminate\Support\Facades\DB;

class FrontPageComponent
{

    public static function getEnabledServices()
    {
        return Service::select('*', 'service_translations.*', DB::raw('services.id as id'))
            ->join('service_translations', function ($join) {
                $join->on('services.id', '=', 'service_translations.service_id')
                    ->where('service_translations.locale', '=', locale());
                $join->where('service_translations.is_enabled', '=', 1);
            })
            ->orderBy('weight')
            ->get();
    }

    public static function getEnabledActivities()
    {
        return Activity::select('*', 'activity_translations.*', DB::raw('activities.id as id'))
            ->join('activity_translations', function ($join) {
                $join->on('activities.id', '=', 'activity_translations.activity_id')
                    ->where('activity_translations.locale', '=', locale());
                $join->where('activity_translations.is_enabled', '=', 1);
            })
            ->orderBy('weight')
            ->get();
    }
}
