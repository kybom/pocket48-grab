<html>
<head>
<title>口袋48直播&录播web地址&视频源获取 v0.1 alpha</title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<style type="text/css">
td {
	font-size:14px;
	word-wrap:break-word; word-break:break-all;
}
td a {
	font-size:10px;
}
.t1 {width:180px;}
.t2 {width:120px;}
.t3 {width:120px;}
.t4 {width:60px;}
.t5 {width:80px;}
.t6 {width:75px;}
.t7 {width:60px;}
.t8 {width:100px;}
.t9 {width:125px;}
.t10 {width:120px;}
.t11 {width:100px;}
.t1, .t2, .t3, .t4, .t5, .t6, .t7, .t8, .t9, .t10, .t11{
	overflow:hidden;
}
form {
	color: #0066FF;
}
</style>
</head>
<body>
<div align="center">
<div id="header">
<h1>口袋48直播&录播web地址&视频源获取 v0.1 alpha</h1>
<p>作者：@小赛艇 联系：xsaiting@qq.com Github地址：<a href="https://github.com/czy0409/pocket48-grab/" target="_blank">pocket48-grab</a></p>
<p>说明：1、此版本为alpha测试版本，仅实现了相关功能，希望能抛砖引玉，有更多的人一起完善它</p>
<p>2、直播源推荐使用<a href="http://www.videolan.org/" target="_blank">VLC media player</a>播放，该播放器可播放m3u8文件</p>
<p>3、经测试，部分弹幕地址出问题是官方的锅，官方的弹幕地址404。
<br />时间稍久的录播才有lrc弹幕，可以将其转换为标准字幕文件配合播放器使用。</p>
<form method="post" action="<?php print $_SERVER["PHP_SELF"]?>">
	获取距离【
	<input type="radio" value="0" name="time0" checked="checked" />当前】 或
	【<input type="radio" value="1" name="time0" />
	<input type="text" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" value="2017" size="2" name="y" />年
	<input type="text" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" value="4" size="1" name="m" />月
	<input type="text" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" value="8" size="1" name="d" />日
	<input type="text" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" value="0" size="1" name="h" />时
	<input type="text" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" value="0" size="1" name="i" />分
	<input type="text" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" value="0" size="1" name="s" />秒】
	<br />的最多<input type="text" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" value="100" name="limit"></input>条直播信息
	<br />更多参数(不懂请保持默认):
	groupId<input type="text" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" value="0" size="4" name="g" />
	type<input type="text" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" value="0" size="4" name="t" />
	memberId<input type="text" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" value="0" size="4" name="me" />
	<br /><input type="submit" value="提交" />
</form>
</div>
<div id="content">
<table border="1" cellspacing="0">
<!-- 表头 begin -->
<tr>
<td class="t1"><span style="color:Red">官方web观看地址</span></td>
<td class="t2"><span style="color:Red">直播标题</span></td>
<td class="t3">副标题</td>
<td class="t4">配图</td>
<td class="t5">开始时间</td>
<td class="t6">memberId</td>
<td class="t7">直播类型</td>
<td class="t8">picLoopTime</td>
<td class="t9">弹幕地址</td>
<td class="t10"><span style="color:Red">视频源地址</span></td>
<td class="t11">screenMode</td>
</tr>
<!-- 表头 end -->
<?php
//测试用
ini_set('display_errors',1);            //错误信息  
ini_set('display_startup_errors',1);    //php启动错误信息
require_once ('post.php');
if(isset($_POST["time0"])&&isset($_POST["y"])&&isset($_POST["m"])&&isset($_POST["d"])&&isset($_POST["h"])&&isset($_POST["i"])&&isset($_POST["s"])&&isset($_POST["limit"])&&isset($_POST["g"])&&isset($_POST["t"])&&isset($_POST["me"]))
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
	echo "<td colspan='11'>暂未提交参数或参数错误，自动显示距当前100条直播</td>";
//发送请求
$get=live_get(100);
//打印表格
live_print($get);
}
?>
</table>
</div>


</div>
<?php
//测试用
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
//dump(json_decode($get,true)); 
?>
</body>
</html>
