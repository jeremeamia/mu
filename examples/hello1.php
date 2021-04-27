<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

(new µ)
    ->get('/hello', function () {
        echo "<p>Hello, world!</p>";
    })
    ->run();
