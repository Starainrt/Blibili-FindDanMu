<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"/>
<meta name="referrer" content="origin-when-cross-origin"/>
<title>Bibili弹幕发送查询</title>
<style>
h2{
				font-family: '华文楷体';
				font-size: 29px;
				color:#10DDFA; //59D2E8;
				line-height: 2em;
				text-align: center;
		}
		p{
			font-family: '华文楷体';
				font-size: 22px;
				color:red;
				line-height: 2em;
				text-align: center;
				margin: 0 0 0 0;
				text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
		}
		a{
			
			font-family:"华文楷体";
			font-size:17px;
		
		}
		.button{
			width:140px;
			height:30px;
			display: inline-block;
			outline: none;
			cursor: pointer;
			text-align: center;
			text-decoration: none;
			font: 18px 楷体,Arial, Helvetica, sans-serif;
			-webkit-box-shadow: 0 1px 8px 2px rgba(0, 0, 0, 0.3);
			-moz-box-shadow: 0 1px 8px 2px rgba(0, 0, 0, 0.3);
			box-shadow: 0 1px 8px 2px rgba(0, 0, 0, 0.3);
		}
	</style>
</head>
<body>
<script src="lib/function.js" ></script>
<form id="send" method="get" >
<center>
<tr>
<p>视频地址或AV号:分P号</p>
<input id="url" name="url" type="text" size=38 "/>
</tr>
<tr>
<p>查找弹幕</p>
<input id="danmu" type="text" size=38  />
</tr>
<br />
<p style="font-size: 16px;color:blue;"><input type="checkbox" id="reg" name="reg" value=1 />使用正则表达式</p>
<tr>
<input type="button" class="button" id="find" name="find" value="查找" onclick="sendquery()"/>
<input type="button" class="button" id="btnsetsumei"  value="说明" onclick="setsumei()"/>
</tr>
<noscript>
<p>您的电脑不支持Javascript，本站功能您无法使用。请谅解</p>
</noscript>
<p id="setsumei" style="font-size: 16px; color:blue;"></p>
<p id="show" style="font-size: 16px;"></p>
</center>
</form>