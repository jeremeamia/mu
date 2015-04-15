# PHP µ Framework

A _real_ "microframework" that fits in just 4 lines of code.

## Features

The 4 lines of µ come jam-packed with features!

### Easy, regex-based routing system.

Follows the well-established route-to-callable microframework pattern.

```php
echo (new µ)
    ->get('/hello', function ($app) {
        return "<p>Hello, world!</p>";
    ])
    ->run();
```

Allows you to access parameters from the URL. 

```php
echo (new µ)
    ->get('/hello/(?<name>\w+)', function ($app, $params) {
        return "<p>Hello, {$params['name']}!</p>";
    ])
    ->run();
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
    ->run();
```

Supports wildcard verbs too, because sometimes you don't care.

```php
echo (new µ)
    ->any('/', $fn)
    ->run();
```

### Flexible and powerful dependency injection container.

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
    ])
    ->run();
```
    
### Has an _elegant_, fluent interface, just cuz!

_See previous example._

### Built-in templating system

Templates are PHP files, not things with lots of {{{}}}.

```php
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
    ->run();
```

Does not include any twigs or blades, which reduces chances of injury.
