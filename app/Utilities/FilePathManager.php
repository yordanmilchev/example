<?php


namespace App\Utilities;

class FilePathManager
{
    public static function generateFileName($originalName)
    {
        $fileOriginalNameOnly = pathinfo($originalName, PATHINFO_FILENAME);
        $fileExtension = pathinfo($originalName, PATHINFO_EXTENSION);
        $generatedFilename = $fileOriginalNameOnly . '_' . time() . '.' . $fileExtension;

        return $generatedFilename;
    }
}
