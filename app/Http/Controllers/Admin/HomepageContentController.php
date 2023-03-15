<?php

namespace App\Http\Controllers\Admin;

use App\Constant\GalleryFileConstant;
use App\Http\Controllers\Controller;
use App\Models\Homepage\Partner;
use App\Models\Homepage\Slider;
use App\Utilities\FilePathManager;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomepageContentController extends Controller
{
    public function sliderList()
    {
        return view('admin.homepage.sliders_list');
    }

    public function sliderEdit(Request $request)
    {
        if (empty($request->get('id'))) {
            $slider = new Slider();
        } else {
            $slider = Slider::findOrFail($request->get('id'));
        }

        if ($request->method() == 'POST') {
            $cleanData = $request->except([
                'image', 'mobile_image',
            ]);
            $slider->fill($cleanData);
            $slider->save();

            $uploadFile = $request->file('image');
            if ($uploadFile) {
                $fileName = $uploadFile->getClientOriginalName();
                $uploadFile->move(GalleryFileConstant::GALLERY_FILE_DIRECTORIES[GalleryFileConstant::TYPE_SLIDER_IMAGE], $fileName);

                $slider->image = $fileName;
                $slider->save();
            }

            $uploadFileMobile = $request->file('mobile_image');
            if ($uploadFileMobile) {
                $fileNameMobile = $uploadFileMobile->getClientOriginalName();
                $uploadFileMobile->move(GalleryFileConstant::GALLERY_FILE_DIRECTORIES[GalleryFileConstant::TYPE_SLIDER_IMAGE], $fileNameMobile);

                $slider->mobile_image = $fileNameMobile;
                $slider->save();
            }

            $request->session()->flash('success', 'Записът беше осъществен успешно !');

            return redirect()->route('admin.homepage.slider.edit', ['id' => $slider->id]);
        }

        $request->flash();

        return view('admin.homepage.slider_edit', [
            'slider' => $slider,
        ]);
    }

    public function partners()
    {
        return view('admin.homepage.partners', [
            'partners' => Partner::orderBy('position')->get(),
        ]);
    }

    public function uploadFile(Request $request)
    {
        $partnerFileId = $request->get('partner_file_id');
        $uploadDirectory = public_path('/'.GalleryFileConstant::GALLERY_FILE_DIRECTORIES[GalleryFileConstant::TYPE_PARTNER_IMAGE]);

        $uploadedFile = $request->imagefile;
        if ($partnerFileId) {
            $partnerFile = Partner::find($partnerFileId);
            try {
                unlink($uploadDirectory.$partnerFile->name);
            } catch (\Exception $e) {
                // do nothing
            }

        } else {
            $partnerFile = new Partner();
        }

        $rules = array('file' => 'mimes:png,gif,jpeg,jpg|max:10240');
        $validator = \Validator::make(array('file'=> $uploadedFile), $rules);
        if($validator->passes()){
            $fileName = FilePathManager::generateFileName($uploadedFile->getClientOriginalName());
            $uploadedFile->move($uploadDirectory, $fileName);
            $partnerFile->name = $fileName;
            $partnerFile->save();
        } else {
            return ['error' => 'Неуспешно качване на файл. Нужно е да бъде : png,gif,jpeg или jpg'];
        }

        return ['partner_id' => $partnerFile->id];
    }

    public function savePartners(Request $request)
    {
        $alreadyPresentFiles = Partner::orderBy('position')
            ->get()
            ->keyBy('id');

        $uploadDirectory = public_path('/'.GalleryFileConstant::GALLERY_FILE_DIRECTORIES[GalleryFileConstant::TYPE_PARTNER_IMAGE]);

        foreach ($request['partner_images'] as $file) {
            $fileId = $file['id'] ?? null;
            if ($fileId) {
                $isAlreadyPresent = isset($alreadyPresentFiles[$fileId]);
                if ($isAlreadyPresent) {
                    $galleryFile = $alreadyPresentFiles[$fileId];
                    unset($alreadyPresentFiles[$fileId]);
                } else {
                    $galleryFile = Partner::find($fileId);
                }
                $galleryFile->link = $file['link'];
                $galleryFile->position = $file['position'] ?? 1;

                $galleryFile->save();
            }
        }

        // delete files and galleryFile objects that are set for deletion
        if (count($alreadyPresentFiles)) {
            foreach ($alreadyPresentFiles as $fileToBeDeleted) {
                if (\File::exists($uploadDirectory.$fileToBeDeleted->name)) {
                    try {
                        unlink($uploadDirectory.$fileToBeDeleted->name);
                    } catch (\Exception $e) {
                        Log::info($e);
                    }
                }
                $fileToBeDeleted->delete();
            }
        }

        $request->session()->flash('success', 'Записът беше осъществен успешно !');

        return redirect(route('admin.homepage.partners'));
    }
}
