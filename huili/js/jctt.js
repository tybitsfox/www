function chlinkfunc()
{
	var str=window.document.location.href.toString();
	var b=str.split('=');
	if(typeof(b[1]) == 'string')
	{
		var i;
		var c=b[1].substr(0,32);
		for(i=0;i<liaa.length;i++)
		{
			if(liaa[i][1] == c)
			{
				document.getElementById(liaa[i][0]).className='liaa[i][2] active';
				document.getElementById(liaa[i][0]).style.color='#3EAE48';
				break;
			}
		}
		if(i >= liaa.length)
			document.getElementById(liaa[0][0]).className='liaa[0][2] active';
	}
	else
		document.getElementById(liaa[0][0]).className='liaa[0][2] active';
}
function set_min(u)
{
	var ay;
	var str=document.getElementById('upmodule');
	if(str == null)
		return;
	if(str.length == 0)
		ay=array();
	else
		ay=str.value.split(',');
	var i,st;
	i=u.length-1;
	st=u.substring(6,i);
	var a=document.getElementById(u).className.toString();
	if(a.match('plus'))
	{
		document.getElementById(u).className='icon-minus';
		document.getElementById(u).style='color:#455f6c';
		ay.push(st);
	}
	else
	{
		document.getElementById(u).className='icon-plus';
		document.getElementById(u).style='color:#fff';
		i=ay.indexOf(st);
		ay.splice(i,1);
	}
	str.value=ay;
}
//下面的函数是个人设置-认证界面所用，用于在移动设备显示时提示当前的操作
function chg_msg(i)
{
	var a=document.getElementById('tip_msg1');
	var s=a.innerHTML;
	if(s.match(/strong/i) == null)
	{
		if(i == 1)//专家
			a.innerHTML='<p>专家认证申请</p>';
		else
			a.innerHTML='<p>团队认证申请</p>';
	}
}
//下面的函数是个人设置-我的合作界面所用，用于在移动设备显示时提示当前的操作
function chg_msg_coll(i)
{
	var a=document.getElementById('tip_msg2');
	var s=a.innerHTML;
	switch(i)
	{
	case 1:
		a.innerHTML='<p>我的专家组</p>';
		break;
	case 2:
		a.innerHTML='<p>我的合作团队</p>';
		break;
	case 3:
		a.innerHTML='<p>查找新的专家</p>';
		break;
	case 4:
		a.innerHTML='<p>查找新的团队</p>';
		break;
	default:
		a.innerHTML='<p>我的合作伙伴</p>';
	}
}
//jquery 应用
$(document).ready(function(){
		$("#btslide1").click(function(){
				$("#slide1").slideToggle("slow");
				});
		});
//动态加载css，js
function loadscript(fn,ft)
{
	if(ft == "js")
	{
      var f = document.createElement('script');
	  f.setAttribute("type","text/javascript");
	  f.setAttribute("src",fn);  
	}
	else if(ft == "css")
	{
		var f=document.createElement('link');
		f.setAttribute("rel","stylesheet");
		f.setAttribute("type","text/css");
		f.setAttribute("href",fn);
	}
	if(typeof f != "undefined")
	{document.getElementsByTagName("head")[0].appendChild(f);}
}
