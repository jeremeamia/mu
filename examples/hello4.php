<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

(new µ)
    ->cfg('views', __DIR__ . '/templates')
    ->get('/hello/(?<name>\w+)', function ($app, $params) {
        echo $app->view('hello4', [
            'greeting' => 'howdy',
            'name'     => $params['name'],
        ]);
    })
    ->run();
