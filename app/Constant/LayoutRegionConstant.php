<?php

namespace App\Constant;

class LayoutRegionConstant
{
    const HEADER_HIGHLIGHT = 'HEADER_HIGHLIGHT'; //pod header-a na stranitsata za mnogo vazhna informatsia
    const HOMEPAGE_CONTENT = 'HOMEPAGE_CONTENT';
    const IN_PRODUCT_LIST = 'IN_PRODUCT_LIST'; //izmezhdu rezultatite ot tarsene i v listvaneto na produktovite kategorii
    const INVOICE_SELLER_DATA = 'INVOICE_SELLER_DATA';
    const IN_PRODUCT_BANNER = 'IN_PRODUCT_BANNER';
    const LANDING_PAGE_HEAD = 'LANDING_PAGE_HEAD';
    const AFTER_PRODUCTS_LIST = 'AFTER_PRODUCTS_LIST';

    const ALL = [
        self::HEADER_HIGHLIGHT,
        self::HOMEPAGE_CONTENT,
        self::IN_PRODUCT_LIST,
        self::INVOICE_SELLER_DATA,
        self::IN_PRODUCT_BANNER,
        self::LANDING_PAGE_HEAD,
        self::AFTER_PRODUCTS_LIST
    ];

    const REGION_URL = [
        self::HEADER_HIGHLIGHT => '/',
        self::HOMEPAGE_CONTENT => '/',
        self::IN_PRODUCT_LIST => '/products',
        self::INVOICE_SELLER_DATA => '/',
        self::IN_PRODUCT_BANNER => '/{slug?}',
        self::LANDING_PAGE_HEAD => '/landing/{categoryIds?}',
        self::AFTER_PRODUCTS_LIST => '/products',
    ];
}
