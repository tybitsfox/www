<?php
/*这是一个由接口导出的类实现文件
本文件实现下列功能：
1、独立的验证和注册函数
2、控制界面（左边栏）的数据操作类实现
3、显示界面（右边栏）的数据操作类实现
4、控制界面的动态元素显示类实现
5、显示界面的动态元素显示类实现
为便于后期的排错和调试，废水，废气，污水厂以及各自的明晰显示界面都由
单独的类实现，虽然这样做会使得代码臃肿，但方便后期的调试以及个别界面的微调



 	2016-4-17  田勇 alias tybitsfox
 */
//2017-1-1添加session的状态判断,避免log中的错误提示
if(session_status() != PHP_SESSION_ACTIVE)
	session_start();
if(!defined("FULL_PATH"))
{
	$s1=dirname(__FILE__);
	$s2=strstr($s1,"php_hl");
	$i=strlen($s1)-strlen($s2);
	$s2=substr($s1,0,$i)."php_hl/";
	define("FULL_PATH",$s2);
}
//确保包含了全局变量的定义文件
$ifile=constant("FULL_PATH")."config/main.php";
require_once($ifile);
$st=constant("FULL_PATH")."include/inter_def.php";
require_once($st);
$st=constant("FULL_PATH")."core/main.php";
require_once($st);
$st=constant("FULL_PATH")."interface/extra01.php";
require_once($st);
$st=constant("FULL_PATH")."interface/extra02.php";
require_once($st);
///////////////////////////////////////////////////////////////
//{{{class login_init implements sqli_def
class login_init implements sqli_def
{
	private $conn_reg,$conn_log,$db;//
	private $rq;
//{{{public function __construct($u,$p)
	public function __construct($u,$p)
	{
		if(($u == NULL) || ($p == NULL))
			die("请指定用户名和密码");
		$this->get_cur_year();
		$this->conn_log="SELECT * FROM auth";
		$this->conn_reg=sprintf("INSERT INTO auth(user,pwd) VALUES('%s','%s')",$u,$p);
		$this->get_used_db();
	}//}}}
//{{{public function get_cur_year()
	public function get_cur_year()
	{
		$dy=array();
		$dy=getdate(time());
		$this->rq= $dy['year'];
	}//}}}
//{{{public function get_used_db()
	public function get_used_db()
	{
		global $DB_ADDR_TY,$DB_PORT_TY,$DB_NAME_TY,$DB_PWD_TY;
		global $DB_USER_TY;
		$i=intval($this->rq);
		if(!isset($DB_ADDR_TY[$i]))
			die("你所选择的日期".$i."年，没有数据！");
		$this->db=array();
		array_push($this->db,$DB_ADDR_TY[$i]);
		array_push($this->db,$DB_PORT_TY[$i]);
		array_push($this->db,$DB_NAME_TY[$i]);
		array_push($this->db,$DB_USER_TY);
		array_push($this->db,$DB_PWD_TY);
	}//}}}
//{{{public function query_db($n)
	public function query_db($n)
	{
		$ay=array();
		if(!is_array($this->db))
			$this->get_used_db();
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			die("connect error");
		mysqli_set_charset($mysqli,"utf8");
		switch($n)
		{
		case 0:// login
			$res=mysqli_query($mysqli,$this->conn_log);
			while($row=mysqli_fetch_row($res))
				array_push($ay,$row);
			mysqli_free_result($res);
			mysqli_close($mysqli);
			break;
		case 1://register
			$res=mysqli_query($mysqli,$this->conn_reg);
			mysqli_close($mysqli);
			if($res != TRUE)
				die("用户注册失败！");
			return TRUE;
		};
		return $ay;
	}//}}}
}//}}}
//这里定义一个Session验证的函数
//{{{function _verf_fox()
function _verf_fox()
{
	global $tybitsfox;
	if(!isset($_SESSION['logok']))
		die("you're over!");
	if($_SESSION['logok'] != $tybitsfox['corename'])
		die("you're over!");
}//}}}
//{{{function _verf_db($u,$p)
function _verf_db($u,$p)
{
	$a=new login_init($u,$p);
	$ay=$a->query_db(0);
	$i=count($ay);
	for($j=0;$j<$i;$j++)
	{
		$row=$ay[$j];
		if(($row[0] == $u) && ($row[1] == $p))
			return 0;
	}
	return 1; 
}//}}}
//{{{function _reg_db($u,$p)
function _reg_db($u,$p)
{
	$a=new login_init($u,$p);
	$ay=$a->query_db(0);
	$i=count($ay);
	for($j=0;$j<$i;$j++)
	{
		$row=$ay[$j];
		if($row[0] == $u)
			die("该帐号已被注册，请更换名称重新注册");
	}
	$a->query_db(1);
	return 0;
}//}}}
//{{{ class tb_wsc implements tab_show 污水厂实时主界面显示类
class tb_wsc implements tab_show
{
	private $dy;
//{{{public function __construct()	
	public function __construct()
	{
		$a=new data_wsright();
		$a->parse_sql();
		$this->dy=$a->get_std();
	}//}}}
//{{{public function show_header()
	public function show_header()
	{
		global $FSS_HEADER;
		echo $FSS_HEADER;
	}//}}}
//{{{public function show_body()
	public function show_body()
	{
		global $FSS_BODY_1,$FSS_BODY_RED,$FSS_BODY_NOR,$FSS_BODY_LL,$WUXIAO;
		$str="";
		$i=count($this->dy);
		for($j=0;$j<$i;$j++)
		{
			$fy=$this->dy[$j];
			$s1=sprintf($FSS_BODY_1,$fy[0],$fy[1],$fy[2]);
			$str.=$s1;
			if(($fy[3]>$fy[4]) && ($fy[4]>0))
				$s1=sprintf($FSS_BODY_RED,$fy[3],$fy[4]);
			else
			{
				if($fy[3] >= 0)
					$s1=sprintf($FSS_BODY_NOR,$fy[3],$fy[4]);
				else
					$s1=sprintf($FSS_BODY_NOR,$WUXIAO,$fy[4]);
			}
			$str.=$s1;
			if(($fy[5]>$fy[6]) && ($fy[6]>0))
				$s1=sprintf($FSS_BODY_RED,$fy[5],$fy[6]);
			else
			{
				if($fy[5] >= 0)
					$s1=sprintf($FSS_BODY_NOR,$fy[5],$fy[6]);
				else
					$s1=sprintf($FSS_BODY_NOR,$WUXIAO,$fy[6]);
			}
			$str.=$s1;
			$s1=sprintf($FSS_BODY_LL,$fy[7],$fy[8],$fy[9]);
			$str.=$s1;
		}
		echo $str;
	}//}}}
//{{{public function show_tail()
	public function show_tail()
	{
		global $FSS_HEADER_END;
		echo $FSS_HEADER_END;
	}//}}}
}//}}}
//{{{class tb_fs implements tab_show 废水实时主界面显示类
class tb_fs implements tab_show
{
	private $dy;
//{{{public function __construct()	
	public function __construct()
	{
		$a=new data_sright();
		$a->parse_sql();
		$this->dy=$a->get_std();
	}//}}}
//{{{public function show_header()	
	public function show_header()
	{
		global $FSS_HEADER;
		echo $FSS_HEADER;
	}//}}}
//{{{public function show_body()	
	public function show_body()
	{
		global $FSS_BODY_1,$FSS_BODY_RED,$FSS_BODY_NOR,$FSS_BODY_LL,$WUXIAO;
		$str="";
		$i=count($this->dy);
		for($j=0;$j<$i;$j++)
		{
			$fy=$this->dy[$j];
			$s1=sprintf($FSS_BODY_1,$fy[0],$fy[1],$fy[2]);
			$str.=$s1;
			if(($fy[3]>$fy[4]) && ($fy[4]>0))
				$s1=sprintf($FSS_BODY_RED,$fy[3],$fy[4]);
			else
			{
				if($fy[3] >= 0)
					$s1=sprintf($FSS_BODY_NOR,$fy[3],$fy[4]);
				else
					$s1=sprintf($FSS_BODY_NOR,$WUXIAO,$fy[4]);
			}
			$str.=$s1;
			if(($fy[5]>$fy[6]) && ($fy[6]>0))
				$s1=sprintf($FSS_BODY_RED,$fy[5],$fy[6]);
			else
			{
				if($fy[5] >= 0)
					$s1=sprintf($FSS_BODY_NOR,$fy[5],$fy[6]);
				else
					$s1=sprintf($FSS_BODY_NOR,$WUXIAO,$fy[6]);
			}
			$str.=$s1;
			$s1=sprintf($FSS_BODY_LL,$fy[7],$fy[8],$fy[9]);
			$str.=$s1;
		}
		echo $str;
	}//}}}
//{{{public function show_tail()	
	public function show_tail()
	{
		global $FSS_HEADER_END;
		echo $FSS_HEADER_END;
	}//}}}
//{{{public function __destruct()
	public function __destruct()
	{unset($this->ay);unset($this->cy);unset($this->dy);}//}}}
}//}}}
//{{{class tb_fq implements tab_show 废气实时主界面显示类
class tb_fq implements tab_show
{
	private $dy;
	public function __construct()
	{
		$a=new data_qright();
		$a->parse_sql();
		$this->dy=$a->get_std();
	}
	public function show_header()
	{
		global $FQS_HEADER;
		echo $FQS_HEADER;
	}
	public function show_body()
	{
		global $FQS_BODY_1,$FQS_BODY_RED,$FQS_BODY_NOR,$FQS_BODY_LL,$WUXIAO;
		$str="";
		$i=count($this->dy);
		for($j=0;$j<$i;$j++)
		{
			$y=$this->dy[$j];
			$s1=sprintf($FQS_BODY_1,$y[0],$y[1],$y[2]);
			$str.=$s1;
			if(($y[3]>$y[4]) && ($y[4]>0))
				$s1=sprintf($FQS_BODY_RED,$y[3],$y[4]);
			else
			{
				if($y[3] >= 0)
					$s1=sprintf($FQS_BODY_NOR,$y[3],$y[4]);
				else
					$s1=sprintf($FQS_BODY_NOR,$WUXIAO,$y[4]);
			}
			$str.=$s1;
			if(($y[5]>$y[6]) && ($y[6]>0))
				$s1=sprintf($FQS_BODY_RED,$y[5],$y[6]);
			else
			{
				if($y[5] >= 0)
					$s1=sprintf($FQS_BODY_NOR,$y[5],$y[6]);
				else
					$s1=sprintf($FQS_BODY_NOR,$WUXIAO,$y[6]);
			}
			$str.=$s1;
			if(($y[7]>$y[8]) && ($y[8]>0))
				$s1=sprintf($FQS_BODY_RED,$y[7],$y[8]);
			else
			{
				if($y[7] >= 0)
					$s1=sprintf($FQS_BODY_NOR,$y[7],$y[8]);
				else	
					$s1=sprintf($FQS_BODY_NOR,$WUXIAO,$y[8]);
			}
			$str.=$s1;
			$s1=sprintf($FQS_BODY_LL,$y[9],$y[10]);
			$str.=$s1;
		}
		echo $str;

	}
	public function show_tail()
	{
		global $FQS_HEADER_END;
		echo $FQS_HEADER_END;
	}
}//}}}
///////////////////////////////////////////////////////////
//{{{class tb_sleft implements tab_show 所有实时数据查看的控制界面类
class tb_sleft implements tab_show
{
	private $db; //数据库服务器信息数组
	private $ay; //ay是控制区域列表框的数据数组
	private $rq;
	private $cy,$dy;	//控制级别和数据类型
//{{{public function __construct()
	public function __construct($y)
	{
		if(($y == 1) || ($y == 2) || ($y == 3))
		{
			if($y==3)
				$y=0;
		}
		else
		{die("参数错误2！！");}	
  		date_default_timezone_set("PRC");
		if(isset($_POST['starttime']))
		{
			$this->rq=$_POST['starttime'];
		}
		else
		{
  			$nowtime = time();
  			$this->rq = date("Y-m-d",$nowtime);
		}
		$_SESSION['SEL_5']=$this->rq;
		$x=array();
		array_push($x,$this->rq);
		array_push($x,$y);
		$a=new init_tab($x);
		$this->ay=$a->get_ctlarea();
		$this->cy=array("国控","省控","市控","县控","其他");//控制级别
		$this->dy=array("实时值","日均值");//数据类型
	}//}}}
//{{{public function __destruct()
	public function __destruct()
	{unset($this->db);unset($this->ay);unset($this->cy);unset($this->dy);}//}}}
//{{{public function show_header()
	public function show_header()
	{
		$i=count($this->ay);
		if(isset($_POST['sel1']))
		{$k=$_POST['sel1'];$_SESSION['SEL_1']=$k;$_SESSION['INTR_SEND']=$k;}
		else
		{$k=$this->ay[0][0];$_SESSION['SEL_1']=$k;$_SESSION['INTR_SEND']=$k;}
		$s1="<br><div class='dvmsg'>控制区域：</div><div class='select_style'><select name='sel1'>";
		for($j=0;$j<$i;$j++)
		{
			$by=$this->ay[$j];
			if($by[0] == $k)
				$s1.="<option value=".$by[0]." selected='selected'>".$by[1]."</option>";
			else
				$s1.="<option value=".$by[0].">".$by[1]."</option>";
		}
		$s1.="</select></div><div id='clear_id'></div>";
		echo $s1;	//end of control area
		if(isset($_POST["sel2"]))
		{$k=$_POST["sel2"];$_SESSION['SEL_2']=$k;}
		else
		{$k=0;$_SESSION['SEL_2']=$k;}
		$i=count($this->cy);
		$s1="<br><div class='dvmsg'>控制级别：</div><div class='select_style'><select name='sel2'>";
		for($j=0;$j<$i;$j++)
		{
			if($j == $k)
				$s1.="<option value=".$j." selected='selected'>".$this->cy[$j]."</option>";
			else
				$s1.="<option value=".$j.">".$this->cy[$j]."</option>";
		}
		$s1.="</select></div><div id='clear_id'></div>";
		echo $s1;	//end of control level
		if(isset($_POST["sel3"]))
		{$k=$_POST["sel3"];$_SESSION['SEL_3']=$k;}
		else
		{$k=0;$_SESSION['SEL_3']=$k;}
		$i=count($this->dy);
		$s1="<br><div class='dvmsg'>数据类型：</div><div class='select_style'><select name='sel3'>";
		for($j=0;$j<$i;$j++)
		{
			if($j == $k)
				$s1.="<option value=".$j." selected='selected'>".$this->dy[$j]."</option>";
			else
				$s1.="<option value=".$j.">".$this->dy[$j]."</option>";
		}
		$s1.="</select></div><div id='clear_id'></div>";
		echo $s1;	//end of data type
	}//}}}
//{{{public function show_body()
	public function show_body()
	{
		$s1="<br><div class='dvmsg'>日均值日期:</div>";
		$s1.="<div class='dvmsg'><input type='text' id='text1_id' name='starttime' onfocus='MyCalendar.SetDate(this)' value='".$this->rq."'/>";
		$s1.="</div><div id='clear_id'></div>";
		echo $s1;
		$s1="<br><br><div class='dvmsg2'></div><div class='dvmsg2'><input type='submit' id='button_id' name='submit' value='应用' title='点击开始查询'></div>";
		$s1.="<div class='dvmsg3'><a href='javascript:void(0)' onclick ='oooii()' /><img src='css/excel24.png' title='导出为excel' /></a></div><div id='clear_id'></div>";
		echo $s1;

	}//}}}
//{{{public function show_tail()
	public function show_tail()
	{}//}}}
}//}}}
////////////////////////////////////////////////////////////
//{{{class tb_mxleft implements tab_show  所有明晰的控制界面类
class tb_mxleft implements tab_show
{
	private $ay,$cy;	//ay是控制区域列表框的数据数组,cy是站点信息列表框的数据数组
	private $rq;
	private $my,$ny;	//控制级别和数据类型
//{{{public function __construct()
	public function __construct($y)
	{
		if(($y == 3)||($y == 1)||($y == 2))
		{
			if($y == 3)
				$y=0;
		}
		else
		{die("参数错误0A1！！");}
  		date_default_timezone_set("PRC");
		if(isset($_POST['starttime']))
		{
			$this->rq=$_POST['starttime'];
		}
		else
		{
  			$nowtime = time();
  			$this->rq = date("Y-m-d",$nowtime);
		}
		$_SESSION['SEL_5']=$this->rq;
		global $arry;$x=array();
		array_push($x,$this->rq);
		array_push($x,$y);
		$a=new init_tab($x);
		$this->ay=$a->get_ctlarea();
		$a->get_unit($this->ay);
		$this->cy=$arry;
		$this->my=array("国控","省控","市控","县控","其他");//控制级别
		$this->ny=array("小时值","日均值","小时超标值","日均超标值");//数据类型

	}//}}}
//{{{public function show_header()
	public function show_header()
	{
		$num=0;
		$i=count($this->ay);
		if(isset($_POST["sel1p"]))
		{$k=$_POST["sel1p"];$_SESSION['SEL_1']=$k;}
		else
		{$k=$this->ay[0][0];$_SESSION['SEL_1']=$k;}
		$s1="<br><div class='dvmsg'>控制区域：</div><div class='select_style'><select name='sel1p' id='sel1p' onchange = 'onsss()'>";
		for($j=0;$j<$i;$j++)
		{
			$by=$this->ay[$j];
			if($by[0] == $k)
			{$s1.="<option value=".$by[0]." selected='selected'>".$by[1]."</option>";$num=$j;}
			else
				$s1.="<option value=".$by[0].">".$by[1]."</option>";
		}
		$s1.="</select></div><div id='clear_id'></div>";
		if(isset($_POST["sel3p"]))
		{$k1=$_POST["sel3p"];$_SESSION['SEL_2']=$k1;}
		else
		{$k1=0;$_SESSION['SEL_2']=$k1;}
		$s1.="<br><div class='dvmsg'>控制级别：</div><div class='select_style'><select name='sel3p' id='sel3p' onchange = 'onsss()'>";
		for($j=0;$j<5;$j++)
		{
			if($k1 == $j)
				$s1.="<option value= ".$j." selected='selected'>".$this->my[$j]."</option>";
			else
				$s1.="<option value= ".$j.">".$this->my[$j]."</option>";
		}
		$s1.="</select></div><div id='clear_id'></div>";
		echo $s1;	//end of control area and control level
		$i=count($this->cy);
		if($num >= $i)
			die("get array count error");
		unset($by);
		$by=$this->cy[$num];
		$dy=$by[$k1]; //取得不同控制级别的单位数组
		$i=count($dy);
		if(isset($_POST["sel2p"]))
		{$k2 = $_POST["sel2p"];$_SESSION['SEL_3'] = $k2;$_SESSION['INTR_SEND'] = $k2;}
		else
		{
			if($i>0)
			{$k2 = $dy[0][0];$_SESSION['SEL_3'] = $k2;$_SESSION['INTR_SEND']= $k2;}
		}
		$s1="<br><div class='dvmsg1'>站点名称：</div><div class='select_style1'><select name='sel2p' id='sel2p'>";
		for($j=0;$j<$i;$j++)
		{
			if($dy[$j][0] == $k2)
				$s1.="<option value=".$dy[$j][0]." selected='selected'>".$dy[$j][1]."</option>";
			else
				$s1.="<option value=".$dy[$j][0].">".$dy[$j][1]."</option>";
		}
		$s1.="</select></div><div id='clear_id'></div>";
		echo $s1;
	}//}}}
//{{{public function show_body()
	public function show_body()
	{
		if(isset($_POST['sel3']))
		{$k=$_POST['sel3'];$_SESSION['SEL_4']=$k;}
		else
		{$k=0;$_SESSION['SEL_4']=$k;}
		$s1="<br><div class='dvmsg'>数据类型：</div><div class='select_style'><select name='sel3' id='sel3'>";
		for($i=0;$i<4;$i++)
		{
			if($i==$k)
				$s1.="<option value= ".$i." selected='selected'>".$this->ny[$i]."</option>";
			else
				$s1.="<option value= ".$i." >".$this->ny[$i]."</option>";
		}
		$s1.="</select></div><div id='clear_id'></div>";
		echo $s1;
		$s1="<br><div class='dvmsg'>日期选择：</div><div class='dvmsg'><input type='text' id='text1_id' name='starttime' onfocus='MyCalendar.SetDate(this)' value='".$this->rq."'/>";
		$s1.="</div><div id='clear_id'></div>";
		echo $s1;
		if(isset($_POST['radio1']))
		{
			if($_POST['radio1'] == 1)
				$k=0;
			else
				$k=1;
		}
		else
			$k=0;
		$s1="<br><br><div class='dwmsg'>";
		if($k==0)
		{
			$s1.="<input type='radio' name='radio1' value=1 checked />数据以表格显示";
			$s1.="<input type='radio' name='radio1' value=2 />数据以图形显示</div>";
		}
		else
		{
			$s1.="<input type='radio' name='radio1' value=1 />数据以表格显示";
			$s1.="<input type='radio' name='radio1' value=2 checked/>数据以图形显示</div>";
		}
		echo $s1;
		$s1="<br><br><div class='dvmsg2'></div><div class='dvmsg2'><input type='submit' id='button_id' name='submit' value='应用' title='点击开始查询'></div>";
		$s1.="<div class='dvmsg3'><a href='javascript:void(0)' onclick ='oooii()' /><img src='css/excel24.png' title='导出为excel' /></a></div><div id='clear_id'></div>";
//		$s1="<br><br><center><input type='submit' id='button_id' name='submit' value='应用' title='点击开始查询'>";
//		$s1.="&nbsp;<a href='javascript:void(0)' onclick ='oooii()' /><img src='css/excel.png' title='导出为excel' /></a></center>";
		echo $s1;
	}//}}}
//{{{public function show_tail()
	public function show_tail()
	{}//}}}
}//}}}
////////////////////////////////////////////////////////////
//{{{class tb_fs_mx	implements tab_show 废水明晰主界面显示类
class tb_fs_mx implements tab_show
{
	private $dy;
//{{{public function __construct()
	public function __construct()
	{
		$a=new data_sright_mx(1);
		$a->parse_sql();
		$this->dy=$a->get_std();
	}//}}}
//{{{public function __destruct()
	public function __destruct()
	{unset($this->dy);}//}}}
//{{{public function show_header()
	public function show_header()
	{
		global $FS_HEADER;
		echo $FS_HEADER;
	}//}}}
//{{{public function show_body()
	public function show_body()
	{
		global $FS_BODY_1,$FS_BODY_RED,$FS_BODY_NOR,$FS_BODY_LL,$WUXIAO;
		$str="";
		$i=count($this->dy);
		if($i>31)
			$i=31;
		for($j=0;$j<$i;$j++)
		{
			$y=$this->dy[$j];
			$s1=sprintf($FS_BODY_1,$y[0],$y[1]);
			$str.=$s1;
			if(($y[2]>$y[3]) && ($y[3]>0))
				$s1=sprintf($FS_BODY_RED,$y[2],$y[3]);
			else
			{
				if($y[2] >= 0)
					$s1=sprintf($FS_BODY_NOR,$y[2],$y[3]);
				else
					$s1=sprintf($FS_BODY_NOR,$WUXIAO,$y[3]);
			}
			$str.=$s1;
			if(($y[4]>$y[5]) && ($y[5]>0))
				$s1=sprintf($FS_BODY_RED,$y[4],$y[5]);
			else
			{
				if($y[4] >= 0)
					$s1=sprintf($FS_BODY_NOR,$y[4],$y[5]);
				else
					$s1=sprintf($FS_BODY_NOR,$WUXIAO,$y[5]);
			}
			$str.=$s1;
			$s1=sprintf($FS_BODY_LL,$y[6],$y[7],$y[8]);
			$str.=$s1;
		}
		echo $str;
	}//}}}	
//{{{public function show_tail()
	public function show_tail()
	{
		global $FS_HEADER_END;
		echo $FS_HEADER_END;
	}//}}}
}//}}}
////////////////////////////////////////////////////////////
//{{{class tb_wsc_mx implements tab_show 污水厂明晰主界面显示类
class tb_wsc_mx implements tab_show
{
	private $dy;
//{{{public function __construct()
	public function __construct()
	{
		$a=new data_sright_mx(2);
		$a->parse_sql();
		$this->dy=$a->get_std();
	}//}}}
//{{{public function __destruct()
	public function __destruct()
	{unset($this->dy);}//}}}
//{{{public function show_header()
	public function show_header()
	{
		global $FS_HEADER;
		echo $FS_HEADER;
	}//}}}
//{{{public function show_body()
	public function show_body()
	{
		global $FS_BODY_1,$FS_BODY_RED,$FS_BODY_NOR,$FS_BODY_LL,$WUXIAO;
		$str="";
		$i=count($this->dy);
		if($i>31)
			$i=31;
		for($j=0;$j<$i;$j++)
		{
			$y=$this->dy[$j];
			$s1=sprintf($FS_BODY_1,$y[0],$y[1]);
			$str.=$s1;
			if(($y[2]>$y[3]) && ($y[3]>0))
				$s1=sprintf($FS_BODY_RED,$y[2],$y[3]);
			else
			{
				if($y[2] >= 0)
					$s1=sprintf($FS_BODY_NOR,$y[2],$y[3]);
				else
					$s1=sprintf($FS_BODY_NOR,$WUXIAO,$y[3]);
			}
			$str.=$s1;
			if(($y[4]>$y[5]) && ($y[5]>0))
				$s1=sprintf($FS_BODY_RED,$y[4],$y[5]);
			else
			{
				if($y[4] >= 0)
					$s1=sprintf($FS_BODY_NOR,$y[4],$y[5]);
				else
					$s1=sprintf($FS_BODY_NOR,$WUXIAO,$y[5]);
			}
			$str.=$s1;
			$s1=sprintf($FS_BODY_LL,$y[6],$y[7],$y[8]);
			$str.=$s1;
		}
		echo $str;
	}//}}}
//{{{public function show_tail()
	public function show_tail()
	{
		global $FS_HEADER_END;
		echo $FS_HEADER_END;
	}//}}}
}//}}}
////////////////////////////////////////////////////////////
//{{{class tb_fq_mx implements tab_show 废气明晰主界面显示类
class tb_fq_mx implements tab_show
{
	private $dy;
//{{{public function __construct()
	public function __construct()
	{
		$a=new data_qright_mx();
		$a->parse_sql();
		$this->dy=$a->get_std();
	}//}}}
//{{{public function __destruct()
	public function __destruct()
	{unset($this->dy);}//}}}
//{{{public function show_header()
	public function show_header()
	{
		global $FQ_HEADER;
		echo $FQ_HEADER;
	}//}}}
//{{{public function show_body()
	public function show_body()
	{
		global $FQ_BODY_1,$FQ_BODY_RED,$FQ_BODY_NOR,$FQ_BODY_LL,$WUXIAO;
		$str="";
		$i=count($this->dy);
		if($i>31)
			$i=31;
		for($j=0;$j<$i;$j++)
		{
			$y=$this->dy[$j];
			$s1=sprintf($FQ_BODY_1,$y[0],$y[1]);
			$str.=$s1;
			if(($y[2]>$y[3]) && ($y[3]>0))
				$s1=sprintf($FQ_BODY_RED,$y[2],$y[3]);
			else
			{
				if($y[2] >= 0)
					$s1=sprintf($FQ_BODY_NOR,$y[2],$y[3]);
				else
					$s1=sprintf($FQ_BODY_NOR,$WUXIAO,$y[3]);
			}
			$str.=$s1;
			if(($y[4]>$y[5]) && ($y[5]>0))
				$s1=sprintf($FQ_BODY_RED,$y[4],$y[5]);
			else
			{
				if($y[4] >= 0)
					$s1=sprintf($FQ_BODY_NOR,$y[4],$y[5]);
				else
					$s1=sprintf($FQ_BODY_NOR,$WUXIAO,$y[5]);
			}
			$str.=$s1;
			if(($y[6]>$y[7]) && ($y[7]>0))
				$s1=sprintf($FQ_BODY_RED,$y[6],$y[7]);
			else
			{
				if($y[6] >= 0)
					$s1=sprintf($FQ_BODY_NOR,$y[6],$y[7]);
				else
					$s1=sprintf($FQ_BODY_NOR,$WUXIAO,$y[7]);
			}
			$str.=$s1;
			$s1=sprintf($FQ_BODY_LL,$y[8],$y[9]);
			$str.=$s1;
		}
		echo $str;
	}//}}}
//{{{public function show_tail()
	public function show_tail()
	{
		global $FQ_HEADER_END;
		echo $FQ_HEADER_END;
	}//}}}
}//}}}



?>












