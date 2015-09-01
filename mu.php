<?php class µ{function cfg($k,$v=null){$c=&$this->$k;if($v===null)return$c=is_callable($c)?$c($this):$c;$c=$v;return
$this;}function __call($m,$a){$this->{($m=='any'?'':$m).$a[0]}=$a[1];return$this;}function run($m,$u){foreach($this
as$x=>$f)if(preg_match("@$x@i",$m.$u,$p))return$f($this,$p);}function view($f,$d=[]){ob_start();extract($d);require
"$this->views/$f.php";return ob_get_clean();}}