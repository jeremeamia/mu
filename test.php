<?php

error_reporting(-1);
require __DIR__.'/vendor/autoload.php';
function Ω($d){static$n=1;echo'['.($n++)."] {$d}\n";}
function ø($m,$r){$_SERVER['REQUEST_METHOD']=$m;$_SERVER['REQUEST_URI']=$r;}
echo "Testing the µ PHP framework.\n";

Ω('Instances of µ can be created.');
$µ = new µ;
assert('$µ instanceof µ');

Ω('Method calls on the µ are chainable.');
$µ´ = $µ->cfg('greeting', 'howdy');
assert('$µ´ === $µ');
Ω('Values can be stored in the DIC.');
assert('$µ->greeting === "howdy"');

Ω('Values can be retrieved from the DIC.');
$ñ = $µ->cfg('greeting');
assert('$ñ === "howdy"');

Ω('Closure values in the DIC have access to the µ and are resolved when retrieved.');
$called = 0;
$µ->cfg('greeting.upper', function (µ$app) use (&$called) {
    $called++;
    return strtoupper($app->cfg('greeting'));
});
$ñ = $µ->cfg('greeting.upper');
assert('$called == 1') and assert('$ñ === "HOWDY"');

Ω('Resolved closure values in the DIC are memoized.');
$ñ = $µ->cfg('greeting.upper');
assert('$called == 1') and assert('$ñ === "HOWDY"');

Ω('Router allows for regex expressing named params, including optional ones.');
$ç = false;
$µ = (new µ)->get('/foo/(?<bar>\w+)(?:/(?<baz>\w+))?', function ($µ, $π) use (&$ç) {
    assert('$µ instanceof µ');
    assert('$π["bar"] === "one"');
    assert('!isset($π["baz"])');
    $ç = true;
});
ø('GET', '/foo/one');
$µ->run();
assert('$ç === true');

Ω('NULL is returned when the µ is run if no routes match.');
$ç = false;
$µ = (new µ)->post('/foo/(?<bar>\w+)', function () use (&$ç) {
    $ç = true;
});
ø('GET', '/foo/one');
$ñ = $µ->run();
assert('$ç === false');
assert('$ñ === null');

Ω('Templating (view) system replaces variables with provided values.');
$dir = sys_get_temp_dir().'/mu-view-test';
$file = $dir.'/tpl.php';
!is_dir($dir) and mkdir($dir);
file_put_contents($file, '[<?=$foo?>]');
$ñ = (new µ)->cfg('views', $dir)->view('tpl', ['foo' => 'bar']);
unlink($file);
rmdir($dir);
assert('$ñ === "[bar]"');
