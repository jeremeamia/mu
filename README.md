# The µ PHP Micro-framework

A _"real"_ :trollface: micro-framework that fits in **just 3 lines of code<sup>†</sup>**.

The "micro-frameworks" out there weren't _micro_ enough for me, so I brushed up on
some of my code golfing skills to create **µ**.

[Check out the code!](https://github.com/jeremeamia/mu/blob/master/mu.php)

_<sup>†</sup>Where "line of code" means "as much code as possible crammed into <= 120 characters"._

## Features

These 3 LOC come jam-packed with features!

### Easy, regex-based routing system

Follows the well-established route-to-callable micro-framework pattern.

```php
(new µ)
    ->get('/hello', function () {
        echo "<p>Hello, world!</p>";
    })
    ->run();
```

Allows you to access parameters from the URL.

```php
(new µ)
    ->get('/hello/(?<name>\w+)', function ($app, $params) {
        echo "<p>Hello, {$params['name']}!</p>";
    })
    ->run();
```

Supports all your favorite HTTP verbs.

```php
(new µ)
    ->delete('/user/(?<id>\d+)', $fn)
    ->get('/user/(?<id>\d+)', $fn)
    ->head('/user/(?<id>\d+)', $fn)
    ->patch('/user/(?<id>\d+)', $fn)
    ->post('/users', $fn)
    ->put('/user/(?<id>\d+)', $fn)
    ->run();
```

### Simple dependency/config container

```php
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

(new µ)
    ->cfg('log.channel', 'your-app')
    ->cfg('log.handler', function () {
        return new StreamHandler('path/to/your.log', Logger::DEBUG);
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
```

If a callable is provided (like with `log.handler` above), then it is treated as a factory and is only called once to
produce a singleton value for efficient, multiple accesses.

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
(new µ)
    ->get('/hello/(?<name>\w+)', function ($app, $params) {
        echo $app->view(__DIR__ . '/templates', 'hello', [
            'greeting' => 'howdy',
            'name'     => $params['name'],
        ]);
    })
    ->run();
```

No Twigs, Plates, or Blades to cut you or poke you. That might feel a little _dull_, but it's simple.

## Design constraints

* Must have at least a Router, Container, and Templating System as features.
* Must attempt to incorporate usage patterns (e.g., chainable methods, closures
  as controllers) that resemble other contemporary micro-frameworks.
* Must work with `error_reporting` set to `-1` (all errors reported).
* Must not exceed 3 lines of code (LOC), where each line is <= 120 characters.
* Must not have dependencies on other packages.
* May break traditional coding conventions/styles for the sake of brevity.
* Must be hand-written, not minified/obfuscated by any tools.

## It works, but it's really just a joke.

Don't use this in production, or really anywhere. It's just for fun. :smile:

If you want to use a production-quality _micro-framework_, try [Slim](http://www.slimframework.com/).

## Examples

The code examples in this README are also shipped as working examples in the `/examples` directory.

To run an example, use the built-in PHP server.
```bash
# For the hello1 example:
php -S localhost:8000 examples/hello1.php
```
Then access `http://localhost:8000` in your browser or via cURL.

## Tests

A very basic test suite is included, and can be run via:
```bash
php test.php
```
