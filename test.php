<?php
$url="http://www.bilibili.com/video/av648584/index_11.html";
	$output =file_get_contents($url);
	echo file_get_contents($url);
	$output=gzinflate(substr($output,10));
	echo $output;
	$regstr="/(cid=)[0-9]+&/smi";
	if (preg_match($regstr,$output,$precid))
	{
		$cid=substr($precid[0],4,strlen($precid[0])-5);
		echo $cid;
	}
	echo "ok";
	?>