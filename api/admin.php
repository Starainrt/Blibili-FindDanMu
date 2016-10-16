<html>
<meta charset="utf-8"/> 
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"/>
<meta name="referrer" content="origin-when-cross-origin"/>
<head>
<title>管理</title>
</head>
<body>
<center>
<h1>当前设置</h1>
<form method="get" action="admin.php">
<?php
require_once("./config.php");
if(isset($_GET['curl']) && isset($_GET['biliji']))
{
	$usecurl=$_GET['curl'];
	$usebiliji=$_GET['biliji'];
	if(!preg_match("/^[0-1]$/",$usecurl) || !preg_match("/^[0-1]$/",$usebiliji))
		die("存在非法字符！");
	$nfs=fopen('config.php',"wb"); //打开文件，使用二进制
	flock($nfs,LOCK_EX);
	$out='<?php'."\n".'$usecurl='."$usecurl;"."\n".'$usebiliji='."$usebiliji;";
	$out=$out."\n".'?>';
	fwrite($nfs,$out,strlen($out));
	flock($nfs,LOCK_UN);
	fclose($nfs);
}
echo "<tr><p>是否使用CURL</p><input type=\"text\" id=\"curl\" name=\"curl\" value=\"".$usecurl."\" /></tr>";
echo "<tr><p>是否使用BIlibiliji提供的API</p><input type=\"text\" id=\"biliji\" name=\"biliji\" value=\"".$usebiliji."\" /></tr>";
?>
<br />
<input type="submit" value="提交" />
</form>
</center>
</body>
</html>