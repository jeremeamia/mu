<?php class µ{var$Δ;function __call($m,$a){$c=&$this->Δ[$m.$a[0]];$c=$a[1]??(is_callable($c)?$c($this):$c);return($a[1]
??0)?$this:$c;}function view($d,$f,$s=[]){ob_start();extract($s);require"$d/$f.php";return ob_get_clean();}function run
(){foreach($this->Δ as$x=>$f)preg_match("@$x@i","$_SERVER[REQUEST_METHOD]$_SERVER[REQUEST_URI]",$p)&&$f($this,$p);}}#JL
