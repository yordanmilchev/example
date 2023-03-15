<?php

namespace App\Constant;

/**
 * Class SettingConstant holding all Setting types as constants
 *
 * @package App\Constant
 */
class SettingConstant
{
    /**
     * Setting for the date up to which orders has been synchronized
     * command to import newly added settings: php artisan synchronize-settings !!! Add it in SynchronizeSettings.php also!
     * @var integer
     */

    const TYPE_SHORT_DELIVERY_DAYS = 1;
    const TYPE_LONG_DELIVERY_DAYS = 2;
    const TYPE_CURRENCY_RATE = 3;
    const TYPE_FREE_DELIVERY_MIN_AMOUNT = 4;
    const TYPE_FLAT_DELIVERY_FEE = 5;
    const TYPE_FB_ACCESS_TOKEN = 6;
    const TYPE_FB_PIXEL_ID = 7;
    const TYPE_VAT = 8;
    const TYPE_KIT_SKUS = 9; // list of skus delimited by pipeline (|) and new line that have same stock levels
    const TYPE_UNLIMITED_SKUS = 10; // skus that always have quantities
    const TYPE_LOCALE_PRICE_INCREASE_PERCENT = 11;
    const TYPE_GOOGLE_ANALYTICS_ID = 12;
    const TYPE_SITE_LOGO_PRIMARY = 14;
    const TYPE_SITE_NAME = 15;
    const TYPE_FIRM_NAME = 16;
    const TYPE_FIRM_EIK = 17;
    const TYPE_FIRM_IBAN = 18;
    const TYPE_FIRM_ADDRESS = 19;
    const TYPE_FIRM_EMAIL = 20;
    const TYPE_FIRM_PHONE = 21;
    const TYPE_FIRM_BIC = 22;
    const TYPE_FIRM_BANK = 23;

    const TYPES_WITH_LABEL = [
        self::TYPE_SHORT_DELIVERY_DAYS => 'Малък срок на доставка',
        self::TYPE_LONG_DELIVERY_DAYS => 'Голям срок на доставка',
        self::TYPE_CURRENCY_RATE => 'Курс',
        self::TYPE_FREE_DELIVERY_MIN_AMOUNT => 'Минимална сума за безплатна доставка',
        self::TYPE_FLAT_DELIVERY_FEE => 'Плоска цена на доставка',
        self::TYPE_FB_ACCESS_TOKEN => 'Access token за Facebook интеграцията с Conversion API (CAPI)',
        self::TYPE_FB_PIXEL_ID => 'Пиксел ID за Facebook',
        self::TYPE_VAT => 'ДДС',
        self::TYPE_KIT_SKUS => 'Скута от комплекти',
        self::TYPE_UNLIMITED_SKUS => 'Продукти винаги на кратък срок',
        self::TYPE_LOCALE_PRICE_INCREASE_PERCENT => 'Процент на увеличение на цените за различните държави',
        self::TYPE_GOOGLE_ANALYTICS_ID => 'Google analytics id',
        self::TYPE_SITE_LOGO_PRIMARY => 'Лого на сайта',
        self::TYPE_SITE_NAME => 'Име на сайта',
        self::TYPE_FIRM_NAME => 'Име на фирмата',
        self::TYPE_FIRM_EIK => 'Еик данни на фирмата',
        self::TYPE_FIRM_IBAN => 'IBAN данни на фирмата',
        self::TYPE_FIRM_ADDRESS => 'Адрес на фирмата',
        self::TYPE_FIRM_EMAIL => 'Email на фирмата',
        self::TYPE_FIRM_PHONE => 'Телефон на фирмата',
        self::TYPE_FIRM_BIC => 'BIC на фирмата',
        self::TYPE_FIRM_BANK => 'Банка на фирмата',
    ];

    //settings data types
    const DATA_TYPE_DATE = 'date';
    const DATA_TYPE_DATETIME = 'datetime';
    const DATA_TYPE_TEXT = 'text';

}
