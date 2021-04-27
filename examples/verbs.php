<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$fn = function () {
    header('X-Test: Hello!', true, 200);
    if ($_SERVER['REQUEST_METHOD'] !== 'HEAD') {
        echo <<<HTML
            <ul>
                <li>Method: {$_SERVER['REQUEST_METHOD']}</li>
                <li>URI: {$_SERVER['REQUEST_URI']}</li>
            </ul>
        HTML;
    }
};

(new µ)
    ->delete('/user/(?<id>\d+)', $fn)
    ->get('/user/(?<id>\d+)', $fn)
    ->head('/user/(?<id>\d+)', $fn)
    ->patch('/user/(?<id>\d+)', $fn)
    ->post('/users', $fn)
    ->put('/user/(?<id>\d+)', $fn)
    ->run();
