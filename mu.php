<?php class µ{function __call($m,$a){$c=&$this->{$m.$a[0]};$c=$a[1]??(is_callable($c)?$c($this):$c);return isset($a[1])?
$this:$c;}function run(){foreach($this as$x=>$f)preg_match("@$x@i","$_SERVER[REQUEST_METHOD]$_SERVER[REQUEST_URI]",$p)&&
$f($this,$p);}function view($f,$d=[]){ob_start();extract($d);require"$this->cfgviews/$f.php";return ob_get_clean();}}
