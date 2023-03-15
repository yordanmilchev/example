<?php
namespace App\Utilities\ValidationRules;

use GuzzleHttp\Client;

class StrongPassword
{
    public function validate($attribute, $value, $parameters)
    {
        $strongPasswordPattern = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/';
        if (preg_match($strongPasswordPattern, $value)) {
            return true;
        } 
        else {
            return false;
        }
    }
}