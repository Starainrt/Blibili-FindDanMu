<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"/>
<meta name="referrer" content="origin-when-cross-origin"/>
<title>Bibili弹幕发送查询</title>
<style>
body {
				width:device-width;
				background-image:url('nanami.jpg');
				background-position:top;
				background-repeat:no-repeat;
				background-color:#d7e2d1;
			}
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
		.transbox
	{
		width:document.body.offsetWidth;
		margin:30px;
		background-color: #ffffff;
		/* border: 1px solid black; */
		/* for IE */
		filter:alpha(opacity=60);
		/* CSS3 standard */
		opacity:0.6;
	}
table a {  
		color: #c75f3e;  
		}  
  
	#mytable {  
		width: 700px;  
		padding: 0;  
		margin: 0;  
	}  
  
  
	table th {  
		font: bold 11px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;  
		color: #4f6b72;  
		border-right: 1px solid #C1DAD7;  
		border-bottom: 1px solid #C1DAD7;  
		border-top: 1px solid #C1DAD7;  
		letter-spacing: 2px;  
		text-transform: uppercase;  
		text-align: left;  
		padding: 6px 6px 6px 12px;  
		background: #CAE8EA url(images/bg_header.jpg) no-repeat;  
	}  
  
	th.nobg {  
		border-top: 0;  
		border-left: 0;  
		border-right: 1px solid #C1DAD7;  
		background: none;  
	}  
  
table td {  
    border-right: 1px solid #C1DAD7;  
    border-bottom: 1px solid #C1DAD7;  
    background: #fff;  
    padding: 6px 6px 6px 12px;  
    color: #4f6b72;  
}  
  
  
td.alt {  
    background: #F5FAFA;  
    color: #797268; 	
}  
  
th.spec {  
    border-left: 1px solid #C1DAD7;  
    border-top: 0;  
    background: #fff url(images/bullet1.gif) no-repeat;  
    font: bold 10px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;  
}  
  
th.specalt {  
    border-left: 1px solid #C1DAD7;  
    border-top: 0;  
    background: #f5fafa url(images/bullet2.gif) no-repeat;  
    font: bold 10px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;  
    color: #797268;  
}  
</style>
</head>
<body>
<script src="lib/function.js" ></script>
<center>
<div id='bili' class='transbox'>
<script>
 if (document.body.offsetWidth>1200)
	document.getElementById('bili').style.width=1200;
</script>
<form id="send" method="get" >

<tr>
<p><b>视频地址或AV号:分P号</b></p>
<input id="url" name="url" type="text" size=38 "/>
</tr>
<tr>
<p><b>查找弹幕</b></p>
<input id="danmu" type="text" size=38  />
</tr>
<br />
<p style="font-size: 16px;color:blue;"><input type="checkbox" id="reg" name="reg" value=1 /><b>使用正则表达式</b></p>
<tr>
<input type="button" class="button" id="find" name="find" value="查找" onclick="sendquery()"/>
<input type="button" class="button" id="btnsetsumei"  value="说明" onclick="setsumei()"/>
</tr>
</form>
<noscript>
<p><b>您的电脑不支持Javascript，本站功能您无法使用。请谅解</b></p>
</noscript>
<b><p id="setsumei" style="font-size: 16px; color:blue;"></p></b>
<b><p id="show" style="font-size: 16px;"></p></b>
<table border="0" width=80% id="showtable"  style="font-size: 16px;"></table>
</div>
</center>
</body>
</html>