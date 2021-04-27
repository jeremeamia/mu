<?php

declare(strict_types=1);

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

require __DIR__ . '/../vendor/autoload.php';

(new µ)
    ->cfg('log.channel', 'hello3')
    ->cfg('log.handler', function () {
        return new StreamHandler(__DIR__ . '/hello3.log', Logger::DEBUG);
    })
    ->cfg('log', function ($app) {
        $log = new Logger($app->cfg('log.channel'));
        $log->pushHandler($app->cfg('log.handler'));
        return $log;
    })
    ->get('/hello/(?<name>\w+)', function ($app, $params) {
        $app->cfg('log')->debug("Said hello to {$params['name']}");
        echo "<p>Hello, {$params['name']}!</p>";
    })
    ->run();
