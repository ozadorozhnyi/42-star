<?php

return [
    'routes' => [
        'index' => 'HomeController@index',
        'change' => 'SubscriptionController@change',
    ],
    'storage' => [
        'dsn' => 'mysql:dbname=plan42;host=127.0.0.1',
        'username' => 'root',
        'password' => '07931505',
    ],
];