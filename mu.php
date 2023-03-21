<?php class µ{private $d=[];function __call($m,$a){$k=$m.$a[0];$c=&$this->d[$k];$c=$a[1]??(is_callable($c)?$c($this):$c);return isset($a[1])?
$this:$c;}function run(){foreach($this->d as$x=>$f){preg_match("@$x@i","$_SERVER[REQUEST_METHOD]$_SERVER[REQUEST_URI]",$p)&&
$f($this,$p);}}function view($f,$d=[]){ob_start();extract($d);require"$this->d['cfgviews']}/$f.php";return ob_get_clean();}}
