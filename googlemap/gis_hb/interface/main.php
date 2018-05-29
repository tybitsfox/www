<?php
/**
 * @package base
 * @version 0.1.0.0
 * @author 田勇 Alias tybitsfox <tybitsfox@163.com>
 * @copyright (c) 2017 by tybitsfox
 * @license GPLv2
 * 
 * 本文件是土壤环境信息系统其中的一个文件
 * Available at http://202.102.134.68
 *
 * 这一程序是自由软件，你可以遵照自由软件基金会出版的GNU通用公共许可证条款来修改和重新
 * 发布这一程序。或者用许可证的第二版，或者（根据你的选择）用任何更新的版本。
 *
 * 发布这一程序的目的是希望它有用，但没有任何担保。甚至没有适合特定目的的隐含的担保。更
 * 详细的情况请参阅GNU通用公共许可证。
 *
 * 你应该已经和程序一起收到一份GNU通用公共许可证的副本。如果还没有，请查阅：
 * <http://www.gnu.org/licenses/>.
 * 或者写信给： The Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston,
 * MA  02111-1307  USA
 */
?>
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
	$s2=strstr($s1,"gis_hb");
	$i=strlen($s1)-strlen($s2);
	$s2=substr($s1,0,$i)."gis_hb/";
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
		if($row[1] == $u)
		{
			$str=base64_decode(base64_decode($row[2]));
			if($str == $p)
				return 0;
		}
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
///////////////////////////////////////////////////////////
//{{{class class gis_ctl implements tab_show 点位总览和明细控制界面的显示类
class gis_ctl implements tab_show
{
//wctl表明是总览，明晰还是列表操作
//ay保存选择区域，cy保存每个区域中所有站点，cy数组中key=区划代码，values=该区划内所有站点数组
//rq:当前选择的年度，ty存储有有效数据的年度数组	
	private $wctl,$ay,$cy;	
	private $rq,$ty,$zy; //2017-8-13新添加zy用于保存资料类型
	private $yy;//2017-9-3添加，用于保存点位类型
//{{{public function __construct($y)	
	public function __construct($y)
	{
		global $DB_ADDR_TY;
		switch($y)
		{
			case 0:
			case 1:
				$this->wctl=$y;
				break;
			default:
				die("参数错误002！");
		};
		date_default_timezone_set("PRC");
	//	if(isset($_POST['sel2']))
	//		$this->rq=$_POST['sel2'];
		if(isset($_SESSION['SEL_2']))
			$this->rq=$_SESSION['SEL_2'];
		else
	//		$this->rq=date("Y-m-d",time());
			$this->ra=date("Y");
		$a01=array_keys($DB_ADDR_TY);
		$i=count($a01);
		$this->ty=array();
		for($j=0;$j<$i;$j++)
			array_push($this->ty,$a01[$j]);//得到所有有数据的年份
		$this->zy=array("点位基本情况","土壤样品采集现场记录表","土壤无机样品交接记录表","土壤有机样品交接记录表","土壤样品运输记录表",
				"土壤样品制备原始记录表","PH值测定原始记录表","水分测定原始记录表","阳离子交换量测定原始记录表",
				"土壤有机质测定原始记录表","原子吸收法测定土壤元素原始记录表","原子吸收法测定土壤元素校准曲线",
				"原子荧光法测定土壤元素原始记录表","原子荧光法测定土壤元素校准曲线","分光光度法测定土壤元素原始记录表");
		$this->yy=array("全部点位","基础点位","质控点位");
	/*	if($this->wctl == 0)
		{
			$a=new init_gis($a01[$j-1]);
			$this->ay=$a->get_ctlarea();//取得年度列表中最后一个年度的地区代码
		}
		else
		{
			$a=new init_gis_mx($a01[$j-1]);
			$this->ay=$a->get_ctlarea();
		}*/
	}//}}}
//{{{public function __destruct()
	public function __destruct()
	{
		unset($this->wctl);unset($this->rq);
	}//}}}
//{{{public function show_header()
	public function show_header()
	{
		$i=count($this->ty);
		if($i<=0)
			die("count error04!!");
		if(isset($_POST['sel2']))
		{$k=$_POST['sel2'];$_SESSION['SEL_2']=$k;}
		else
		{
			if(isset($_SESSION['SEL_2']))
			{$k=$_SESSION['SEL_2'];}
			else
			{$k=$this->ty[$i-1];$_SESSION['SEL_2']=$k;}
		}
		if($this->wctl == 0)
		{
			$a=new init_gis($k);
			$this->ay=$a->get_ctlarea();//取得年度列表中最后一个年度的地区代码
		}
		else
		{
			$a=new init_gis_mx($k);
			$this->ay=$a->get_ctlarea();
		}
		$i=count($this->ay);
		if($i <= 0)
			die("count error0012");
		if(isset($_POST['sel1']))
		{//INTR_SEND保存区划代码，SEL_1保存区划名称
			$k=$_POST['sel1'];//$_SESSION['SEL_1']=$k;
			$_SESSION['INTR_SEND']=$k;
			for($j=0;$j<$i;$j++)
			{
				if($k == $this->ay[$j][0])
					$_SESSION['SEL_1']=$this->ay[$j][1];
			}
		}
		else
		{
			$k=$this->ay[0][0];$_SESSION['SEL_1']=$this->ay[0][1];
			$_SESSION['INTR_SEND']=$k;
		}
		if($this->wctl == 0)
		{
			$this->show_body();
			return;
		}//总览到这里处理完成，下面是明晰界面所要求的数据获得
		$dy=array();
		$i=count($this->ay);
		for($j=0;$j<$i;$j++)
			array_push($dy,$this->ay[$j][0]); //取得aid数组
		$a=new init_gis_mx($this->rq);
		$ey=$a->get_unit();
//		print_r($ey[1]);
		$i=count($this->ay);
		$j=count($ey);
		//die("count is:".$j);
		global $arry;
		$arry=array();
		for($k=0;$k<$i;$k++)
		{
			$zy=array();
			$fy=$this->ay[$k];
			for($l=0;$l<$j;$l++)
			{
				if($fy[0] == $ey[$l][0])
					array_push($zy,$ey[$l]);
			}
			array_push($arry,$zy);
			//unset($zy);
		}
		$this->cy=array_combine($dy,$arry);
		$this->show_tail();
	}//}}}
//{{{public function show_body()
	public function show_body()
	{//显示总览
		$i=count($this->ay);
		if(isset($_POST['sel1']))
		{//INTR_SEND保存区划代码，SEL_1保存区划名称
			$k=$_POST['sel1'];//$_SESSION['SEL_1']=$k;
			$_SESSION['INTR_SEND']=$k;
			for($j=0;$j<$i;$j++)
			{
				if($k == $this->ay[$j][0])
					$_SESSION['SEL_1']=$this->ay[$j][1];
			}
		}
		else
		{
			$k=$this->ay[0][0];$_SESSION['SEL_1']=$this->ay[0][1];
			$_SESSION['INTR_SEND']=$k;
		}
		$s1="<br><div class='dvmsg'>区域选择：</div><div class='select_style'><select name='sel1'>";
		for($j=0;$j<$i;$j++)
		{
			$xy=$this->ay[$j];
			if($xy[0] == $k)
				$s1.="<option value=".$xy[0]." selected='selected'>".$xy[1]."</option>";
			else
				$s1.="<option value=".$xy[0].">".$xy[1]."</option>";
		}
		$s1.="</select></div><div id='clear_id'></div>";
		echo $s1;
		//2017-9-3新添加，点位类型选择，post：sel5 session:SEL_5
		if(isset($_POST['sel5']))
		{$_SESSION['SEL_5']=$_POST['sel5'];}
		else
		{$_SESSION['SEL_5']=0;}
		$i=count($this->yy);
		if($i<=0)
			die("count error04!!");
		$s1="<br><div class='dvmsg'>点位类型：</div><div class='select_style'><select name='sel5'>";
		for($j=0;$j<$i;$j++)
		{
			if($j == $_SESSION['SEL_5'])
				$s1.="<option value=".$j." selected='selected'>".$this->yy[$j]."</option>";
			else
				$s1.="<option value=".$j." >".$this->yy[$j]."</option>";
		}
		$s1.="</select></div><div id='clear_id'></div>";
		echo $s1;
		$i=count($this->ty);
		if($i<=0)
			die("count error03!!");
	/*	if(isset($_POST['sel2']))
		{$k=$_POST['sel2'];$_SESSION['SEL_2']=$k;}
		else
		{$k=$this->ty[$i-1];$_SESSION['SEL_2']=$k;} */
		$s1="<br><div class='dvmsg'>年度选择：</div><div class='select_style'><select name='sel2'>";
		for($j=0;$j<$i;$j++)
		{
			if($this->ty[$j] == $_SESSION['SEL_2'])
				$s1.="<option value=".$this->ty[$j]." selected='selected'>".$this->ty[$j]."</option>";
			else
				$s1.="<option value=".$this->ty[$j].">".$this->ty[$j]."</option>";
		}
		$s1.="</select></div><div id='clear_id'></div>";
		echo $s1;
		$s1="<br><br><div class='dvmsg2'></div><div class='dvmsg2'><input type='submit' id='button_id' name='submit' value='应用' title='点击开始查询'></div>";
		$s1.="<div id='clear_id'></div>";
		echo $s1;
	}//}}}
//{{{public function show_tail()
	public function show_tail()
	{//这是明细控制界面的显示
		$i=count($this->ay);
		if(isset($_POST['sel1']))
		{//INTR_SEND保存区划代码，SEL_1保存区划名称
			$k=$_POST['sel1'];//$_SESSION['SEL_1']=$k;
			$_SESSION['INTR_SEND']=$k;
			for($j=0;$j<$i;$j++)
			{
				if($k == $this->ay[$j][0])
					$_SESSION['SEL_1']=$this->ay[$j][1];
			}
		}
		else
		{
			$k=$this->ay[0][0];$_SESSION['SEL_1']=$this->ay[0][1];
			$_SESSION['INTR_SEND']=$k;
		}
		$s1="<br><div class='dvmsg1'>区域选择：</div><div class='select_style1'><select name='sel1' id='sel1' onchange = 'onass()'>";
		for($j=0;$j<$i;$j++)
		{
			$xy=$this->ay[$j];
			if($xy[0] == $k)
				$s1.="<option value=".$xy[0]." selected='selected'>".$xy[1]."</option>";
			else
				$s1.="<option value=".$xy[0].">".$xy[1]."</option>";
		}
		$s1.="</select></div><div id='clear_id'></div>";
		echo $s1;
		if(isset($_POST['sel3']))
		{$m=$_POST['sel3'];$_SESSION['SEL3']=$m;}
		else
		{$m=$this->cy[$_SESSION['INTR_SEND']][0][2];$_SESSION['SEL3']=$m;}
		$ty=$this->cy[$_SESSION['INTR_SEND']];
		$i=count($ty);
		$s1="<br><div class='dvmsg1'>点位选择：</div><div class='select_style1'><select name='sel3' id='sel3'>";
		for($j=0;$j<$i;$j++)
		{
			$xy=$ty[$j];
			if($xy[2] == $m)
				$s1.="<option value=".$xy[2]." selected='selected'>".$xy[1]."</option>";
			else
				$s1.="<option value=".$xy[2].">".$xy[1]."</option>";
		}
		$s1.="</select></div><div id='clear_id'></div>";
		echo $s1;
		$i=count($this->ty);
		if($i<=0)
			die("count error04!!");
	/*	if(isset($_POST['sel2']))
		{$k=$_POST['sel2'];$_SESSION['SEL_2']=$k;}
		else
		{$k=$this->ty[$i-1];$_SESSION['SEL_2']=$k;}*/
		$s1="<br><div class='dvmsg1'>年度选择：</div><div class='select_style1'><select name='sel2'>";
		for($j=0;$j<$i;$j++)
		{
			if($this->ty[$j] == $_SESSION['SEL_2'])
				$s1.="<option value=".$this->ty[$j]." selected='selected'>".$this->ty[$j]."</option>";
			else
				$s1.="<option value=".$this->ty[$j].">".$this->ty[$j]."</option>";
		}
		$s1.="</select></div><div id='clear_id'></div>";
		echo $s1;
//新添加，资料选择
		if(isset($_POST['sel4']))//目前的k保存的是序号
		{$k=$_POST['sel4'];$_SESSION['SEL_4']=$k;}
		else
		{$k=0;$_SESSION['SEL_4']=0;}
		$i=count($this->zy);
		$s1="<br><div class='dvmsg1'>资料选择：</div><div class='select_style1'><select name='sel4'>";
		for($j=0;$j<$i;$j++)
		{
			if($j == $k)
				$s1.="<option value=".$j." selected='selected'>".$this->zy[$j]."</option>";
			else
				$s1.="<option value=".$j." >".$this->zy[$j]."</option>";
		}
		$s1.="</select></div><div id='clear_id'></div>";
		echo $s1;
		$s1="<br><br><div class='dvmsg2'></div><div class='dvmsg2'><input type='submit' id='button_id' name='submit' value='应用' title='点击开始查询'></div>";
		$s1.="<div id='clear_id'></div>";
		echo $s1;
	}//}}}
}//}}}
//{{{class gis_main_map implements tab_show 点位总览主界面地图显示类
class gis_main_map implements tab_show
{
	private $ay,$cy;
//{{{public function __construct()	
	public function __construct()
	{
		if(!isset($_SESSION['SEL_2']))
			die("init error!");
		if(!isset($_SESSION['INTR_SEND']))
			die("init error!");
		$i=$_SESSION['SEL_2'];
		$a=new init_gis($i);
		$this->ay=$a->get_unit($i);
		$b=new init_gis_trail($i);
		$this->cy=$b->get_ctlarea();
	}//}}}
//{{{public function __destruct()
	public function __destruct()
	{}//}}}
//{{{public function show_header()
	public function show_header()
	{
		global $GIS_DIV,$GIS_BEG_SCRIPT,$GIS_MAP_MSG1,$GIS_MAP_MSG2,$GIS_MAP_MARKER,$GIS_END_SCRIPT;
		global $GIS_CONTENT_OPT,$GIS_CONTENT_FUNCH,$GIS_CONTENT_FUNCL,$GIS_CONTENT_VVV,$GIS_CONTENT_IMAGE;
		$i=count($this->ay);
		$s1=$GIS_DIV.$GIS_BEG_SCRIPT;
		echo $s1;
		$s1=sprintf($GIS_MAP_MSG1,$_SESSION['SEL_1']);
		$s1.=$GIS_MAP_MSG2;
		echo $s1;
		$s1=sprintf($GIS_CONTENT_OPT,$_SESSION['SEL_1']);
		echo $s1;
		for($j=0;$j<$i;$j++)
		{
			$dy=$this->ay[$j];
			$s1=sprintf($GIS_CONTENT_IMAGE,$dy[5],$dy[1],$dy[2],$dy[3],$dy[4]);
	//		$s1=sprintf($GIS_CONTENT_IMAGE,"./images/aaa.jpg");
			echo $s1;
			$s1=sprintf($GIS_CONTENT_VVV,$dy[3],$dy[4]);
			echo $s1;
		}
		echo $GIS_CONTENT_FUNCH;
		echo $GIS_CONTENT_FUNCL;
		$this->show_body();
		echo $GIS_END_SCRIPT;
	}//}}}
//{{{public function show_body()
	public function show_body()
	{
		global $GIS_TRAIL_BEG,$GIS_TRAIL_MSG,$GIS_TRAIL_END;
		$clr=array("blue","green","magenta","olive","coral");
		if(!isset($_SESSION['INTR_SEND']))
			return;
		$i=$_SESSION['INTR_SEND'];
		if($i == 370900)
			return;
		/*$j=intval($i);
		if($j/100 == 0)
			return;*/
		$xy=$this->cy[$i];
		$i=count($xy);
		for($j=0;$j<$i;$j++)
		{
			echo $GIS_TRAIL_BEG;
			$yy=$xy[$j];
			$m=count($yy);
			for($n=0;$n<$m;$n++)
			{
				$str=sprintf($GIS_TRAIL_MSG,$yy[$n][1],$yy[$n][2]);
				echo $str;
			}
			if($j<=4)
				$s=$clr[$j];
			else
				$s=$clr[4];
			$str=sprintf($GIS_TRAIL_END,$s);
			echo $str;
		}
	}//}}}
//{{{public function show_tail()
	public function show_tail()
	{}//}}}

}//}}}
//{{{class gis_mx_pic implements tab_show 点位明细主界面，点位资料显示类
class gis_mx_pic implements tab_show
{
	private $ay;
//{{{public function __construct()
	public function __construct()
	{
		if(!isset($_SESSION['SEL3']))
			die("init error1!");
		if(!isset($_SESSION['SEL_4']))//index
			die("init error2!");
		if(!isset($_SESSION['SEL_2']))//year
			die("init error3!");
	}//}}}
//{{{public function __destruct()
	public function __destruct()
	{unset($this->ay);}//}}}
//{{{public function show_header()
	public function show_header()
	{
		if($_SESSION['SEL_4'] != 0)
			$this->show_body();
		else
			$this->show_tail();
	}//}}}
//{{{public function show_body()
	public function show_body()
	{
		$a=new init_gis_mmx($_SESSION['SEL_2']);
		$dy=array();
		$dy=$a->get_unit();
		$str="<center><img src='".$dy[0][0]."' border=1 class='imgclass' style='width:50%;cursor:pointer' onclick='javascript:window.open(this.src)'></center>";
		echo $str;
	}//}}}
//{{{public function show_tail()
	public function show_tail()
	{//显示基本信息
		global $GIS_HEADER,$GIS_BODY1,$GIS_HEADER_END; 
		$cy=array("点位编号","采样地点","经度","纬度","采样时间","天气","样品编号","采样深度","海拔","土地利用","作物类型","灌溉类型","地形地貌","土壤类型","土壤质地","土壤颜色","土壤湿度","样品重量","周边信息-东","周边信息-西","周边信息-南","周边信息-北","点位类型","采样人","记录人","校对人");
		$i=count($cy);
		$a=new init_gis_mmx($_SESSION['SEL_2']);
		$dy=array();
		$dy=$a->get_ctlarea();
		echo $GIS_HEADER;
		for($j=0;$j<$i;$j++)
		{
			if($j==22) //点位类型需要转换
			{
				if($dy[0][$j]==0)
					$s1="基础点位";
				else
					$s1="质控点位";
				$str=sprintf($GIS_BODY1,$cy[$j],$s1,$cy[++$j],$dy[0][$j]);
			}
			else
				$str=sprintf($GIS_BODY1,$cy[$j],$dy[0][$j],$cy[++$j],$dy[0][$j]);
			echo $str;
		}
		echo $GIS_HEADER_END;
	}//}}}
}//}}}
//{{{class gis_calc_ctl implements tab_show 监测数据图表的控制界面显示类
class gis_calc_ctl implements tab_show
{
	private $rq,$ay,$cy,$ty; //rq选择的年度，ay区域选择，cy污染物类型
	private $zy;//有效年份列表
//{{{public function __construct($y)
	public function __construct($y)
	{//sel1 行政区划，sel2 年度选择，sel3 污染物名称
		global $DB_ADDR_TY;
	//	if(isset($_POST['sel2']))
		if(isset($_SESSION['SEL_2']))
			$this->rq=$_SESSION['SEL_2'];
		else
			$this->rq=date('Y');
		$a01=array_keys($DB_ADDR_TY);
		$i=count($a01);
		$this->zy=array();
		for($j=0;$j<$i;$j++)
			array_push($this->zy,$a01[$j]);
		$a=new init_gis($this->rq);
		$this->ay=$a->get_ctlarea();//取得年度列表中最后一个年度的地区代码列表
		if(!isset($_POST['sel3']))
			unset($_SESSION['SEL_3']);
		$b=new init_gis_calc($this->rq);
		$this->cy=$b->get_ctlarea();
	}//}}}
//{{{public function __destruct()
	public function __destruct()
	{}//}}}
//{{{public function show_header()
	public function show_header()
	{
		$i=count($this->ay);
		if($i <= 0)
			die("count error0013");
		if(isset($_POST['sel1']))
		{//$_SESSION['INTR_SEND']保存行政区划代码，$_SESSION['SEL_1']保存行政区划名称
			$_SESSION['INTR_SEND']=$_POST['sel1'];$k=$_POST['sel1'];
			for($j=0;$j<$i;$j++)
			{
				if($_POST['sel1'] == $this->ay[$j][0])
					$_SESSION['SEL_1']=$this->ay[$j][1];
			}
		}
		else
		{
			$k=$this->ay[0][0];$_SESSION['SEL_1']=$this->ay[0][1];
			$_SESSION['INTR_SEND']=$k;
		}
		$s1="<br><div class='dvmsg'>区域选择：</div><div class='select_style'><select name='sel1'>";
		for($j=0;$j<$i;$j++)
		{
			$xy=$this->ay[$j];
			if($xy[0] == $k)
				$s1.="<option value=".$xy[0]." selected='selected'>".$xy[1]."</option>";
			else
				$s1.="<option value=".$xy[0]." >".$xy[1]."</option>";
		}
		$s1.="</select></div><div id='clear_id'></div>";
		echo $s1;
		$i=count($this->zy);
		if(isset($_POST['sel2']))
		{$k=$_POST['sel2'];$_SESSION['SEL_2']=$k;}
		else
		{
			if(isset($_SESSION['SEL_2']))
				$k=$_SESSION['SEL_2'];
			else
			{$k=$this->zy[$i-1];$_SESSION['SEL_2']=$k;}
		}
		$s1="<br><div class='dvmsg'>年度选择：</div><div class='select_style'><select name='sel2'>";
		for($j=0;$j<$i;$j++)
		{
			if($this->zy[$j] == $k)
				$s1.="<option value=".$this->zy[$j]." selected='selected' >".$this->zy[$j]."</option>";
			else
				$s1.="<option value=".$this->zy[$j]." >".$this->zy[$j]."</option>";
		}
		$s1.="</select></div><div id='clear_id'></div>";
		echo $s1;
		if(isset($_POST['sel3']))
			$_SESSION['SEL_3']=$_POST['sel3'];
		else
			$_SESSION['SEL_3']="镉";
		$i=count($this->cy);
		$s1="<br><div class='dvmsg'>污染物选择：</div><div class='select_style'><select name='sel3'>";
		for($j=0;$j<$i;$j++)
		{
			$xy=$this->cy[$j];
			if($xy[1] == $_SESSION['SEL_3'])
				$s1.="<option value=".$xy[1]." selected='selected'>".$xy[1]."</option>";
			else
				$s1.="<option value=".$xy[1]." >".$xy[1]."</option>";
		}
		$s1.="</select></div><div id='clear_id'></div>";
		echo $s1;
		if(isset($_POST['radio1']))
			$_SESSION['SEL_4']=$_POST['radio1'];
		else
			$_SESSION['SEL_4']=0;
		$s1="<br><div class='dwmsg'>";
		if($_SESSION['SEL_4'] == 0)
		{
			$s1.="<input type='radio' name='radio1' value=0 checked />数据以表格显示";
			$s1.="<input type='radio' name='radio1' value=1 />数据以图形显示</div>";
		}
		else
		{
			$s1.="<input type='radio' name='radio1' value=0 />数据以表格显示";
			$s1.="<input type='radio' name='radio1' value=1 checked />数据以图形显示</div>";
		}
		echo $s1;
		if(isset($_POST['radio2']))
			$_SESSION['SEL_5']=$_POST['radio2'];
		else
			$_SESSION['SEL_5']=0; //按监测值排序
		$s1="<br><div class='dwmsg'>";
		if($_SESSION['SEL_5'] == 0)
		{
			$s1.="<input type='radio' name='radio2' value=0 checked />按监测数据排序";
			$s1.="<input type='radio' name='radio2' value=1 />按行政区划排序</div>";
		}
		else
		{
			$s1.="<input type='radio' name='radio2' value=0 />按监测数据排序";
			$s1.="<input type='radio' name='radio2' value=1 checked />按行政区划排序</div>";
		}
		echo $s1;
		$s1="<br><br><div class='dvmsg2'></div><div class='dvmsg2'><input type='submit' id='button_id' name='submit' value='应用' title='点击开始查询'></div>";
		$s1.="<div id='clear_id'></div>";
		echo $s1;
	}//}}}
//{{{public function show_body()
	public function show_body()
	{}//}}}
//{{{public function show_tail()
	public function show_tail()
	{}//}}}
}//}}}
//{{{class gis_calc_main implements tab_show 监测数据图表的主界面显示类
class gis_calc_main implements tab_show
{
	private $ay;
//{{{public function __construct()
	public function __construct()
	{
		if(!isset($_SESSION['SEL_3']))
			die("init error!");
	}//}}}
//{{{public function __destruct()
	public function __destruct()
	{unset($this->ay);}//}}}
//{{{public function show_header()
	public function show_header()
	{
		if(!isset($_SESSION['SEL_4']))
			return;
		if($_SESSION['SEL_4'] == 1)
		{
			$this->show_body();
			return;
		}
		global $GIS_V_HEADER,$GIS_V_BODY1,$GIS_V_END,$GIS_V_BODY2;
		if(!isset($_POST['sel1']))
			return;
		$a=new init_std_val($_SESSION['SEL_2']);
		$ay=$a->get_ctlarea();
		$i=count($ay);//取得iid的数量，确定要显示的表格数量
		if($i <= 0)
		{
			$str=sprintf("<font size=3>%d年度<font color=blue>%s</font>土壤点位<font color=blue>特征污染物：%s</font>未监测</font><br>",$_SESSION['SEL_2'],$_SESSION['SEL_1'],$_SESSION['SEL_3']);
			echo $str;
			return;
		}
		$cy=array_keys($ay);
		for($j=0;$j<$i;$j++)
		{
			$dy=$ay[$cy[$j]];
			$str=sprintf("<font size=3>%d年度<font color=blue>%s%s</font>土壤点位<font color=blue>%s</font>含量统计表</font><br>",$_SESSION['SEL_2'],$_SESSION['SEL_1'],$dy[0][8],$_SESSION['SEL_3']);
			echo $str;
			$k=count($dy);
			echo $GIS_V_HEADER;
			for($l=0;$l<$k;$l++)
			{
				if(floatval($dy[$l][3]) < floatval($dy[$l][9]))
					$str=sprintf($GIS_V_BODY1,$dy[$l][1],$dy[$l][4],$dy[$l][8],$dy[$l][3],$dy[$l][9],"I类 (无污染)");
				else
				{
					$z1=floatval($dy[$l][3])/floatval($dy[$l][9]);
					if($z1 <= 2)
						$s="II类 (轻微污染)";
					else
						if($z1 <= 3)
							$s="III类 (轻度污染)";
						else
							if($z1 <= 5)
								$s="IV类 (中度污染)";
							else
								$s="V类 (重度污染)";
					$str=sprintf($GIS_V_BODY2,$dy[$l][1],$dy[$l][4],$dy[$l][8],$dy[$l][3],$dy[$l][9],$s);
				}
				echo $str;
			}
			echo $GIS_V_END;
		}
	}//}}}
//{{{public function show_body()
	public function show_body()
	{//图形显示的实现函数
		//echo "hello world";
		$a=new init_std_val($_SESSION['SEL_2']);
		$ay=$a->get_ctlarea();
		$i=count($ay);//取得iid的数量，确定要显示的表格数量
		if($i <= 0)
		{
			$str=sprintf("<font size=3>%d年度<font color=blue>%s</font>土壤点位<font color=blue>特征污染物：%s</font>未监测</font><br>",$_SESSION['SEL_2'],$_SESSION['SEL_1'],$_SESSION['SEL_3']);
			echo $str;
			return;
		}
		if(isset($_SESSION['GRA_P1']))
			unset($_SESSION['GRA_P1']);
		$w=$_SESSION['screen'];
		if(($w == NULL)||($w < 100))
			$w=1000;
		$xs=floor($w*0.67);
		$cy=array_values($ay);
		$_SESSION['GRA_P1']=$cy;
		$str="<center><table width=97%>";
		echo $str;
		$str="<tr><td width=100% align=center><img src='core/graph/gg01.php' border=1 class='imgclass' style='width:90%;cursor:pointer' onclick='javascript:window.open(this.src)' /></td></tr>";
		echo $str;
		echo "</table></center>";
	}//}}}
//{{{public function show_tail()
	public function show_tail()
	{}//}}}
}//}}}


?>
