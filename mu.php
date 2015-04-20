<?php class µ{function cfg($k,$v=null){$c=&$this->$k;if($v===null)return is_callable($c)?($c=$c($this)):$c;$c=$v;return
$this;}function __call($m,$a){$this->{($m=='any'?'(.*)':strtoupper($m))."#$a[0]"}=$a[1];return$this;}function run(){
foreach($this as$x=>$f)if(preg_match(~ø€áø,~€†¨∫≠©∫≠§≠∫Æ™∫¨´†≤∫´∑∞ª¢‹€†¨∫≠©∫≠§≠∫Æ™∫¨´†™≠∂¢,$p))return$f($this,$p);}
function view($f,$d=[]){ob_start();extract($d);require$this->cfg('views')."/$f.php";return ob_get_clean();}}#@jeremeamia
