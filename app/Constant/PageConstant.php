<?php
namespace App\Constant;

class PageConstant
{
    const TEMPLATE_DIR = 'pages'; // /resources/views/pages

    //use in Blade template: {{page_url('cookies_policy')}}
    const ROUTE_KEYS = [
            'za_nas',
            'kontakti',
            'uslugi',
        ];

    /**
     * templateList - return all template files in the template directory
     *
     * @return array
     */
    public static function templateList() : array
    {
        $filesNamesArr=[];
        $path = resource_path('views/'.self::TEMPLATE_DIR);
        $filesNamesArr = array_values(array_diff(scandir($path), array('..', '.')));
        foreach ($filesNamesArr as $arrayIndex=>$fileName) {
            $filesNamesArr[$arrayIndex]=str_replace(".blade.php", "", $filesNamesArr[$arrayIndex]);
        }
        return $filesNamesArr;
    }


    public static function getTemplatePath(string $templateName)
    {
        return self::TEMPLATE_DIR.'.'.$templateName;
    }
}
