function sendquery()
{	
	xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			clearTimeout(t);
			document.getElementById('show').innerHTML=xmlhttp.responseText;
			document.getElementById('find').value="查找";
		}
	}
	var url=document.getElementById('url').value;
	var danmu=document.getElementById('danmu').value;
	if(url.replace(/(^\s*)|(\s*$)/g, "").length==0) 
	{
		alert("网址不能为空哦~");
		return 0;
	}
	if(danmu.length==0) 
	{
		alert("用户mid不能为空哦~");
		return 0;
	}
	if(document.getElementById('reg').checked==true)
		reg=1;
	else
		reg=0;
	xmlhttp.open("GET","api/?type=findbyuser&u="+url+"&m="+danmu+"&s="+reg);
	xmlhttp.send();
	t=setTimeout("timed()",25000);
	document.getElementById('find').value="查找中，请稍后...";
}
function timed()
{
	document.getElementById('find').value="查找";
	alert("由于网络原因，弹幕拉取失败！");
}
function baopo(hash)
{
	xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var infor=xmlhttp.responseText;
			var allinput=document.getElementsByTagName("*");
			for ( var i = 0; i < allinput.length; i++)  
			{	
				if(allinput[i].name==hash){
					if(infor.length>0){
						allinput[i].innerHTML="http://space.bilibili.com/"+infor;
						allinput[i].href="http://space.bilibili.com/"+infor;
						allinput[i].onclick="http://space.bilibili.com/"+infor;
					}else{
						allinput[i].innerHTML="游客或被封禁";
						allinput[i].onclick='alert("游客用户或被管理员封禁");';
					}
				}
			}
		}
	}
	url=document.getElementById('url').value;
	danmu=document.getElementById('danmu').value;
	xmlhttp.open("GET","api/?type=usermid&hash="+hash);
	xmlhttp.send();
	var p=document.getElementsByTagName("*");
	for ( var i = 0; i < p.length; i++)  
    {   
      if (p[i].name==hash)  
		p[i].innerHTML="破解中，请稍后";
	}
}
function setsumei()
{
	var stm=document.getElementById("btnsetsumei");
	if(stm.value=="说明"){
		document.getElementById("setsumei").innerHTML="这是一个可以查询具体某个用户在B站具体某个视频上发出的所有弹幕的网站。<br />先在第一个输入框中输入视频地址或av号，分P号。<br />比如 av10000:3 就代表av号为10000视频的第3个分P。<br />再在第二个输入框中输入查询用户的MID，MID可以在用户空间里与网址上找到<br />哈希模式适用于游客及被屏蔽用户";
		stm.value="收起说明";
	}else{
		stm.value="说明";
		document.getElementById("setsumei").innerHTML="";
	}
}
