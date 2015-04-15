<?php class µ{function cfg($k,$v=null){$c=&$this->$k;return isset($v)&&($c=$v)?$this:($c?(is_callable($v=$c)?$v($this):
$v):null);}function __call($m,$a){$this->{($m=='any'?'(.*)':strtoupper($m)).'#'.$a[0]}=$a[1];return$this;}function run()
{foreach($this as$x=>$f)if(preg_match("@$x@","$_SERVER[REQUEST_METHOD]#$_SERVER[REQUEST_URI]",$m))return$f($this,$m);}
function view($f,$d=[]){ob_start();extract($d);require$this->cfg('views')."/$f.php";return ob_get_clean();}}#@jeremeamia
