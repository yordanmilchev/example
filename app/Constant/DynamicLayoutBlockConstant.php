<?php

namespace App\Constant;

/**
 * DynamicLayoutBlockConstant
 *
 * @example
 * $dynamicBlockName = "TOP_PRODUCTS"; //could be saved in DB
 * $topProductsClass =  DynamicLayoutBlockConstant::ALL[$dynamicBlockName];
 * echo $topProductsClass::get();
 */
class DynamicLayoutBlockConstant
{
    const ALL = [
        "ALL_PRODUCTS" => \App\Components\AllProductsComponent::class,
        "ALL_BLOGS" => \App\Components\AllBlogsComponent::class,
    ];
}
