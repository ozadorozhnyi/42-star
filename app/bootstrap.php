<?php

declare(strict_types=1);

session_start();

const ANNUALLY_DISCOUNT_RATE = 0.20;

const PAYMENT_FREQUENCY_MONTHLY = 'monthly';
const PAYMENT_FREQUENCY_ANNUALLY = 'annually';
const PAYMENT_FREQUENCY_OPTIONS = [PAYMENT_FREQUENCY_MONTHLY, PAYMENT_FREQUENCY_ANNUALLY];

const CLASSES_PATH = __DIR__ . '/classes';
const CONTROLLERS_PATH = __DIR__ . '/controllers';
const MODELS_PATH = __DIR__ . '/models';
const VIEWS_PATH = __DIR__ . '/views';

$config = require_once __DIR__.'/config.php';

spl_autoload_register(function ($className) {
    foreach ([CLASSES_PATH, CONTROLLERS_PATH, MODELS_PATH] as $path) {
        $file_path = $path . '/' . $className . '.php';
        if (is_readable($file_path)) {
            include_once $file_path;
        }
    }
});

$storage = new Storage(
    $config['storage']['dsn'],
    $config['storage']['username'],
    $config['storage']['password']
);

require_once __DIR__ . '/router.php';
