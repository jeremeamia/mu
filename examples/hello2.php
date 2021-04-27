<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

(new µ)
    ->get('/hello/(?<name>\w+)', function ($app, $params) {
        echo "<p>Hello, {$params['name']}!</p>";
    })
    ->run();
