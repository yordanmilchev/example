<?php

namespace App\Http\Controllers\Admin;

use App\Constant\GalleryFileConstant;
use App\Http\Controllers\Controller;
use App\Models\Service\Service;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return view('admin.services.list');
    }

    public function edit(Request $request)
    {
        if ($request->get('id')) {
            $service = Service::find($request->get('id'));
        } else {
            $service = new Service();
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
                    'image',
                ]);

                $service->fill($cleanData);
                $service->save();

                $imageFile = $request->file('image');
                if ($imageFile) {
                    $fileName = $imageFile->getClientOriginalName();
                    $imageFile->move(GalleryFileConstant::GALLERY_FILE_DIRECTORIES[GalleryFileConstant::TYPE_SERVICE_IMAGE], $fileName);

                    $service->image = $fileName;
                    $service->save();
                }

                $request->session()->flash('success', 'Записът беше осъществен успешно !');

                return redirect(route('admin.service.edit', ['id' => $service->id]));
            }
        }

        return view('admin.services.service_edit', [
            'service' => $service,
        ]);
    }
}
