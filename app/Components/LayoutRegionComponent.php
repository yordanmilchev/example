<?php
namespace App\Components;

use App\Models\LayoutBlock;
use App\Constant\DynamicLayoutBlockConstant;
use Illuminate\Http\Request;
use App\Constant\CacheTagConstant;
use Illuminate\Support\Facades\Cache;

class LayoutRegionComponent
{
    public static function build($regionName)
    {
        $cacheKey = locale().'_'.$regionName.'_'.md5(request()->fullUrl());

        //get from cache if key exists
        if (Cache::tags(CacheTagConstant::LAYOUT_REGIONS)->has($cacheKey)) {
            return Cache::tags(CacheTagConstant::LAYOUT_REGIONS)->get($cacheKey);
        }

        $query = LayoutBlock::whereRaw("(region_name=? and is_enabled=1 and locale=?)", [$regionName, locale()])
            ->orderBy('weight');

        if(!empty(request()->block_debug)) {
            $query->orWhereRaw("(region_name=? and locale=? and id=?)", [$regionName, locale(), request()->block_debug]);
        }

        $regionBlocks = $query->get();

        //filter blocks by URL
        $regionBlocks = self::URLfilter($regionBlocks);

        $regionContent = '';

        foreach ($regionBlocks as $regionBlock) {
            if($regionBlock->dynamic_content!==null) {
                $regionContent .= self::generateDynamicLayoutBlock($regionBlock->dynamic_content);
            }
            else if($regionBlock->static_content!==null) {
                $regionContent .= $regionBlock->static_content;
            }
        }

        $beginComment = "<!--begin::Layout region $regionName -->";
        $endComment = "<!--end::Layout region $regionName -->";

        $regionContent = $beginComment . PHP_EOL . $regionContent . PHP_EOL . $endComment;

        Cache::tags(CacheTagConstant::LAYOUT_REGIONS)->put($cacheKey, $regionContent, 600); //cache it for 10 min. because of dynamically generated blocks

        return $regionContent;
    }

    public static function generateDynamicLayoutBlock($dynamicLayoutBlockClass)
    {
        if(!isset(DynamicLayoutBlockConstant::ALL[$dynamicLayoutBlockClass])) {
            return '<div style="color:red;border:1px solid red;">Class '.$dynamicLayoutBlockClass.' is not set in DynamicLayoutBlockConstant.</div>';
        }

        $dynamicContentGenerator = DynamicLayoutBlockConstant::ALL[$dynamicLayoutBlockClass];
        return $dynamicContentGenerator::generate();
    }

    /**
     * URLfilter - filters which blocks to show or not by the request URL
     *
     * @param  Illuminate\Database\Eloquent\Collection of App\Models\LayoutBlock $regionBlocks
     * @return Illuminate\Database\Eloquent\Collection of App\Models\LayoutBlock
     */
    private static function URLfilter($regionBlocks)
    {
        $urlPath = request()->path();
        $fullUrl = request()->fullUrl();

        foreach ($regionBlocks as $blockKey => $block) {

            if(empty($block->url_filter_operator) || empty($block->url_filter_values)) {
                continue;
            }

            $urlFilterOperator = $block->url_filter_operator;
            $urlFilterValuesArr = json_decode($block->url_filter_values);

            if($urlFilterOperator == "hide_if_contains") {
                foreach ($urlFilterValuesArr as $filterValue) {
                    if (strpos($urlPath, $filterValue) !== false) {
                        $regionBlocks->forget($blockKey);
                        break;
                    }
                }
            }
            else if($urlFilterOperator == "show_if_contains") {
                $mustShow=false;
                foreach ($urlFilterValuesArr as $filterValue) {
                    if (strpos($urlPath, $filterValue) !== false) {
                        $mustShow=true;
                        break;
                    }
                }
                if($mustShow==false) {
                    $regionBlocks->forget($blockKey);
                }
            }
            else if($urlFilterOperator == "hide_if_matches") {
                foreach ($urlFilterValuesArr as $filterValue) {
                    if ($filterValue == $urlPath) {
                        $regionBlocks->forget($blockKey);
                        break;
                    }
                }
            }
            else if($urlFilterOperator == "show_if_matches") {
                $mustShow=false;
                foreach ($urlFilterValuesArr as $filterValue) {
                    if ($filterValue == $urlPath) {
                        $mustShow=true;
                        break;
                    }
                }
                if(!$mustShow) {
                    $regionBlocks->forget($blockKey);
                }
            }
            else if($urlFilterOperator == "show_if_matches_full") {
                $mustShow=false;
                foreach ($urlFilterValuesArr as $filterValue) {
                    if ($filterValue == $fullUrl) {
                        $mustShow=true;
                        break;
                    }
                }
                if(!$mustShow) {
                    $regionBlocks->forget($blockKey);
                }
            }

        }

        return $regionBlocks;
    }
}
