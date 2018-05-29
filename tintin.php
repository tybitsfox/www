<STYLE type=text/css>
/* 数字按钮框样式 */
#imgTitle {FILTER:ALPHA(opacity=70);position:relative;left:0px;text-align:left;overflow: hidden;}
#imgTitle_up {left:0px;text-align: left; height:1px; width:inherit; }
#imgTitle_down {left:0px;text-align: right; width:inherit; }
/* 图片框样式 */
.imgClass {border: 0px solid #000;}
/* 图片文字框样式 */
#txtFrom {text-align: center;vertical-align: middle; color:#333333}
/* 数字按钮样式 */
.button {text-decoration: none; float:left; height:12px; line-height:12px; padding-left:7px; padding-right:6px;background: #7B7B63;margin: 0px;font: bold 9px sans-serif; border-left:#fff 1px solid;}
a.button, a.button:link, a.button:visited {font-family: sans-serif;text-decoration: none;color:#FFFFFF;background-color: #000000;}
a.button:hover {font-family: sans-serif;text-decoration: none;color:#fff;background:#fff; }
.buttonDiv {background: #000000;height: 1px;width: 21px;float: left;text-align: center; vertical-align: middle;}
/*渐变*/
.trans { width:88px; height:12px; overflow:hidden}

</STYLE>
<SCRIPT language=JavaScript type=text/javascript>
var imgWidth=600; //图片宽
var imgHeight=500; //图片高
var textFromHeight=21; //焦点字框高度 (单位为px)
var textStyle="bt_link"; //焦点字class style (不是连接class)
var textLinkStyle="FONT"; //焦点字连接class style
var buttonLineOn="#ce0609"; //button下划线on的颜色
var buttonLineOff="#000"; //button下划线off的颜色
var TimeOut=3000; //每张图切换时间 (单位毫秒);
var imgUrl=new Array();
var imgLink=new Array();
var imgtext=new Array();
var imgAlt=new Array();
var adNum=0;
var theTimer=0;
var tt=1;
//焦点字框高度样式表 开始
document.write('<center><div id="focuseFrom">');
//焦点字框高度样式表 结束
var s="";

tt=1;
s=tt.toString(10);
if (s.length==1)
s='00'+s;
imgUrl[tt] =' ./t01/'+s+'.jpg';
//'001.jpg ';
imgtext[tt]=' tintin';
imgLink[tt]='http://tiny.meibu.com';
imgAlt[tt]=' 04年黑色桑塔纳（顶配） ';

tt=2;
imgUrl[tt] = ' ./t01/002.jpg ';
imgtext[tt]=' tintin ';
imgLink[tt]='http://tiny.meibu.com';
imgAlt[tt]='05年白色捷达CIF ';

tt=3;
imgUrl[tt] =' ./t01/003.jpg ';
imgtext[tt]=' tintin ';
imgLink[tt]='http://tiny.meibu.com';
imgAlt[tt]=' 04年黑色桑塔纳3000 ';

tt=4;
imgUrl[tt] ='  ./t01/004.jpg ';
imgtext[tt]='  tintin ';
imgLink[tt]='http://tiny.meibu.com';
imgAlt[tt]=' 04年黑色桑塔纳（顶配） ';


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
}
function goUrl(){
window.open(imgLink[adNum],'_blank');
}
//NetScape开始
if (navigator.appName == "Netscape")
{
document.write('<style type="text/css">');
document.write('.buttonDiv{height:4px;width:21px;}');
document.write('</style>');
function nextAd(){
if(adNum<(intPage-1))adNum++;
else adNum=1;
theTimer=setTimeout("nextAd()", TimeOut);
document.images.imgInit.src=imgUrl[adNum];
document.images.imgInit.alt=imgAlt[adNum];
document.getElementById('focustext').innerHTML=imgtext[adNum];
document.getElementById('link'+adNum).style.background=buttonLineOn;
document.getElementById('imgLink').href=imgLink[adNum];
for (var i=1;i<=intPage;i++)
{
if (i!=adNum){document.getElementById('link'+i).style.background=buttonLineOff;}
}
}
document.write('<a id="imgLink" href="'+imgLink[1]+'" target=_blank class="p1"><img src="imgUrl[1]" name="imgInit" border=1 alt="'+imgAlt[1]+'" class="imgClass"></a>')
//<div id="txtFrom"><span id="focustext" class="'+textStyle+'">'+imgtext[1]+'</span></div>
document.write('</div></center>');
nextAd();
}
//NetScape结束
//IE开始
else
{
var count=0;
for (i=1;i<intPage;i++) {
if( (imgUrl[i]!="") && (imgLink[i]!="")&&(imgtext[i]!="")&&(imgAlt[i]!="") ) {
count++;
} else {
break;
}
}
function playTran(){
if (document.all)
document.images.imgInit.filters.BlendTrans.play();
}
var key=0;
function nextAd(){
if(adNum<count)adNum++ ;
else adNum=1;

if( key==0 ){
key=1;
} else if (document.all){
document.images.imgInit.filters.BlendTrans.apply();
playTran();
}
document.images.imgInit.src= imgUrl[adNum];
document.images.imgInit.alt=imgAlt[adNum];
document.getElementById('link'+adNum).style.background=buttonLineOn;
for (var i=1;i<=count;i++)
{
if (i!=adNum){document.getElementById('link'+i).style.background=buttonLineOff;}
}
focustext.innerHTML=imgtext[adNum];
theTimer=setTimeout("nextAd()", TimeOut);
}
document.write('<a target=_self href="javascript:goUrl()"><img style="FILTER: BlendTrans ( duration=1 );" src="javascript:nextAd()" border=0 vspace="0" name=imgInit class="imgClass"></a>');
document.write('</div>');
changeimg(1);
}
//IE结束
</SCRIPT>
