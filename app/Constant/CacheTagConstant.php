<?php

namespace App\Constant;

class CacheTagConstant
{
    const PRODUCT_CATEGORIES = "product_categories"; //use Cache::tags(CacheTagConstant::PRODUCT_CATEGORIES)->flush(); to clear cache when change product categories
    const LAYOUT_REGIONS = "layout_regions";
    const USERS_CARTS = "users_carts";
    const PRODUCT_PAGE = "product_page";
    const PRODUCTS_LISTINGS = "products_listing";
    const PRODUCTS_LISTINGS_ALL = "product_listing_all";
    const PRODUCT_TEASER = "product_teaser";
    const PAGES = "pages";
    const FAVORITE_PRODUCTS_IDS = "favorite_products";

    const ALL = [
        self::PRODUCT_CATEGORIES,
        self::USERS_CARTS,
        self::PAGES,
        self::PRODUCTS_LISTINGS,
        self::PRODUCTS_LISTINGS_ALL,
        self::PRODUCT_PAGE,
        self::PRODUCT_TEASER,
        self::FAVORITE_PRODUCTS_IDS,
        self::LAYOUT_REGIONS,
    ];
}
