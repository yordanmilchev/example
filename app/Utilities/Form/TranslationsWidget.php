<?php
namespace App\Utilities\Form;

use Astrotomic\Translatable\Locales;

class TranslationsWidget
{
    /**
     * Renders html markup for given fields with configurations
     * Used for translatable models
     * Can be used with multiple fileds that need translation
     *
     * usage: $fieldConfig = ['field-name' => ['label' => 'some-string', 'object' => 'object-instance-giving-first-value']
     * @param array $fieldsConfig
     * @param array $fieldsPrefix Used for rendering multiple same class objects for edit (must have unique field names)
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function renderFields($fieldsConfig = [], $fieldsPrefix = '')
    {
        $locales = app(Locales::class)->all();

        return view('admin.components.form_widgets.translation_fields', [
            'locales' => $locales,
            'fields' => $fieldsConfig,
            'fieldsPrefix' => $fieldsPrefix ?  $fieldsPrefix . '_' : ''
        ]);
    }
}
