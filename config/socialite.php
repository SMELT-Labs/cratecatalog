<?php

return [
    'apple' => [
        'client_id' => env('SOCIALITE_APPLE_CLIENT'),
        'client_secret' => env('SOCIALITE_APPLE_SECRET'),
        'redirect' => env('APP_URL') . '/oauth/callback/apple',
        "colorClass" => [
            "dark:bg-black bg-white dark:text-white text-black"
        ]
    ],
    'google' => [
        'client_id' => env('SOCIALITE_GOOGLE_CLIENT'),
        'client_secret' => env('SOCIALITE_GOOGLE_SECRET'),
        'redirect' => env('APP_URL') . '/oauth/callback/google',
        "colorClass" => [
            "bg-[#dd4b39] text-white"
        ]
    ],
    'facebook' => [
        'client_id' => env('SOCIALITE_FACEBOOK_CLIENT'),
        'client_secret' => env('SOCIALITE_FACEBOOK_SECRET'),
        'redirect' => env('APP_URL') . '/oauth/callback/facebook',
        "colorClass" => [
            "bg-[#1877f2] text-white"
        ]
    ],
//    'twitter' => [
//        'icon' => 'twitter',
//        'client_id' => env('SOCIALITE_TWITTER_CLIENT'),
//        'client_secret' => env('SOCIALITE_TWITTER_SECRET'),
//        'redirect' => env('APP_URL') . '/oauth/callback/twitter',
//        'oauth' => 2,
//        "colorClass" => [
//            "bg-[#1da1f2] text-white"
//        ]
//    ],
];
