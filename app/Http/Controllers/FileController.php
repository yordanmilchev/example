<?php

namespace App\Http\Controllers;


use App\Constant\GalleryFileConstant;
use App\Models\Catalog\ProductFile;
use App\Utilities\FilePathManager;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function uploadFile(Request $request)
    {
        $productFileId = $request->get('product_file_id');
        $productId = $request->get('product_id');
        $productType = GalleryFileConstant::TYPE_ORDER_PRODUCT_FEEDBACK_IMAGE;
        $orderProductId = $request->get('order_product_id');
        $orderProductReclamationId = $request->get('reclamation_order_product_id');
        $uploadDirectory = public_path('/'.GalleryFileConstant::GALLERY_FILE_DIRECTORIES[$productType]);

        $uploadedFile = $request->imagefile;
        if ($productFileId) {
            $productFile = ProductFile::find($productFileId);
            try {
                unlink($uploadDirectory.$productFile->name);
            } catch (\Exception $e) {
                // do nothing
            }

        } else {
            $productFile = new ProductFile();
            $productFile->type = $productType;
            if(!empty($productId)){
                $productFile->product_id = $productId;
            }
        }

        $rules = array('file' => 'mimes:png,gif,jpeg,pdf,jpg|max:10240');
        $validator = \Validator::make(array('file' => $uploadedFile), $rules);
        if ($validator->passes()) {
            $fileName = FilePathManager::generateFileName($uploadedFile->getClientOriginalName());
            $uploadedFile->move($uploadDirectory, $fileName);
            $productFile->name = $fileName;
            $productFile->save();
        } else {
            return ['error' => 'Неуспешно качване на файл. Нужно е да бъде : png,gif,jpeg,pdf или jpg'];
        }

        return [
            'product_id' => $productFile->id,
            'order_product_reclamation_id' => $orderProductReclamationId,
            'order_product_id' => $orderProductId,
        ];
    }
}
