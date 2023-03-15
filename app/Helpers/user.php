<?php

if (!function_exists('is_admin')) {

    /**
     * easy check if current user is has admin roles
     * @return boolean
     */
    function is_admin()
    {
        if(!empty(app()->auth->user()) && count(app()->auth->user()->roles)>0) {
            return true;
        }
        return false;
    }
}
