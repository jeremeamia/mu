# The µ PHP Microframework

[![Code Climate](https://codeclimate.com/github/jeremeamia/mu/badges/gpa.svg)](https://codeclimate.com/github/jeremeamia/mu)

A _"real"_ microframework that fits in **just 4 lines of code**.

The "microframeworks" out there weren't _micro_ enough for me, so I brushed up on
some of my code golfing skills to create **µ**.

[Check out the code!](https://github.com/jeremeamia/mu/blob/master/mu.php)

## Features

These 4 LOC come jam-packed with features!

### Easy, regex-based routing system

Follows the well-established route-to-callable microframework pattern.

```php
echo (new µ)
    ->get('/hello', function ($app) {
        return "<p>Hello, world!</p>";
    })
    ->run($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
```

Allows you to access parameters from the URL.

```php
echo (new µ)
    ->get('/hello/(?<name>\w+)', function ($app, $params) {
        return "<p>Hello, {$params['name']}!</p>";
    })
    ->run($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
```

Supports all your favorite HTTP verbs.

```php
echo (new µ)
    ->delete('/user/(?<id>\d+)', $fn)
    ->get('/user/(?<id>\d+)', $fn)
    ->head('/user/(?<id>\d+)', $fn)
    ->patch('/user/(?<id>\d+)', $fn)
    ->post('/users', $fn)
    ->put('/user/(?<id>\d+)', $fn)
    ->run($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
```

Supports wildcard verbs too, because sometimes you are just making a web page
and you really don't care about esoteric HTTP practices.

```php
echo (new µ)
    ->any('/', $fn)
    ->run($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
```

### Simple, but powerful, dependency injection container

```php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

echo (new µ)
    ->cfg('log.channel', 'your-app')
    ->cfg('log.handler', function ($app) {
        return new StreamHandler('path/to/your.log', Logger::WARNING);
    })
    ->cfg('log', function ($app) {
        $log = new Logger($app->cfg('log.channel'));
        $log->pushHandler($app->cfg('log.handler'));
        return $log;
    })
    ->get('/hello/(?<name>\w+)', function ($app, $params) {
        $app->cfg('log')->addDebug("Said hello to {$params['name']}.");
        return "<p>Hello, {$params['name']}!</p>";
    })
    ->run($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
```

### A truly _elegant_ and fluent interface

_See previous example (I'm lazy)._

### Built-in templating system, free of `{}`

Templates are just PHP files—no mustaches and no frills.

```html
<!-- templates/hello.php -->
<html>
  <head>
    <title>World Greeter</title>
  </head>
  <body>
    <p><?= ucfirst($greeting) ?>, <?= $name ?>!</p>
  </body>
</html>
```

```php
// index.php
echo (new µ)
    ->cfg('views', __DIR__ . '/templates')
    ->any('/hello/(?<name>\w+)', function ($app, $params) {
        return $app->view('hello', [
            'greeting' => 'howdy',
            'name'     => $params['name'],
        ]);
    })
    ->run($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
```

No twigs, plates, or blades to cut you or poke you.

## Design constraints

* Must have at least a Router, Container, and Templating System as features.
* Must attempt to incorporate usage patterns (e.g., chainable methods, closures
  as controllers) that resemble other contemporary microframeworks.
* Must work with `error_reporting` set to `-1` (all errors reported).
* Must not exceed 4 lines of code (LOC), where each line is <= 120 characters.
* Must not have dependencies on other packages.
* May break traditional coding conventions for the sake of brevity.
* Must be hand-written.

## It works, but it's really just a joke.

Don't use this in production, or really anywhere. It's just for fun. :smile:

If you want to use a production-quality _microframework_, try one of these:

* [Slim](http://www.slimframework.com/)
* [Silex](http://silex.sensiolabs.org/)
* [Lumen](http://lumen.laravel.com/) _(new)_
