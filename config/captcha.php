<?php

return [
    'secret' => env('RECAPTCHA_PRIVATE_KEY'),
    'sitekey' => env('RECAPTCHA_PUBLIC_KEY'),

    'options' => [
        'curl_verify' => env('RECAPTCHA_CURL_VERIFY', true),
    ],
];
