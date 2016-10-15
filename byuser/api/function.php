<?php
/**
B站获取弹幕发送者测试代码
B站源码采用GZIP压缩！
彩虹表生成注意
加密方式crc32b-ITU I.363.5
**/
function FindDanMuByHash($hash,$cid)
{
	@trigger_error('520', E_USER_NOTICE);  
	$regstr="/^".$hash."$/";
	$danmu=GetDanMuInfor($cid);
	foreach ($danmu as $temp)
		{
			if (@preg_match($regstr,$temp['hash']))
				$result[]=$temp;
		}
	$error = error_get_last(); 
	if($error['message']!='520')
		$result=404;
	if(!isset($result))$result=NULL;
	return $result;
}
function FindDanMuByInfor($infor,$cid,$reg=0)
{
	@trigger_error('520', E_USER_NOTICE);  
	if($reg!=1)
		$regstr='/('.$infor.')+/si';
	else
		$regstr=$infor;
	$danmu=GetDanMuInfor($cid);
	foreach ($danmu as $temp)
		{
			if (@preg_match($regstr,$temp['naiyou']))
				$result[]=$temp;
		}
	$error = error_get_last(); 
	if($error['message']!='520')
		$result=404;
	if(!isset($result))$result=NULL;
	return $result;
}
function GetDanMuInfor($cid)
{
	$xml=simplexml_load_string(GetDanMuByCid($cid));
	foreach ($xml->d as $re)
	{
		$tmp=preg_split('/,/',$re['p']);
		//"弹幕出现时间,模式,字体大小,颜色,发送时间戳,弹幕池,用户Hash,数据库ID"
		$tmps=array(
			'atime'=>$tmp[0],
			'mode'=>$tmp[1],
			'wbig'=>$tmp[2],
			'color'=>$tmp[3],
			'stime'=>$tmp[4],
			'dmc'=>$tmp[5],
			'hash'=>$tmp[6],
			'db'=>$tmp[7],
			'naiyou'=>$re
		);
		$danmu[]=$tmps;
	}
	return $danmu;
}
function GetCidByURL($url)
{
	if(strlen(trim($url))==0) die("<error>nourl</error>");
	if(!preg_match("/^https?:\/\//i",$url))
	{
		if(!preg_match("/:/i",$url))
		{
			$url="http://www.bilibili.com/video/".$url;
		}else{
			$url="http://www.bilibili.com/video/".str_replace(":","/index_",$url).".html";
		}
	}
	$output =@file_get_contents($url);
	$output=@gzinflate(substr($output,10));
	$regstr="/(cid=)[0-9]+&/smi";
	if (preg_match($regstr,$output,$precid))
	{
		$cid=substr($precid[0],4,strlen($precid[0])-5);
		return $cid;
	}
}
function GetDanMuByCid($cid)
{
	@trigger_error('520', E_USER_NOTICE);  
	$url="http://comment.bilibili.com/".$cid.".xml";
	$output=@file_get_contents($url);
	$error=error_get_last();
	if($error['message']!='520')
		die("弹幕读取错误！请检查链接是否正确！");
	$output=gzinflate($output);
	return $output;
}

function UserHash($userid)
{
	if(!is_numeric($userid))
		return -1;
	return hash("crc32b",$userid);
}
function GetUserIdByHash($userhash)
{
	$dir = dirname(__FILE__);
	if(preg_match("/[^0-9a-zA-Z]+/",$userhash))
		return -1;
	require_once($dir.'/config.php');
	if($usedb==1){
		$dbres=mysql_connect($dbaddr,$dbuser,$dbpass) ;
		if(!$dbres)
			die("无法连接！".mysql_error());
		mysql_select_db($dbname) or die("数据库无法选择.mysql_error()");
		$kotoba="SELECT id FROM $dbpre"."HashResult WHERE res='".$userhash."';";
		$shres=mysql_query($kotoba);
		if(!$shres) die('错误！读取失败！'.mysql_error());
		$num=mysql_fetch_row($shres);
		if($num[0]==0)$num[0]=NULL;
	}
	if(!isset($num)) $num[0]=NULL;
	if ($num[0]==NULL)
	{
		$url="http://biliquery.typcn.com/api/user/hash/".$userhash;
		$output=file_get_contents($url);
		$regstr="/[1-9][0-9]+/";
		if (preg_match($regstr,$output,$result))
			return $result[0];
	}else{
		return $num[0];
	}
}
?>