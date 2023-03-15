<?php

namespace App\Http\Controllers\Admin;

use App\Constant\GalleryFileConstant;
use App\Constant\GalleryImageConstant;
use App\Http\Controllers\Controller;
use App\Models\Gallery\GalleryImage;
use App\Models\Gallery\GalleryImageCategory;
use App\Utilities\FilePathManager;
use App\Utilities\TreeBuilder;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GalleryImageController extends Controller
{
    public function index()
    {
        $categories = GalleryImageCategory::orderBy('weight', 'asc')->get()->toArray();

        $categoriesTree = TreeBuilder::buildTree($categories);

        return view('admin.gallery.categories_list', [
            'categoriesTree' => $categoriesTree,
        ]);
    }

    public function edit(Request $request)
    {
        if ($request->get('id')) {
            $gallery = GalleryImageCategory::find($request->get('id'));
        } else {
            $gallery = new GalleryImageCategory();
        }

        if ($request->method() == 'POST') {
            $rules = [
                'title:bg' => 'required',
                '%is_enabled' => 'nullable|boolean',
            ];

            $rules = RuleFactory::make($rules);
            $validator = \Validator::make(array_filter($request->all()), $rules);
            if ($validator->fails()) {
                $request->session()->flash('error', 'Записът не може да бъде осъществен !');
                return back()->withErrors($validator)->withInput($request->all());
            } else {
                $cleanData = $request->except([
                    'gallery_images',
                ]);

                $gallery->fill($cleanData);
                $gallery->save();

                self::handleUploadedFiles($gallery,  $request['gallery_images']);

                $request->session()->flash('success', 'Записът беше осъществен успешно !');

                return redirect()->route('admin.gallery.edit', [
                    'id' => $gallery->id,
                ]);
            }
        }

        return view('admin.gallery.gallery_edit', [
            'gallery' => $gallery,
        ]);
    }

    public function uploadFile(Request $request)
    {
        $galleryFileId = $request->get('gallery_file_id');
        $galleryId = $request->get('gallery_id');
        $uploadDirectory = public_path('/'.GalleryFileConstant::GALLERY_FILE_DIRECTORIES[GalleryFileConstant::TYPE_GALLERY_IMAGE]);

        $uploadedFile = $request->imagefile;
        if ($galleryFileId) {
            $galleryFile = GalleryImage::find($galleryFileId);
            try {
                unlink($uploadDirectory.$galleryFile->name);
            } catch (\Exception $e) {
                // do nothing
            }

        } else {
            $galleryFile = new GalleryImage();
            $galleryFile->gallery_image_category_id = $galleryId;
        }

        $rules = array('file' => 'mimes:png,gif,jpeg,pdf,jpg|max:10240');
        $validator = \Validator::make(array('file'=> $uploadedFile), $rules);
        if($validator->passes()){
            $fileName = FilePathManager::generateFileName($uploadedFile->getClientOriginalName());
            $uploadedFile->move($uploadDirectory, $fileName);
            $galleryFile->name = $fileName;
            $galleryFile->save();
        } else {
            return ['error' => 'Неуспешно качване на файл. Нужно е да бъде : png,gif,jpeg,pdf или jpg'];
        }

        return ['gallery_id' => $galleryFile->id];
    }

    public static function handleUploadedFiles($gallery, $files)
    {
        $alreadyPresentFiles = GalleryImage::where('gallery_image_category_id', $gallery->id)
            ->orderBy('position')
            ->get()
            ->keyBy('id');

        $uploadDirectory = public_path('/'.GalleryFileConstant::GALLERY_FILE_DIRECTORIES[GalleryFileConstant::TYPE_GALLERY_IMAGE]);

        foreach ($files as $file) {
            $fileId = $file['id'] ?? null;
            if ($fileId) {
                $isAlreadyPresent = isset($alreadyPresentFiles[$fileId]);
                if ($isAlreadyPresent) {
                    $galleryFile = $alreadyPresentFiles[$fileId];
                    unset($alreadyPresentFiles[$fileId]);
                } else {
                    $galleryFile = GalleryImage::find($fileId);
                    $galleryFile->gallery_image_category_id = $gallery->id;
                }
                $galleryFile->title = $file['title'];
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
    }

    public function saveCategoryTree(Request $request)
    {
        $categoriesById = GalleryImageCategory::all()->keyBy('id');
        $categoryData = $request->get('category_tree');
        $this->updateCategoryTree(null, $categoryData, $categoriesById);

        return ['status' => 'success'];
    }

    private function updateCategoryTree($parent, $categoryDataTree, &$categoriesById)
    {
        $weight = 0;
        foreach ($categoryDataTree as $category) {
            $categoryId = $category['id'];
            $currentCategoryObj = $categoriesById[$categoryId];
            $currentCategoryObj->weight = $weight;
            $weight += 1;
            // change parent if needed
            if ($parent) {
                if ($currentCategoryObj->parent_id != $parent['id']) {
                    $currentCategoryObj->parent_id = $parent['id'];
                }
            } else {
                if (!empty($currentCategoryObj->parent_id)) {
                    $currentCategoryObj->parent_id = null;
                }
            }
            $currentCategoryObj->save();

            if (isset($category['children']) && count($category['children'])) {
                $this->updateCategoryTree($category, $category['children'], $categoriesById);
            }
        }
    }
}
