<?php

if (!function_exists('format_date')) {

    function format_date($dbFormatDate)
    {
        $locale = app()->getLocale();

        if($locale=="bg") {
            return \Carbon\Carbon::parse($dbFormatDate)->format('d-m-Y');
        }
        else if($locale=="ro") {
            return \Carbon\Carbon::parse($dbFormatDate)->format('d.m.Y');
        }

        return \Carbon\Carbon::parse($dbFormatDate)->format('d-m-Y');
    }
}

if (!function_exists('simple_format_date')) {

    function simple_format_date($dbFormatDate)
    {
        return date('d.m.Y', strtotime($dbFormatDate));
    }
}

if (!function_exists('between_dates')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function between_dates($createdAt)
    {
        $startDate = Carbon\Carbon::today()->subDays(14);
        $endDate = Carbon\Carbon::now();

        $check = $createdAt->between($startDate, $endDate);

        return $check;
    }
}
