<?php
namespace App\Components;

use App\Components\ProductCategoriesComponent;
use Illuminate\Support\Facades\Cache;
use App\Constant\CacheTagConstant;
use App\Models\Catalog\Product;

class BreadcrumbComponent
{
    private static $itemsQueue = [];

    /**
     * getItems
     * return all breadcrumb items to be looped in a blade template
     * @return array
     */
    public static function getItemsQueue() : array
    {
        return self::$itemsQueue;
    }

    /**
     * addItem
     * add item to BreadcrumbComponent queue
     * @param  string $content
     * @param  string $routeName
     * @return void
     */
    public static function addItem(string $content, string $routeName=null)
    {
        $newItem = [
            'content' => $content,
            'url' => $routeName
        ];

        array_push(self::$itemsQueue, $newItem);
    }

    /**
     * addItems - add multiple items to the Breadcrumb
     *
     * @param  array $itemsArr [['content'=>'Дивани', 'url'=>'{url}'], ...]
     * @return void
     */
    public static function addItems(array $itemsArr)
    {
        foreach ($itemsArr as $item) {
            self::addItem($item['content'], $item['url']);
        }
    }

    public static function addItemsByCategoryId($categoryId)
    {
        $cacheKey=locale().'_breadcrumbToCategoryId'.$categoryId;

        //get the breadcrumb from cache if key exists
        if (Cache::tags(CacheTagConstant::PRODUCT_CATEGORIES)->has($cacheKey)) {
            self::addItems(Cache::tags(CacheTagConstant::PRODUCT_CATEGORIES)->get($cacheKey));
            return;
        }

        $breadcrumbItems=[];

        $menusAllLangsArr=ProductCategoriesComponent::getAsMenuTree();
        $menuTree = $menusAllLangsArr[locale()];
        $menuItem = $menuTree->find($categoryId);

        $ancestorsArr = self::getAncestors($menuTree, $menuItem);

        foreach ($ancestorsArr as $item) {
            if(!empty($item->title)) {
                array_push($breadcrumbItems, ['content'=>$item->title, 'url'=>$item->link->path['url']]);
            }
        }

        //cache the breadcrumb
        Cache::tags(CacheTagConstant::PRODUCT_CATEGORIES)->rememberForever($cacheKey, function() use ($breadcrumbItems) {
            return $breadcrumbItems;
        });

        self::addItems($breadcrumbItems);
    }

    public static function addItemsByProduct($product)
    {
        $productTranslated=$product->translate(locale());
        $cacheKey=locale().'_breadcrumbToProduct'.$product->id;

        //get the breadcrumb from cache if key exists
        if (Cache::tags(CacheTagConstant::PRODUCT_CATEGORIES)->has($cacheKey)) {
            self::addItems(Cache::tags(CacheTagConstant::PRODUCT_CATEGORIES)->get($cacheKey));
            return;
        }

        $breadcrumbItems=[];

        $productCategory = $product->categories()->first();

        if($productCategory!==null) {
            $menusAllLangsArr=ProductCategoriesComponent::getAsMenuTree();
            $menuTree = $menusAllLangsArr[locale()];
            $menuItem = $menuTree->find($productCategory->id);
            $ancestorsArr = self::getAncestors($menuTree, $menuItem);

            foreach ($ancestorsArr as $item) {
                if(!empty($item->title)) {
                    array_push($breadcrumbItems, ['content'=>$item->title, 'url'=>$item->link->path['url']]);
                }
            }
        }

        $product = $productTranslated->slug;
        array_push($breadcrumbItems, ['content'=>$productTranslated->title, 'url'=>route('product', [$product])]);

        //cache the breadcrumb
        Cache::tags(CacheTagConstant::PRODUCT_CATEGORIES)->rememberForever($cacheKey, function() use ($breadcrumbItems) {
            return $breadcrumbItems;
        });

        self::addItems($breadcrumbItems);
    }

    /**
     * getAncestors
     * get array with all ancestors of an menu item including the item itself
     * @return array(['content'=>'string', 'url'=>'string'], ...)
     */
    public static function getAncestors($menu, $item) : array
    {
        $ancestorsArr = [$item];

        while($item!==null && $item->parent()!==null) {
            array_unshift($ancestorsArr, $item->parent());
            $item=$item->parent();
        }

        return $ancestorsArr;
    }
}
