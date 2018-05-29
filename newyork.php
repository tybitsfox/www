<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<STYLE type=text/css>
/* 图片框样式 */
.imgClass {border: 0px solid #000;}
</STYLE>
<SCRIPT language=JavaScript type=text/javascript>
var imgWidth=600; //图片宽
var imgHeight=500; //图片高
var TimeOut=5000; //每张图切换时间 (单位毫秒);
var imgUrl=new Array();
var adNum=0;
var theTimer=0;
var tt=1;
var imgmine="http://images.earthcam.com/ec_metros/newyork/newyork/lindys.jpg";

document.write('<center><div id="focuseFrom">');
//焦点字框高度样式表 结束
//http://images.earthcam.com/ec_metros/newyork/newyork/lindys.jpg
var s="";
var j=0;
//var k=parseInt(pnum);
//document.write(spath+k.toString(10));
for (j=1;j<359;j++)
{
	tt=j;
	s=tt.toString(10);
	if (s.length==1)
	{
		s='00'+s;
	}
	else
	{
		if(s.length==2)
			s='0'+s;
	}
	imgUrl[tt]='./t01/'+s+'.jpg';
}

var intPage =0;
for (var i=1;i<=imgUrl.length;i++)
{
	if (imgUrl[i]!="!!!")
	{
		intPage++;
	}
}
function changeimg(n)
{
	adNum=n;
	window.clearInterval(theTimer);
	adNum=adNum-1;
	nextAd();
	return false;
}
//NetScape开始
if (navigator.appName == "Netscape")
{
//	document.write('<style type="text/css">');
//	document.write('.buttonDiv{height:4px;width:21px;}');
//	document.write('</style>');
	function nextAd()
	{
		if(adNum<100)//(intPage-1))
			adNum++;
		else adNum=1;
		theTimer=setTimeout("nextAd()", TimeOut);
		document.images.imgInit.src=imgmine;//imgUrl[adNum];
	}
	document.write('<img src="imgmine" name="imgInit" border=1  class="imgClass">');
	document.write('</div></center>');
	nextAd();
}
//NetScape结束
//IE开始
else
{
/*	var count=0;
	for (i=1;i<intPage;i++)
	 {
		if( imgUrl[i]!="" )
		 {
			count++;
		 }
		 else 
		{
			break;
		}
	}*/
	function playTran()
	{
		if (document.all)
			document.images.imgInit.filters.BlendTrans.play();
	}
	var key=0;
	function nextAd()
	{
		if(adNum<100)//count)
			adNum++ ;
		else
			 adNum=1;
		if( key==0 )
		{
			key=1;
		}
		 else if (document.all)
		{
			document.images.imgInit.filters.BlendTrans.apply();
			playTran();
		}
		document.images.imgInit.src= imgmine;//imgUrl[adNum];
		theTimer=setTimeout("nextAd()", TimeOut);
	}
	document.write('</div>');
	changeimg(1);
}
//IE结束



</SCRIPT>
<br><br><center><a href="http://www.earthcam.com/">全球摄像头</a></centr>

