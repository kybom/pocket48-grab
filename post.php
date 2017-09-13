<?php
//预处理数据、发送请求并返回数据

//测试用

ini_set('display_errors',1);            //错误信息  
ini_set('display_startup_errors',1);    //php启动错误信息


require_once ('functions.php');
function empty_0 ($i) {
	if ($i=="") {
		return 1;
	} else {
		return 0;
	}
}
if(!(empty_0($_POST["time0"])||empty_0($_POST["y"])||empty_0($_POST["m"])||empty_0($_POST["d"])||empty_0($_POST["h"])||empty_0($_POST["i"])||empty_0($_POST["s"])||empty_0($_POST["limit"])||empty_0($_POST["g"])||empty_0($_POST["t"])||empty_0($_POST["me"])))
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
 $t=$_POST["t"];
 $me=$_POST["me"];
 
//预处理
 if ($time0=="1") {
 $time=strtotime($y.'-'.$m.'-'.$d.' '.$h.':'.$i.':'.$s)."000";
 } else {
 $time=0;
 }

//发送请求
$get=live_get($limit,$time,$g,$t,$me);


//打印表格
live_print($get);

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