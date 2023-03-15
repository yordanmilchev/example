<?php

namespace App\Http\Controllers;

use App\Components\BreadcrumbComponent;
use App\Models\Gallery\GalleryImage;
use App\Models\Gallery\GalleryImageCategory;
use Illuminate\Http\Request;

class GalleryImagesController extends Controller
{
    public function index()
    {
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

        return view('front.gallery', [
            'imageFiles' => $imageFiles,
        ]);
    }
}
