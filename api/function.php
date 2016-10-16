<?php
/**
B站获取弹幕发送者测试代码
B站源码采用GZIP压缩！
彩虹表生成注意
加密方式crc32b-ITU I.363.5
**/
function GetURL($url,$usecurl=1,$gzip=0)
{
	@trigger_error('520', E_USER_NOTICE);  
	if ($usecurl==1)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($curl);
		curl_close($curl);
		$output=$data;
		$error=error_get_last();
		if($error['message']!='520')
			die("URL检索错误！请检查链接是否正确！url=$url");
	}else{
		$output=file_get_contents($url);
		$error=error_get_last();
		if($error['message']!='520')
			die("URL检索错误！请检查链接是否正确 信息=".$error['message']."url=$url");
	}
	if($gzip>0){
		$output=gzinflate(substr($output,$gzip));
	}elseif($gzip==0){
		$output=gzinflate($output);
	}
	return $output;
}
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
	$regstr=$infor;
	$danmu=GetDanMuInfor($cid);
	foreach ($danmu as $temp)
		{
			if($reg==1)
			{
				if (@preg_match($regstr,$temp['naiyou']))
					$result[]=$temp;
			}else{
				$pos=strpos($temp['naiyou'],$regstr);
				if ($pos === false) {
				} else {
					$result[]=$temp;
				}
			}
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
	$dir = dirname(__FILE__);
	require ($dir.'/config.php');
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
	if ($usebiliji==1)
	{
		preg_match("/av[0-9]+/i",$url,$tmp02);
		$avid=substr($tmp02[0],2);
		if(preg_match("/index_[0-9]+/i",$url,$tmp03))
			$pid=substr($tmp03[0],6);
		else
			$pid=1;
		$url="http://www.bilibilijj.com/Api/AvToCid/$avid/$pid";
	}
	if($usebiliji==0)
		$output=GetURL($url,0,10);
	else
		$output=GetURL($url,0,-1);
	if (preg_match("/错误号: 502/",$output))
		die("视频CID获取错误！错误号：502 B站解析错误");
	if ($usebiliji==0)
	{
		$regstr="/(cid=)[0-9]+&/smi";
		if (preg_match($regstr,$output,$precid))
		{
			$cid=substr($precid[0],4,strlen($precid[0])-5);
		}
	}else{
		$regstr='/(CID|cid).{0,8}[0-9]+/';
		if (preg_match($regstr,$output,$precid))
		{
			preg_match('/[0-9]+/',$precid[0],$precid);
			$cid=$precid[0];
		}
	}
	return $cid;
}
function GetDanMuByCid($cid)
{
	$dir = dirname(__FILE__);
	require ($dir.'/config.php');
	$url="http://comment.bilibili.com/".$cid.".xml";
	$output=GetURL($url,$usecurl,0);
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
	require_once($dir.'/database.php');
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
		$output=GetURL($url,$usecurl,0);
		$regstr="/[1-9][0-9]+/";
		if (preg_match($regstr,$output,$result))
			return $result[0];
	}else{
		return $num[0];
	}
}
?>