<?php

if (!function_exists('localPrice')) {
    /**
     * convert price in local currency depending on locale which is set
     *
     * @param float|int $price
     * @return string
     */
    function localPrice($price)
    {
        $priceConverted = $price * getExchangeRateByLocale();

        return number_format($priceConverted, 2, '.', '');
    }
}

if (!function_exists('convertPriceFromEurForLocale')) {
    /**
     * convert price in eur currency into given locale
     *
     * @param float|int $price
     * @return string
     * @throws Exception
     */
    function convertPriceFromEurForLocale($price, $toLocale)
    {
        $convertedPrice = $price * getExchangeRateByLocale($toLocale);
        return number_format($convertedPrice, 2, '.', '');
    }
}


if (!function_exists('convertPriceFromBgForLocale')) {
    /**
     * convert price in bg currency into given locale
     *
     * @param float|int $price
     * @return string
     * @throws Exception
     */
    function convertPriceFromBgForLocale($price, $toLocale)
    {
        $convertedPrice = $price * getExchangeRateByLocale($toLocale);
        return number_format($convertedPrice, 2, '.', '');
    }
}

if (!function_exists('convertPriceFromLocaleToBg')) {
    /**
     * convert price from locale to bg
     *
     * @param float|int $price
     * @param $fromLocale
     * @return string
     * @throws Exception
     */
    function convertPriceFromLocaleToBg($price, $fromLocale, $decimals = 4)
    {
        $convertedPrice = $price / getExchangeRateByLocale($fromLocale);
        return number_format($convertedPrice, $decimals, '.', '');
    }
}

/**
 * Variable that holds currency rates. Used for not duplication of queries
 */
$GLOBALS['currency_rates'] = [];

if (!function_exists('getExchangeRateByLocale')) {
    /**
     * getExchangeRateByLocale returns exchange rate for BGN vs locale which is set
     *
     * @return float or throw exception
     */
    function getExchangeRateByLocale($locale="current")
    {
        $locale = $locale=="current"?app()->getLocale():$locale;
        if (!isset($GLOBALS['currency_rates'][$locale])) {
            $rate = \App\Models\Setting::where('setting_type',\App\Constant\SettingConstant::TYPE_CURRENCY_RATE)->first();
            $GLOBALS['currency_rates'][$locale] = $rate;
        } else {
            $rate = $GLOBALS['currency_rates'][$locale];
        }

        if($rate===null) {
            throw new \Exception("Error: currency setting is not set.");
        }
        $rateTranslation=$rate->translate($locale);
        if($rateTranslation===null) {
            throw new \Exception("Error: the exchange rate for locale '$locale' is not set.");
        }
        return $rateTranslation->value_by_locale;
    }
}

if (!function_exists('priceCentsOrEmpty')) {

    /**
     * priceCentsOrEmpty - returns the cents from given price
     * @param  (float|int) $price
     * @return string
     * @examples:
     * priceCentsOrEmpty(50.900) returns "90"
     * priceCentsOrEmpty(50.000) returns ""
     */
    function priceCentsOrEmpty($price) : string
    {
        $priceTwoDecimals =  number_format($price,2,'.','');
        $priceDecimals =  substr($priceTwoDecimals,-2);
        return $priceDecimals=="00"?"":$priceDecimals;
    }
}

if (!function_exists('formatPrice')) {

    /**
     * formatPrice - format float|int values in pretty price format
     * @param  (float|int) $price
     * @return string
     * @example: formatPrice(50.900) //returns "50.90"
     * @example: formatPrice(0.00) //returns "0"
     */
    function formatPrice($price) : string
    {
        if($price==0) {
            return "0";
        }
        else {
            return number_format($price, 2, '.', '');
        }
    }
}

if (!function_exists('getCurrentPrice')) {

    /**
     * getCurrentPrice - select current product price when there are are regular_price and promotional_price
     */
    function getCurrentPrice($productObj)
    {
        return \App\Services\Product\ProductPrice::getCurrentPrice($productObj);
    }
}

if (!function_exists('prittyPrice')) {

    /**
     * prittyPrice - maha ako e .00 sled desetchnia znak, ako ne e .00 go ostavq nepromeneno do vtoria znak
     * @param  (float|int) $price
     * @return string
     * @examples:
     * priceCentsOrEmpty(50.900) returns "50.90"
     * priceCentsOrEmpty(50.000) returns "50"
     */
    function prittyPrice($price) : string
    {
        $priceTwoDecimals =  number_format($price,2,'.','');
        $priceDecimals =  substr($priceTwoDecimals,-2);
        return $priceDecimals=="00"?floor($priceTwoDecimals):$priceTwoDecimals;
    }
}
