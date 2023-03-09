<?php

return [
    'default_user'=>[
        'password'=>env('DEFAULT_USER_PASSWORD','1234567'),
        'email'=>env('DEFAULT_USER_EMAIL','ams@example.com'),
    'name'=>env('DEFAULT_USER_NAME','ams')
    ],
    'admins'=>[
        'amonteor@iesebre.com',
        'videosmanager@casteaching.com',

    ]

];
