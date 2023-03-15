<?php

namespace App\Traits;


trait TranslationsSave
{
    public function save(array $attributes = [])
    {
        $canBeSaved = true;
        foreach (self::$requiredFieldsForSave as $requiredField) {
            if(!isset($this->$requiredField) || empty($this->$requiredField)) {
                $canBeSaved = false;
            }
        }
        if (!$canBeSaved) {
            parent::delete();
        }
        else {
            parent::save();
        }
        return true;
    }
}