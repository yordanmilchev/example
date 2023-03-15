<?php

if (!function_exists('client_ip')) {
    /**
     * Retrieves the real IP of client
     *
     * @return string
     */
    function client_ip()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ipAddress = $_SERVER['REMOTE_ADDR'];
        }

        return $ipAddress;
    }
}
