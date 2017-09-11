<?php
//定义常量

//api地址
define("LIVE_API", "https://plive.48.cn/livesystem/api/live/v1/memberLivePage");

//直播分享地址前缀
define("LIVE_SHARE", "https://h5.48.cn/2017appshare/memberLiveShare/index.html?id=");

//图片服务器
define("LIVE_PIC", "https://source.48.cn");


//获取直播、录播json数据
function live_get ($limit='100',$lasttime='0',$groupId='0',$type='0',$memberId='0',$api=LIVE_API)
{
$data = array(
	"lastTime" => $lasttime,
	"groupId" => $groupId,
	"type" => $type,
	"memberId" => $memberId,
	"giftUpdTime" => '1498211389003',
	"limit" => $limit
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
//将直播、录播数据打印成表格
function live_print ($result) {
	$data=json_decode($result,true);
	echo '<td colspan="11"><span style="color:Red">----------分界线，以下为直播----------</span></td>';
	foreach ($data["content"]["liveList"] as $id => $content) {
		echo '<tr>';
		tablelist($content);
		echo '</tr>';
	}
	echo '<td colspan="11"><span style="color:Red">----------录播分界线，以下为录播----------</span></td>';
	foreach ($data["content"]["reviewList"] as $id => $content) {
		echo '<tr>';
		tablelist($content);
		echo '</tr>';
	}
}
//辅助函数 将直播、录播数据提取的内容打印成一列
function tablelist($content) {
	foreach ($content as $key => $value) {
		switch ($key) {
			case "liveId": //官方地址
				echo '<td class="t1"><a href="'.LIVE_SHARE.$value.'"  target="_blank">'.LIVE_SHARE.$value.'</a></td>';
				break;
			case "title": //标题
				echo '<td class="t2">'.$value.'</td>';
				break;
			case "subTitle": //副标题
				echo '<td class="t3">'.$value.'</td>';
				break;
			case "picPath": //配图地址
				echo '<td class="t4">';
				$pics = explode(',',$value);
				foreach ($pics as $values) {
				echo '<img src="'.LIVE_PIC.$values.'" style="max-width:30px; max-height:30px" />';
				};
				echo '</td>';
				break;
			case "startTime": //直播开始时间
				echo '<td class="t5">'.date("Y-m-d H:i:s",substr($value,0,10)).'</td>';
				break;
			case "memberId": //成员ID
				echo '<td class="t6">'.$value.'</td>';
				break;
			case "liveType": //直播类型
				echo '<td class="t7">';
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
			case "picLoopTime": //图片循环时间
				echo '<td class="t8">'.$value.'</td>';
				break;
			case "lrcPath": //弹幕文件地址
				echo '<td class="t9"><a href="'.LIVE_PIC.$value.'"  target="_blank">'.LIVE_PIC.$value.'</a></td>';
				break;
			case "streamPath": //视频源地址
				echo '<td class="t10"><a href="'.$value.'"  target="_blank">'.$value.'</a></td>';
				break;
			case "screenMode": //??
				echo '<td class="t11">'.$value.'</td>';
				break;
			}
		}
}

//将直播、录播数据转换成可读数组(未完成，暂不需要)
//未来考虑修改成 获取json数据=>转换调整顺序=>打印成表格 的流程
//或者php仅用来获取数据，用javascript来处理json数据
function live_trans ($result) {
	$trans=array(
	"livelist" => array(),
	"reviewlist" => array(),
	);
	$data=json_decode($result,true);
	foreach ($data["content"]["livelist"] as $key => $value) {
	
	}
	foreach ($data["content"]["reviewlist"] as $key => $value) {
	
	}
}
?>