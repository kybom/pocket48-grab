<?php
//预处理数据、发送请求并返回数据

//测试用

//ini_set('display_errors',1);            //错误信息  
//ini_set('display_startup_errors',1);    //php启动错误信息
//初始化
 $time0="";
 $y="";
 $m="";
 $d="";
 $h="";
 $i="";
 $s="";
 $limit="";
 $g="";
 $me="";
 $t="";

require_once ('functions.php');
function empty_0 ($i) {
	if ($i=="") {
		return 1;
	} else {
		return 0;
	}
}
if(!(empty_0($_POST["limit"])||empty_0($_POST["time0"])||empty_0($_GET["f"])))
//检查变量是否非空
{
//获取POST数据
 $time0=$_POST["time0"];
 $y=$_POST["y"];
 $m=$_POST["m"];
 $d=$_POST["d"];
 $h=$_POST["h"];
 $i=$_POST["i"];
 $s=$_POST["s"];
 $limit=$_POST["limit"];
 $g=$_POST["g"];
 $me=$_POST["me"];
 $t=$_POST["t"];
 
//预处理
 if ($time0=="1") {
 $time=strtotime($y.'-'.$m.'-'.$d.' '.$h.':'.$i.':'.$s)."000";
 } else {
 $time=0;
 }


//发送请求、打印表格
$f=$_GET["f"];
if ($f==0) {
$get=live_get($limit,$time,$g,$me,$t);
live_print($get);
} elseif ($f==1) {
$get=openlive_get($limit,$time,$g,1);
openlive_print($get,$f);
} elseif ($f==2) {
$get=openlive_get($limit,$time,$g,0);
openlive_print($get,$f);
}



} else {
header('HTTP/1.1 400 Bad Request');
echo "400 Bad Request";
}

//测试用
/*
function dump($vars, $label = '', $return = false) {
    if (ini_get('html_errors')) {
        $content = "<pre>\n";
        if ($label != '') {
            $content .= "<strong>{$label} :</strong>\n";
        }
        $content .= htmlspecialchars(print_r($vars, true));
        $content .= "\n</pre>\n";
    } else {
        $content = $label . " :\n" . print_r($vars, true);
    }
    if ($return) { return $content; }
    echo $content;
    return null;
}
dump(json_decode($get,true));
*/
?>