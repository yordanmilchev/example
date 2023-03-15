<?php

namespace App\Http\Controllers\Admin;

use App\Constant\GalleryFileConstant;
use App\Http\Controllers\Controller;
use App\Models\Activity\Activity;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    public function index()
    {
        return view('admin.activities.list');
    }

    public function edit(Request $request)
    {
        if ($request->get('id')) {
            $activity = Activity::find($request->get('id'));
        } else {
            $activity = new Activity();
        }

        if ($request->method() == 'POST') {
            $rules = [
                '%title%' => 'required_with:%description%,%is_enabled%|string',
                'title:bg' => 'required',
                '%description%' => 'nullable|string',
                '%is_enabled' => 'nullable|boolean'
            ];

            $rules = RuleFactory::make($rules);
            $validator = \Validator::make(array_filter($request->all()), $rules);
            if ($validator->fails()) {
                $request->session()->flash('error', 'Записът не може да бъде осъществен !');
                return back()->withErrors($validator)->withInput($request->all());
            } else {
                $cleanData = $request->except([
                    'icon', 'image'
                ]);

                $activity->fill($cleanData);
                $activity->save();

                $iconFile = $request->file('icon');
                if ($iconFile) {
                    $fileName = $iconFile->getClientOriginalName();
                    $iconFile->move(GalleryFileConstant::GALLERY_FILE_DIRECTORIES[GalleryFileConstant::TYPE_ACTIVITY_IMAGE], $fileName);

                    $activity->icon = $fileName;
                    $activity->save();
                }

                $imageFile = $request->file('image');
                if ($imageFile) {
                    $fileName = $imageFile->getClientOriginalName();
                    $imageFile->move(GalleryFileConstant::GALLERY_FILE_DIRECTORIES[GalleryFileConstant::TYPE_ACTIVITY_IMAGE], $fileName);

                    $activity->image = $fileName;
                    $activity->save();
                }

                $request->session()->flash('success', 'Записът беше осъществен успешно !');

                return redirect(route('admin.activity.edit', ['id' => $activity->id]));
            }
        }

        return view('admin.activities.activity_edit', [
            'activity' => $activity,
        ]);
    }
}
