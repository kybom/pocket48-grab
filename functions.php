<?php
//定义常量

//api地址
define("LIVE_API", "https://plive.48.cn/livesystem/api/live/v1/memberLivePage");

//直播分享地址前缀
define("LIVE_SHARE", "https://h5.48.cn/2017appshare/memberLiveShare/index.html?id=");

//图片、弹幕服务器
define("LIVE_PIC", "https://source.48.cn");

//数据表顺序
$order=array(
	"memberId",
	"title",
	"subTitle",
	"liveType",
	"startTime",
	"picPath",
	"liveId",
	"streamPath",
	"lrcPath",
	"picLoopTime",
	"screenMode"
);

//获取直播、录播json数据
function live_get ($limit='100',$lasttime='0',$groupId='0',$memberId='0',$type='0',$api=LIVE_API,$giftUpdTime='1498211389003')
{
$data = array(
	"lastTime" => $lasttime,	//从此刻起获取之前的直播，毫秒时间戳
	"groupId" => $groupId,	//xxx48组
	"type" => $type,
	"memberId" => $memberId,	//成员Id
	"giftUpdTime" => $giftUpdTime,	//礼物更新时间，毫秒时间戳
	"limit" => $limit	//最多多少条
	);                              
$data_string = json_encode($data);
$ch = curl_init($api);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(          
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string)) 
);
$result = curl_exec($ch);
return $result;
}

//解析数据未来可以考虑在浏览器js完成

//解析数据
function live_print ($result) {
	$data=json_decode($result,true);
	if(!empty($data["content"]["liveList"])){
	echo '<tr><td colspan="11"><span style="color:Red">----------分界线，以下为直播----------</span></td></tr>';
		foreach ($data["content"]["liveList"] as $id => $content) {
		echo '<tr>';
		tablelist($content);
		echo '</tr>';
	}
	}
	if(!empty($data["content"]["reviewList"])){
	echo '<tr><td colspan="11"><span style="color:Red">----------录播分界线，以下为录播----------</span></td></tr>';
	foreach ($data["content"]["reviewList"] as $id => $content) {
		echo '<tr>';
		tablelist($content);
		echo '</tr>';
	}
	}
}

//辅助函数 将直播、录播数据提取的内容打印成一列

function tablelist($content) {
	global $order;
	foreach ($order as $key) {
		$value=$content[$key];
		switch ($key) {
			case "liveId": //07官方地址
				echo '<td class="t7"><a href="'.LIVE_SHARE.$value.'"  target="_blank">'.LIVE_SHARE.$value.'</a></td>';
				break;
			case "title": //02标题
				echo '<td class="t2">'.$value.'</td>';
				break;
			case "subTitle": //03副标题
				echo '<td class="t3">'.$value.'</td>';
				break;
			case "picPath": //06配图地址
				echo '<td class="t6">';
				$pics = explode(',',$value);
				foreach ($pics as $values) {
				echo '<img src="'.LIVE_PIC.$values.'" style="max-width:30px; max-height:30px" />';
				};
				echo '</td>';
				break;
			case "startTime": //05直播开始时间
				echo '<td class="t5">'.date("Y-m-d",substr($value,0,10)).'<br />'.date("H:i:s",substr($value,0,10)).'</td>';
				break;
			case "memberId": //01成员ID
				echo '<td class="t1">'.$value.'</td>';
				break;
			case "liveType": //04直播类型
				echo '<td class="t4">';
				if ($value=="1") {
					echo '视频';
				}
				else if ($value=="2") {
					echo '电台';
				}
				else {
					echo 'U_'.$value;
				}
				echo '</td>';
				break;
			case "picLoopTime": //10图片循环时间
				echo '<td class="t10">'.$value.'</td>';
				break;
			case "lrcPath": //09弹幕文件地址
				echo '<td class="t9"><a href="'.LIVE_PIC.$value.'"  target="_blank">'.LIVE_PIC.$value.'</a></td>';
				break;
			case "streamPath": //08视频源地址
				echo '<td class="t8"><a href="'.$value.'"  target="_blank">'.$value.'</a></td>';
				break;
			case "screenMode": //??
				echo '<td class="t11">'.$value.'</td>';
				break;
		}
	}
}
?>