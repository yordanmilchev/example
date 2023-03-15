<?php

namespace App\Services;

class Email
{
    /**
     * Checks if email is valid and eligible for sending
     *
     * @param $email
     * @return bool
     */
    public static function isValid($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}
