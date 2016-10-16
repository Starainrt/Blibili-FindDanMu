<?php
require_once("./api/database.php");
$dbres=mysql_connect($dbaddr,$dbuser,$dbpass) ;
if(!$dbres)
	die("无法连接！".mysql_error());
mysql_select_db($dbname) or die("数据库无法选择.mysql_error()");
$kotoba="CREATE TABLE IF NOT EXISTS $dbpre"."HashResult(id INT(10) UNSIGNED NOT NULL,res VARCHAR(12) NOT NULL,PRIMARY KEY(id))CHARACTER SET utf8 COLLATE utf8_general_ci;";
$shres=mysql_query($kotoba);
if(!$shres) die('错误！数据表创建失败！'.mysql_error());
echo "创建HASH表成功<br />";
$kotoba="SELECT COUNT(*) FROM $dbpre"."HashResult;";
$shres=mysql_query($kotoba);
$num=mysql_fetch_row($shres);
echo "已写入$num[0]条";
for($i=$num[0];$i<52000000;$i++)
{
	$kotoba="INSERT INTO $dbpre"."HashResult VALUES('".$i."','".hash("crc32b",$i)."');";
	//echo $kotoba;
	$shres=mysql_query($kotoba);
	if(!$shres) die('错误！数据表写入失败！'.mysql_error());
}
mysql_close($dbres);
echo "<p>安装成功</p>";
