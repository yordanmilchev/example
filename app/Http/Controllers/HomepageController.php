<?php

namespace App\Http\Controllers;

use App\Models\Activity\Activity;
use App\Models\Gallery\GalleryImageCategory;
use App\Models\Homepage\Partner;
use App\Models\Homepage\Slider;
use App\Models\Service\Service;

class HomepageController extends Controller
{
    public function show()
    {
        $sliders = Slider::where('is_enabled', 1)
            ->orderBy('weight')
            ->get();

        $partners = Partner::orderBy('position')->get();

        $gallery = GalleryImageCategory::with('translations')
            ->whereHas('translations', function ($query) {
                $query->where('locale', '=', locale());
                $query->where('is_enabled', 1);
            })->first();

        if (isset($gallery)) {
            $imageFiles = $gallery->files()
                ->orderBy('position')
                ->paginate(38);
        } else {
            $imageFiles = [];
        }


        return view('front.homepage', [
            'sliders' => $sliders,
            'partners' => $partners,
            'imageFiles' => $imageFiles,
        ]);
    }

    public function showService($slug)
    {
        $service = Service::with('translations')
            ->whereTranslation('slug', $slug)
            ->firstOrFail();

        return view('front.service', [
            'service' => $service,
        ]);
    }

    public function showActivity($slug)
    {
        $activity = Activity::with('translations')
            ->whereTranslation('slug', $slug)
            ->firstOrFail();

        return view('front.activity', [
            'activity' => $activity,
        ]);
    }
}
