<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

const VIEWS_DIR = __DIR__ . '/templates';

(new µ)
    ->get('/hello/(?<name>\w+)', function ($app, $params) {
        echo $app->view(VIEWS_DIR, 'hello4', [
            'greeting' => 'howdy',
            'name'     => $params['name'],
        ]);
    })
    ->run();
