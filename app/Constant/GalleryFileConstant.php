<?php

namespace App\Constant;

/**
 * Class GalleryFileConstant holding all image types as constants
 *
 * @package App\Constant
 */
class GalleryFileConstant
{
    /**
     * Gallery file types
     *
     * @var string
     */
    const TYPE_TEASER = 'teaser';
    const TYPE_COMPRESSED = 'compressed';
    const TYPE_1920X490 = '1920x490';
    const TYPE_1920X425 = '1920x425';
    const TYPE_800X400 = '800x400';

    const TYPE_BLOG_IMAGE = 'blog_image';
    const TYPE_STORE_IMAGE = 'store_image';
    const TYPE_GALLERY_IMAGE = 'gallery_image';
    const TYPE_PRODUCT_IMAGE = 'product_image';
    const TYPE_ORDER_PRODUCT_FEEDBACK_IMAGE = 'order_product_feedback_image';
    const TYPE_PRODUCT_VIDEO = 'product_video';
    const TYPE_SERVICE_IMAGE = 'service_image';
    const TYPE_ACTIVITY_IMAGE = 'activity_image';
    const TYPE_SLIDER_IMAGE = 'slider_image';
    const TYPE_PARTNER_IMAGE = 'partner_image';



    /**
     * All gallery file types
     */
    const ALL_FILE_TYPES = [
        self::TYPE_BLOG_IMAGE,
        self::TYPE_STORE_IMAGE,
        self::TYPE_GALLERY_IMAGE,
        self::TYPE_PRODUCT_IMAGE,
        self::TYPE_ORDER_PRODUCT_FEEDBACK_IMAGE,
        self::TYPE_PRODUCT_VIDEO,
        self::TYPE_SERVICE_IMAGE,
        self::TYPE_ACTIVITY_IMAGE,
        self::TYPE_SLIDER_IMAGE,
        self::TYPE_PARTNER_IMAGE,
    ];

    const GALLERY_FILE_DIRECTORIES = [
        self::TYPE_BLOG_IMAGE => 'uploads/live/blog/',
        self::TYPE_STORE_IMAGE => 'uploads/live/store_images/',
        self::TYPE_GALLERY_IMAGE => 'uploads/live/gallery_images/',
        self::TYPE_PRODUCT_IMAGE => 'uploads/live/product_images/',
        self::TYPE_ORDER_PRODUCT_FEEDBACK_IMAGE => 'uploads/live/order_product_feedback/',
        self::TYPE_PRODUCT_VIDEO => 'uploads/live/product_videos/',
        self::TYPE_SERVICE_IMAGE => 'uploads/live/service_images/',
        self::TYPE_ACTIVITY_IMAGE => 'uploads/live/activity_images/',
        self::TYPE_SLIDER_IMAGE => 'uploads/live/homepage/slider_images/',
        self::TYPE_PARTNER_IMAGE => 'uploads/live/homepage/partner_images/',
    ];

    const GALLERY_STYLES = [
        self::TYPE_TEASER => [
            self::TYPE_BLOG_IMAGE => 'uploads/live/blog/style_teaser/',
            self::TYPE_STORE_IMAGE => 'uploads/live/store_images/style_teaser/',
            self::TYPE_GALLERY_IMAGE => 'uploads/live/gallery_images/style_teaser/',
            self::TYPE_PRODUCT_IMAGE => 'uploads/live/product_images/style_teaser/',
            self::TYPE_ORDER_PRODUCT_FEEDBACK_IMAGE => 'uploads/live/order_product_feedback/style_teaser/',
            self::TYPE_SERVICE_IMAGE => 'uploads/live/service_images/style_teaser/',
            self::TYPE_ACTIVITY_IMAGE => 'uploads/live/activity_images/style_teaser/',
            self::TYPE_SLIDER_IMAGE => 'uploads/live/homepage/slider_images/style_teaser/',
            self::TYPE_PARTNER_IMAGE => 'uploads/live/homepage/partner_images/style_teaser/',
        ],
        self::TYPE_COMPRESSED => [
            self::TYPE_BLOG_IMAGE => 'uploads/live/blog/style_compressed/',
            self::TYPE_STORE_IMAGE => 'uploads/live/store_images/style_compressed/',
            self::TYPE_GALLERY_IMAGE => 'uploads/live/gallery_images/style_compressed/',
            self::TYPE_PRODUCT_IMAGE => 'uploads/live/product_images/style_compressed/',
            self::TYPE_ORDER_PRODUCT_FEEDBACK_IMAGE => 'uploads/live/order_product_feedback/style_compressed/',
            self::TYPE_SERVICE_IMAGE => 'uploads/live/service_images/style_compressed/',
            self::TYPE_ACTIVITY_IMAGE => 'uploads/live/activity_images/style_compressed/',
            self::TYPE_SLIDER_IMAGE => 'uploads/live/homepage/slider_images/style_compressed/',
            self::TYPE_PARTNER_IMAGE => 'uploads/live/homepage/partner_images/style_compressed/',
        ],
        self::TYPE_1920X425 => [
            self::TYPE_SERVICE_IMAGE => 'uploads/live/service_images/1920x425/',
            self::TYPE_ACTIVITY_IMAGE => 'uploads/live/activity_images/1920x425/',
        ],
        self::TYPE_1920X490 => [
            self::TYPE_SLIDER_IMAGE => 'uploads/live/homepage/slider_images/1920x490/',
        ],
        self::TYPE_800X400 => [
            self::TYPE_SERVICE_IMAGE => 'uploads/live/service_images/800x400/',
            self::TYPE_ACTIVITY_IMAGE => 'uploads/live/activity_images/800x400/',
            self::TYPE_SLIDER_IMAGE => 'uploads/live/homepage/slider_images/800x400/',
        ]
    ];
}
