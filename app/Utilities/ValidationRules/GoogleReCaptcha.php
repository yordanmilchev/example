<?php
namespace App\Utilities\ValidationRules;

use GuzzleHttp\Client;

class GoogleReCaptcha
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        $client = new Client;
        $response = $client->post('https://www.google.com/recaptcha/api/siteverify',
            [
                'form_params' =>
                    [
                        'secret' => env('G_CAPTCHA_SECRET_KEY'),
                        'response' => $value
                    ]
            ]
        );
        $body = json_decode((string)$response->getBody());
        return $body->success;
    }
}
