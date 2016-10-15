<?php
date_default_timezone_set('PRC');
if (!isset($_GET['type']))
	die("<infor>404</infor>");
$type=$_GET['type'];
require_once('function.php');
if($type=='usermid'){
	if (!isset($_GET['hash']))
		die("<infor>nohashi</infor>");
	$hash=$_GET['hash'];
	//echo "<userid>".GetUserIdByHash($hash)."</userid>";
	echo GetUserIdByHash($hash);
}elseif($type=='userhash'){
	if (!isset($_GET['mid']))
		die("<infor>nomid</infor>");
	$mid=$_GET['mid'];
	echo "<userhash>".UserHash($mid)."</userhash>";
}elseif($type=="find"){
	if (!isset($_GET['u']))
		die("<infor>nourl</infor>");
	$url=$_GET['u'];
	if (!isset($_GET['i']))
		die("<infor>nofind</infor>");
	$infor=$_GET['i'];
	if (isset($_GET['s']))
		$s=$_GET['s'];
	else
		$s=0;
	ShowDanMu(FindDanMuByInfor($infor,GetCidByURL($url),$s));
}elseif($type=="findbyuser"){
	if (!isset($_GET['u']))
		die("<infor>nourl</infor>");
	$url=$_GET['u'];
	if (!isset($_GET['m']))
		die("<infor>nomid</infor>");
	$mid=$_GET['m'];
	if (isset($_GET['s']))
		$s=$_GET['s'];
	else
		$s=0;
	if ($s==0)
		$mid=UserHash($mid);
	ShowDanMuByUser(FindDanMuByHash($mid,GetCidByURL($url),$s));
}
function ShowDanMuByUser($source){
	if($source!=404){
		if(empty($source))
			die("未找到相关弹幕");
		echo "手机用户横屏食用更加哦~<br />";
		echo "结果数：".count($source)."<br />";
		echo "弹幕内容 - - - 出现时间 - - - 发送时间.<br />";
		foreach ($source as $tmp1)
			{
				$date=date('Y-m-d H:i',$tmp1['stime']);
				echo $tmp1['naiyou']." - - - ".floor($tmp1['atime']/60)."min".(($tmp1['atime']/60-floor($tmp1['atime']/60))*60)."s - - - ".$date."<br />";
			}
	}else{
		echo "出现未知错误";
	}
}
function ShowDanMu($source)
{
	if($source!=404){
		if(empty($source))
			die("未找到相关弹幕");
		echo "手机用户横屏食用更加哦~<br />";
		echo "结果数：".count($source)."<br />";
		echo "弹幕内容 - - - 出现时间 - - - 发送时间.<br />";
		foreach ($source as $tmp1)
			{
				$date=date('Y-m-d H:i',$tmp1['stime']);
				echo $tmp1['naiyou']." - - - ".floor($tmp1['atime']/60)."min".(($tmp1['atime']/60-floor($tmp1['atime']/60))*60)."s - - - ".$date." - <a id='".$tmp1['hash']."' name='".$tmp1['hash']."' href='javascript:void(0);' onclick=".'"baopo('."'".$tmp1['hash']."')".'"'.">破解信息</a> <br />";
			}
	}else{
		echo "出现未知错误";
	}
}