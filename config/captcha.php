<?php
return [
    /**
     * SLiMS by default use Google ReCaptcha v2
     * 
     * make yours captcha library and provide it inside
     * providers.
     */
    'default' => 'ReCaptcha',

    // Captcha sections
    'sections' => [
        'librarian' => ['active' => false],
        'memberarea' => ['active' => true],
        'forgot' => ['active' => true],
    ],

    // Captcha providers
    'providers' => [
        'ReCaptcha' => [
            'varify_url' => 'https://www.google.com/recaptcha/api/siteverify',
            /**
             * This is SLiMS public and private key only
             * work on localhost. If your SLiMS was online you can register
             * your app and get your key from https://www.google.com/recaptcha/admin/create
             */
            'publickey' => '6LdknSUqAAAAAK1Md87MBZWXOTe32sz7oAHMrSj5',
            'privatekey' => '6LdknSUqAAAAAIckR7UL9IwarJmyo8ZULe0iSiog',

            /**
             * Recapcha library class, if you have your
             * ReCaptcha library, feel free to change it with yours.
             */
            'class' => \SLiMS\Captcha\Providers\ReCaptcha::class
        ]// Add another providers here
    ]
];