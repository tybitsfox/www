<?php
/*这是一个由接口导出的类定义文件的扩展
  也就是本目录下main.php文件的扩展
 

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

////////////////////////////////////////////////////////////
//{{{ class data_sright implements main_data 废水实时主界面数据及标准的获取类
class data_sright implements main_data
{
	private $db,$ins;	//目标数据库相关信息，传入的查询条件。
	private $con_std,$con_val; //解析后生成的执行标准查询字符串和项目数据查询字符串
	private $para;
//{{{ public function __construct()
	public function __construct()
	{
		$i=0;
		if(!isset($_POST['starttime']))
		{//这种处理方式可以保证没有submit之前，就能正常的显示主界面的数据
			if(!isset($_SESSION['INTR_SEND']))
				die("严重错误！Session变量错误！");
			$this->para=array();
			$this->para[0]=$_SESSION['INTR_SEND'];//控制区域aid
			if(isset($_SESSION['EXCEL_OUT']))
			{
				$this->para[0]=$_SESSION['SEL_1'];
				$this->para[1]=$_SESSION['SEL_2'];
				$this->para[2]=$_SESSION['SEL_3'];
				$this->para[3]=$_SESSION['SEL_5'];
				$i=intval($this->para[3]);			
				unset($_SESSION['EXCEL_OUT']);
			}
			else
			{
				$this->para[1]=0;//控制级别
				$this->para[2]=0;//数据类型
				$this->para[3]=date("Y-m-d",time());
				$ay=array();
				$ay=getdate(time());
				$i=$ay['year'];
			}
		}
		else
		{//正常的从post传递
			$this->para=array();
			if(isset($_SESSION['EXCEL_OUT']))
			{
				$this->para[0]=$_SESSION['SEL_1'];
				$this->para[1]=$_SESSION['SEL_2'];
				$this->para[2]=$_SESSION['SEL_3'];
				$this->para[3]=$_SESSION['SEL_5'];
				$i=intval($this->para[3]);			
				unset($_SESSION['EXCEL_OUT']);
			}
			else
			{
				$this->para[0]=$_POST['sel1'];
				$this->para[1]=$_POST['sel2'];
				$this->para[2]=$_POST['sel3'];
				$this->para[3]=$_POST['starttime'];
				$i=intval($_POST['starttime']);
			}
		}
		$this->get_used_db($i);
	}//}}}
//{{{public function get_used_db($y)
	public function get_used_db($y)
	{
		global $DB_ADDR_TY,$DB_PORT_TY,$DB_NAME_TY,$DB_PWD_TY;
		global $DB_USER_TY;
		if(!isset($DB_ADDR_TY[$y]))
			die("你所选择的日期".$i."年，没有数据！");
		$this->db=array();
		array_push($this->db,$DB_ADDR_TY[$y]);
		array_push($this->db,$DB_PORT_TY[$y]);
		array_push($this->db,$DB_NAME_TY[$y]);
		array_push($this->db,$DB_USER_TY);
		array_push($this->db,$DB_PWD_TY);
	}//}}}
//{{{public function parse_sql()
	public function parse_sql()
	{//废水,县区级
//2017-1-10添加实时界面中日均值显示
		if($this->para[2]==0)//实时值
		{
			$cur_table="fs_h_master";
			$cur_date=" > date_add(now(),interval -1 day)";
		}
		else
		{
			$cur_table="fs_d_master";
			$cur_date=" = '".$this->para[3]." 00:00:00'";
		}
		switch($_SESSION['sys_level'])
		{
		case 0: //县区级
			$s1="SELECT e.uid,e.uname,e.date,e.cod,e.nhx,e.ll_sh,e.ll_jg,e.ll_lj FROM (SELECT b.uid,b.uname,a.date,a.cod,a.nhx,a.ll_sh,a.ll_jg,a.ll_lj FROM zd_info as b LEFT JOIN %s as a ON b.uid = a.uid AND a.date %s WHERE b.utype = 0 AND b.ctlvl = %d ORDER BY a.date DESC) AS e GROUP BY e.uid";
			$this->con_val=sprintf($s1,$cur_table,$cur_date,$this->para[1]);
			$s1="SELECT a.uid,b.iid,b.std1,b.std1_area,b.std2 FROM zd_info AS a,gb_std AS b WHERE a.aid = %u AND a.utype = 0 AND a.ctlvl = %d AND a.uid = b.uid AND '%s' BETWEEN  b.sttm AND b.edtm";
			$s2=$this->para[3]." 00:00:01";
			$this->con_std=sprintf($s1,$this->para[0],$this->para[1],$s2);
			break;
		case 1://省级
			$s1="SELECT e.uid,e.uname,e.date,e.cod,e.nhx,e.ll_sh,e.ll_jg,e.ll_lj FROM (SELECT b.uid,b.uname,a.date,a.cod,a.nhx,a.ll_sh,a.ll_jg,a.ll_lj FROM zd_info AS b LEFT JOIN %s AS a ON a.date %s AND a.uid = b.uid WHERE b.aid BETWEEN %u AND %u AND b.utype = 0 AND b.ctlvl = %d ORDER BY a.date DESC) AS e GROUP BY e.uid";
			$i=intval($this->para[0])+1;
			$j=$i+98;
			$this->con_val=sprintf($s1,$cur_table,$cur_date,$i,$j,$this->para[1]);
			$s1="SELECT a.uid,b.iid,b.std1,b.std1_area,b.std2 FROM zd_info AS a,gb_std AS b WHERE a.aid BETWEEN %u AND %u AND a.utype = 0 AND a.ctlvl = %d AND a.uid = b.uid AND '%s' BETWEEN  b.sttm AND b.edtm";
			$s2=$this->para[3]." 00:00:01";
			$this->con_std=sprintf($s1,$i,$j,$this->para[1],$s2);
			break;
		case 2://地市级
			$s1="SELECT e.uid,e.uname,e.date,e.cod,e.nhx,e.ll_sh,e.ll_jg,e.ll_lj FROM (SELECT b.uid,b.uname,a.date,a.cod,a.nhx,a.ll_sh,a.ll_jg,a.ll_lj FROM zd_info AS b LEFT JOIN %s AS a ON a.date %s AND a.uid = b.uid WHERE b.aid = %u AND b.utype = 0 AND b.ctlvl = %d ORDER BY a.date DESC) AS e GROUP BY e.uid";
			$this->con_val=sprintf($s1,$cur_table,$cur_date,$this->para[0],$this->para[1]);
			$s1="SELECT a.uid,b.iid,b.std1,b.std1_area,b.std2 FROM zd_info AS a,gb_std AS b WHERE a.aid = %u AND a.utype = 0 AND a.ctlvl = %d AND a.uid = b.uid AND '%s' BETWEEN b.sttm AND b.edtm";
			$s2=$this->para[3]." 00:00:01";
			$this->con_std=sprintf($s1,$this->para[0],$this->para[1],$s2);
			break;
		default:
			$this->con_val="sys_level=".$_SESSION['sys_level'];
			break;
		};
	}//}}}
//{{{public function get_std()
	public function get_std()
	{//本函数实现本类结果完整的输出
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			die("connect error");
		mysqli_set_charset($mysqli,"utf8");
		if($res=mysqli_query($mysqli,$this->con_std))
		{
			$vay=array();
			while($row=mysqli_fetch_row($res))
				array_push($vay,$row);
			mysqli_free_result($res);
		}
		else
		{
			$s1=mysqli_error($mysqli);
			mysqli_close($mysqli);
			die($s1."<br>".$this->con_std);
		}
		mysqli_close($mysqli);
		$i=count($vay);
		$by=array();
		for($j=0;$j<$i;$j++)
		{
			$ay=$vay[$j];
			if(strlen($ay[3]) == 8)
			{
				$s1=substr($ay[3],0,4); //取得开始的日期
				$b1=intval($s1);
				$s1=substr($ay[3],4,4); //取得结束日期
				$b2=intval($s1);
				$s1=substr($this->para[3],5,5);
				$a1=intval($s1);$a1*=100;
				$a2=intval(substr($s1,3,2));
				$a1+=$a2;				//取得记录的日期
				if(($a1>=$b1) && ($a1<=$b2))
				{
					if(intval($ay[1]) == 316) //cod
						$by[$ay[0]][0]=$ay[2];
					else
						$by[$ay[0]][1]=$ay[2];
				} //使用标准1
				else
				{
					if(intval($ay[1]) == 316) //cod
						$by[$ay[0]][0]=$ay[4];
					else
						$by[$ay[0]][1]=$ay[4];
				}//使用标准2
			}
			else
			{
				if(strlen($ay[3])>1)
				{
					$s1=strval(strlen($ay[3]));
					die($s1);
				}
				if(intval($ay[1]) == 316)
					$by[$ay[0]][0]=$ay[2];//cod
				else
					$by[$ay[0]][1]=$ay[2];//nhx
			}
		}
//		print_r($by);
		$cy=$this->get_unit();
		$i=count($cy);
		$ey=array();
		for($j=0;$j<$i;$j++)
		{
			$y=$cy[$j];
			$x=array();
			$x[0]=intval($j)+1;
			$x[1]=$y[1]; //name
			if($y[2] == NULL)
			{
				$x[2]="---";$x[3]="---";$x[4]=$by[$y[0]][0];
				$x[5]="---";$x[6]=$by[$y[0]][1];
				$x[7]="---";$x[8]="---";$x[9]="---";
			}
			else
			{
				$x[2]=substr($y[2],5,11);//date
				$x[3]=$y[3];//cod
				$x[4]=$by[$y[0]][0]; //std cod
				$x[5]=$y[4];//nhx
				$x[6]=$by[$y[0]][1];//std nhx
				$x[7]=$y[5];//ll_sh
				$x[8]=$y[6];//ll_jg
				$x[9]=$y[7]; //ll_lj
			}
			array_push($ey,$x);
		}
		return $ey;
	}//}}}
//{{{public function get_unit()
	public function get_unit()
	{
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			die("connect error");
		mysqli_set_charset($mysqli,"utf8");
		if($res=mysqli_query($mysqli,$this->con_val))
		{
			$vay=array();
			while($row=mysqli_fetch_row($res))
				array_push($vay,$row);
			mysqli_free_result($res);
		}
		else
		{
			//mysqli_close($mysqli);
			var_dump($this->db);
			die("mysql query error!<br>".mysqli_error($mysqli));
		}
		mysqli_close($mysqli);
		return $vay;
	}//}}}

}//}}}
////////////////////////////////////////////////////////////
//{{{class data_qright implements main_data 废气实时主界面数据及标准的获取类
class data_qright implements main_data
{
	private $db;	//目标数据库的相关信息
	private $con_std,$con_val;//解析后生成的执行标准查询和数据查询SQL字符串
	private $para;//传入的参数
//{{{public function __construct()
	public function __construct()
	{
		$i=0;
		if(!isset($_POST['starttime']))
		{//这种处理方式可以保证没有submit之前，就能正常的显示主界面的数据
			if(!isset($_SESSION['INTR_SEND']))
				die("严重错误！Session变量错误！");
			$this->para=array();
			$this->para[0]=$_SESSION['INTR_SEND'];//控制区域aid
			if(isset($_SESSION['EXCEL_OUT']))
			{
				$this->para[0]=$_SESSION['SEL_1'];
				$this->para[1]=$_SESSION['SEL_2'];
				$this->para[2]=$_SESSION['SEL_3'];
				$this->para[3]=$_SESSION['SEL_5'];
				$i=intval($this->para[3]);			
				unset($_SESSION['EXCEL_OUT']);
			}
			else
			{
				$this->para[1]=0;//控制级别
				$this->para[2]=0;//数据类型
				$this->para[3]=date("Y-m-d",time());
				$ay=array();
				$ay=getdate(time());
				$i=$ay['year'];
			}
		}
		else
		{//正常的从post传递
			$this->para=array();
			if(isset($_SESSION['EXCEL_OUT']))
			{
				$this->para[0]=$_SESSION['SEL_1'];
				$this->para[1]=$_SESSION['SEL_2'];
				$this->para[2]=$_SESSION['SEL_3'];
				$this->para[3]=$_SESSION['SEL_5'];
				$i=intval($this->para[3]);			
				unset($_SESSION['EXCEL_OUT']);
			}
			else
			{
				$this->para[0]=$_POST['sel1'];
				$this->para[1]=$_POST['sel2'];
				$this->para[2]=$_POST['sel3'];
				$this->para[3]=$_POST['starttime'];
				$i=intval($_POST['starttime']);
			}
		}
		$this->get_used_db($i);
	}//}}}	
//{{{public function __destruct()
	public function __destruct()
	{
		unset($this->db);unset($this->con_std);unset($this->con_val);
	}//}}}
//{{{public function get_used_db($y)
	public function get_used_db($y)
	{
		global $DB_ADDR_TY,$DB_PORT_TY,$DB_NAME_TY,$DB_PWD_TY;
		global $DB_USER_TY;
		if(!isset($DB_ADDR_TY[$y]))
			die("你所选择的日期".$i."年，没有数据！");
		$this->db=array();
		array_push($this->db,$DB_ADDR_TY[$y]);
		array_push($this->db,$DB_PORT_TY[$y]);
		array_push($this->db,$DB_NAME_TY[$y]);
		array_push($this->db,$DB_USER_TY);
		array_push($this->db,$DB_PWD_TY);
	}//}}}
//{{{public function parse_sql()
	public function parse_sql()
	{//废气
//2017-1-10添加实时界面中日均值显示
		if($this->para[2]==0)//实时值
		{
			$cur_table="fq_m_master";
			$cur_date=" > date_add(now(),interval -1 day)";
		}
		else
		{
			$cur_table="fq_d_master";
			$cur_date=" = '".$this->para[3]." 00:00:00'";
		}
		switch($_SESSION['sys_level'])
		{
		case 0://县区级
			$s1="SELECT e.uid,e.uname,e.date,e.so2,e.nox,e.dust,e.o2,e.dll FROM (SELECT b.uid,b.uname,a.date,a.so2,a.nox,a.dust,a.o2,a.dll FROM zd_info as b LEFT JOIN %s as a ON a.date %s AND a.uid = b.uid WHERE b.utype = 1 AND b.ctlvl = %d ORDER BY a.date DESC) AS e GROUP BY e.uid";
			$this->con_val=sprintf($s1,$cur_table,$cur_date,$this->para[1]);
			$s1="SELECT a.uid,b.iid,b.std1,b.std1_area,b.std2 FROM zd_info AS a,gb_std AS b WHERE a.utype = 1 AND a.ctlvl = %d AND a.uid = b.uid AND '%s' BETWEEN  b.sttm AND b.edtm";
			$s2=$this->para[3]." 00:00:01";
			$this->con_std=sprintf($s1,$this->para[1],$s2);
			break;
		case 1://省级
			$s1="SELECT e.uid,e.uname,e.date,e.so2,e.nox,e.dust,e.o2,e.dll FROM (SELECT b.uid,b.uname,a.date,a.so2,a.nox,a.dust,a.o2,a.dll FROM zd_info as b LEFT JOIN %s AS a ON a.date %s AND a.uid = b.uid  WHERE b.aid BETWEEN %u AND %u AND b.utype = 1 AND b.ctlvl = %d ORDER BY a.date DESC) AS e GROUP BY e.uid";
			$i=intval($this->para[0])+1;
			$j=$i+98;
			$this->con_val=sprintf($s1,$cur_table,$cur_date,$i,$j,$this->para[1]);
			$s1="SELECT a.uid,b.iid,b.std1,b.std1_area,b.std2 FROM zd_info AS a,gb_std AS b WHERE a.aid BETWEEN %u AND %u AND a.utype = 1 AND a.ctlvl = %d AND a.uid = b.uid AND '%s' BETWEEN  b.sttm AND b.edtm";
			$s2=$this->para[3]." 00:00:01";
			$this->con_std=sprintf($s1,$i,$j,$this->para[1],$s2);
			break;
		case 2://地市级
			$s1="SELECT e.uid,e.uname,e.date,e.so2,e.nox,e.dust,e.o2,e.dll FROM (SELECT b.uid,b.uname,a.date,a.so2,a.nox,a.dust,a.o2,a.dll FROM zd_info AS b LEFT JOIN %s AS a ON a.date %s AND a.uid = b.uid WHERE b.aid = %u AND b.utype = 1 AND b.ctlvl = %d ORDER BY a.date DESC) AS e GROUP BY e.uid";
			$this->con_val=sprintf($s1,$cur_table,$cur_date,$this->para[0],$this->para[1]);
			$s1="SELECT a.uid,b.iid,b.std1,b.std1_area,b.std2 FROM zd_info AS a,gb_std AS b WHERE a.aid = %u AND a.utype = 1 AND a.ctlvl = %d AND a.uid = b.uid AND '%s' BETWEEN  b.sttm AND b.edtm";
			$s2=$this->para[3]." 00:00:01";
			$this->con_std=sprintf($s1,$this->para[0],$this->para[1],$s2);
			break;
		default:
			$this->con_val="sys_level=".$_SESSION['sys_level'];
			break;
		};
		$s1="SELECT b.uid,a.std1,a.std1_area,a.std2 FROM gb_std a,zd_info b WHERE b.utype = 0 AND b.ctlvl = %d AND b.uid = a.uid AND b.sttm < %s AND b.edtm > %s ORDER BY b.uid,a.iid";
	}//}}}
//{{{public function get_std()
	public function get_std()
	{
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			die("connect error");
		mysqli_set_charset($mysqli,"utf8");
		if($res=mysqli_query($mysqli,$this->con_std))
		{
			$vay=array();
			while($row=mysqli_fetch_row($res))
				array_push($vay,$row);
			mysqli_free_result($res);
		}
		else
		{
			$s1=mysqli_error($mysqli);
			mysqli_close($mysqli);
			die($s1."<br>".$this->con_std);
		}
		mysqli_close($mysqli);
		$i=count($vay);
		$by=array();
		for($j=0;$j<$i;$j++)
		{
			$ay=$vay[$j];
			if(strlen($ay[3]) == 8)
			{
				$s1=substr($ay[3],0,4); //取得开始的日期
				$b1=intval($s1);
				$s1=substr($ay[3],4,4); //取得结束日期
				$b2=intval($s1);
				$s1=substr($this->para[3],5,5);
				$a1=intval($s1);$a1*=100;
				$a2=intval(substr($s1,3,2));
				$a1+=$a2;				//取得记录的日期
				if(($a1>=$b1) && ($a1<=$b2))
				{
					if(intval($ay[1]) == 101) //so2
						$by[$ay[0]][0]=$ay[2];
					else
					{
						if(intval($ay[1]) == 102) //nox
							$by[$ay[0]][1]=$ay[2];
						else //207
							$by[$ay[0]][2]=$ay[2]; //dust
					}
				} //使用标准1
				else
				{
					if(intval($ay[1]) == 101) //so2
						$by[$ay[0]][0]=$ay[4];
					else
					{
						if(intval($ay[1]) == 102) //nox
							$by[$ay[0]][1]=$ay[4];
						else//207
							$by[$ay[0]][2]=$ay[4];//dust
					}
				}//使用标准2
			}
			else
			{
				if(strlen($ay[3])>1)
				{
					$s1=strval(strlen($ay[3]));
					die($s1);
				}
				if(intval($ay[1]) == 101) //so2
					$by[$ay[0]][0]=$ay[2];
				else
				{
					if(intval($ay[1]) == 102) //nox
						$by[$ay[0]][1]=$ay[2];
					else //207
						$by[$ay[0]][2]=$ay[2];//dust
				}
			}
		}
		$cy=$this->get_unit();
		$i=count($cy);
		$ey=array();
		for($j=0;$j<$i;$j++)
		{
			$y=$cy[$j];
			$x=array();
			$x[0]=intval($j)+1;	//序号
			$x[1]=$y[1]; //uname
			if($y[2] == NULL) 
			{
				$x[2]="---";$x[3]="---";$x[4]=$by[$y[0]][0];
				$x[5]="---";$x[6]=$by[$y[0]][1];
				$x[7]="---";$x[8]=$by[$y[0]][2];
				$x[9]="---";$x[10]="---";
			}
			else
			{
				$x[2]=substr($y[2],5,11);
				$x[3]=$y[3];$x[4]=$by[$y[0]][0];
				$x[5]=$y[4];$x[6]=$by[$y[0]][1];
				$x[7]=$y[5];$x[8]=$by[$y[0]][2];
				$x[9]=$y[6];$x[10]=$y[7];
			}
			array_push($ey,$x);
		}
		return $ey;
	}//}}}
//{{{public function get_unit()
	public function get_unit()
	{
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			die("connect error");
		mysqli_set_charset($mysqli,"utf8");
		if($res=mysqli_query($mysqli,$this->con_val))
		{
			$vay=array();
			while($row=mysqli_fetch_row($res))
				array_push($vay,$row);
			mysqli_free_result($res);
		}
		else
		{
			$s1=mysqli_error($mysqli);
			mysqli_close($mysqli);
			var_dump($this->db);
			die("mysql query error!<br>".$s1);
		}
		mysqli_close($mysqli);
		return $vay;
	}//}}}
}//}}}
////////////////////////////////////////////////////////////
//{{{class data_wsright implements main_data 污水厂实时主界面数据及标准的获取类
class data_wsright implements main_data
{
	private $db;	//目标数据库的相关信息
	private $con_std,$con_val;//解析后生成的执行标准查询和数据查询SQL字符串
	private $para;//传入的参数
//{{{public function __construct()
	public function __construct()
	{
		$i=0;
		if(!isset($_POST['starttime']))
		{//这种处理方式可以保证没有submit之前，就能正常的显示主界面的数据
			if(!isset($_SESSION['INTR_SEND']))
				die("严重错误！Session变量错误！");
			$this->para=array();
			$this->para[0]=$_SESSION['INTR_SEND'];//控制区域aid
			if(isset($_SESSION['EXCEL_OUT']))
			{
				$this->para[0]=$_SESSION['SEL_1'];
				$this->para[1]=$_SESSION['SEL_2'];
				$this->para[2]=$_SESSION['SEL_3'];
				$this->para[3]=$_SESSION['SEL_5'];
				$i=intval($this->para[3]);			
				unset($_SESSION['EXCEL_OUT']);
			}
			else
			{
				$this->para[1]=0;//控制级别
				$this->para[2]=0;//数据类型
				$this->para[3]=date("Y-m-d",time());
				$ay=array();
				$ay=getdate(time());
				$i=$ay['year'];
			}
		}
		else
		{//正常的从post传递
			$this->para=array();
			if(isset($_SESSION['EXCEL_OUT']))
			{
				$this->para[0]=$_SESSION['SEL_1'];
				$this->para[1]=$_SESSION['SEL_2'];
				$this->para[2]=$_SESSION['SEL_3'];
				$this->para[3]=$_SESSION['SEL_5'];
				$i=intval($this->para[3]);			
				unset($_SESSION['EXCEL_OUT']);
			}
			else
			{
				$this->para[0]=$_POST['sel1'];
				$this->para[1]=$_POST['sel2'];
				$this->para[2]=$_POST['sel3'];
				$this->para[3]=$_POST['starttime'];
				$i=intval($_POST['starttime']);
			}
		}
		$this->get_used_db($i);
	}//}}}
//{{{public function __destruct()
	public function __destruct()
	{
		unset($this->db);unset($this->con_std);unset($this->con_val);
	}//}}}
//{{{public function get_used_db($y)
	public function get_used_db($y)
	{
		global $DB_ADDR_TY,$DB_PORT_TY,$DB_NAME_TY,$DB_PWD_TY;
		global $DB_USER_TY;
		if(!isset($DB_ADDR_TY[$y]))
			die("你所选择的日期".$i."年，没有数据！");
		$this->db=array();
		array_push($this->db,$DB_ADDR_TY[$y]);
		array_push($this->db,$DB_PORT_TY[$y]);
		array_push($this->db,$DB_NAME_TY[$y]);
		array_push($this->db,$DB_USER_TY);
		array_push($this->db,$DB_PWD_TY);
	}//}}}
//{{{public function parse_sql()
	public function parse_sql()
	{//污水厂
//2017-1-10添加实时界面中日均值显示
		if($this->para[2]==0)//实时值
		{
			$cur_table="wsc_h_master";
			$cur_date=" > date_add(now(),interval -1 day)";
		}
		else
		{
			$cur_table="wsc_d_master";
			$cur_date=" = '".$this->para[3]." 00:00:00'";
		}
		switch($_SESSION['sys_level'])
		{
		case 0://县市区
			$s1="SELECT e.uid,e.uname,e.date,e.cod,e.nhx,e.ll_sh,e.ll_jg,e.ll_lj FROM (SELECT b.uid,b.uname,a.date,a.cod,a.nhx,a.ll_sh,a.ll_jg,a.ll_lj FROM zd_info AS b LEFT JOIN %s AS a ON a.date %s AND a.uid = b.uid WHERE b.utype = 2 AND b.ctlvl = %d ORDER BY a.date DESC) AS e GROUP BY e.uid";
			$this->con_val=sprintf($s1,$cur_table,$cur_date,$this->para[1]);
			$s1="SELECT a.uid,b.iid,b.std1,b.std1_area,b.std2 FROM zd_info AS a,gb_std AS b WHERE a.utype = 2 AND a.ctlvl = %d AND a.uid = b.uid AND '%s' BETWEEN  b.sttm AND b.edtm";
			$s2=$this->para[3]." 00:00:01";
			$this->con_std=sprintf($s1,$this->para[1],$s2);
			break;
		case 1://省级
			$s1="SELECT e.uid,e.uname,e.date,e.cod,e.nhx,e.ll_sh,e.ll_jg,e.ll_lj FROM (SELECT b.uid,b.uname,a.date,a.cod,a.nhx,a.ll_sh,a.ll_jg,a.ll_lj FROM zd_info AS b LEFT JOIN %s AS a ON a.date %s AND a.uid = b.uid WHERE a.aid BETWEEN %u AND %u AND b.utype = 2 AND b.ctlvl = %d ORDER BY a.date DESC) AS e GROUP BY e.uid";
			$i=intval($this->para[0])+1;
			$j=$i+98;
			$this->con_val=sprintf($s1,$cur_table,$cur_date,$i,$j,$this->para[1]);
			$s1="SELECT a.uid,b.iid,b.std1,b.std1_area,b.std2 FROM zd_info AS a,gb_std AS b WHERE a.aid BETWEEN %u AND %u AND a.utype = 2 AND a.ctlvl = %d AND a.uid = b.uid AND '%s' BETWEEN  b.sttm AND b.edtm";
			$s2=$this->para[3]." 00:00:01";
			$this->con_std=sprintf($s1,$i,$j,$this->para[1],$s2);
			break;
		case 2://地市级
			$s1="SELECT e.uid,e.uname,e.date,e.cod,e.nhx,e.ll_sh,e.ll_jg,e.ll_lj FROM (SELECT b.uid,b.uname,a.date,a.cod,a.nhx,a.ll_sh,a.ll_jg,a.ll_lj FROM zd_info AS b LEFT JOIN %s AS a ON a.date %s AND a.uid = b.uid WHERE b.aid = %u AND b.utype = 2 AND b.ctlvl = %d ORDER BY a.date DESC) AS e GROUP BY e.uid";
			$this->con_val=sprintf($s1,$cur_table,$cur_date,$this->para[0],$this->para[1]);
			$s1="SELECT a.uid,b.iid,b.std1,b.std1_area,b.std2 FROM zd_info AS a,gb_std AS b WHERE a.aid = %u AND a.utype = 2 AND a.ctlvl = %d AND a.uid = b.uid AND '%s' BETWEEN  b.sttm AND b.edtm";
			$s2=$this->para[3]." 00:00:01";
			$this->con_std=sprintf($s1,$this->para[0],$this->para[1],$s2);
			break;
		};
		$s1="select a.uid,b.iid,b.std1,b.std1_area,b.std2 from zd_info a,gb_std b where a.aid = 370901 and a.utype = 2 and a.ctlvl = 0 and a.uid = b.uid and '2016-05-28 10:00:00' > b.sttm and '2016-05-28 10:00:00' < b.edtm";
	}//}}}
//{{{public function get_std()
	public function get_std()
	{//该函数原本只是用来获取标准数据的，现改为先获取标准然后调用get_unit()函数获取数据，最后整合数据并返回整合的数组
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			die("connect error");
		mysqli_set_charset($mysqli,"utf8");
		if($res=mysqli_query($mysqli,$this->con_std))
		{
			$vay=array();
			while($row=mysqli_fetch_row($res))
				array_push($vay,$row);
			mysqli_free_result($res);
		}
		else
		{
			$s1=mysqli_error($mysqli);
			mysqli_close($mysqli);
			die($s1."<br>".$this->con_std);
		}
		mysqli_close($mysqli);
		$i=count($vay);
		$by=array();
		for($j=0;$j<$i;$j++)
		{
			$ay=$vay[$j];
			if(strlen($ay[3]) == 8)
			{
				$s1=substr($ay[3],0,4); //取得开始的日期
				$b1=intval($s1);
				$s1=substr($ay[3],4,4); //取得结束日期
				$b2=intval($s1);
				$s1=substr($this->para[3],5,5);
				$a1=intval($s1);$a1*=100;
				$a2=intval(substr($s1,3,2));
				$a1+=$a2;				//取得记录的日期
				if(($a1>=$b1) && ($a1<=$b2))
				{
					if(intval($ay[1]) == 316) //cod
						$by[$ay[0]][0]=$ay[2];
					else
						$by[$ay[0]][1]=$ay[2];
				} //使用标准1
				else
				{
					if(intval($ay[1]) == 316) //cod
						$by[$ay[0]][0]=$ay[4];
					else
						$by[$ay[0]][1]=$ay[4];
				}//使用标准2
			}
			else
			{
				if(strlen($ay[3])>1)
				{
					$s1=strval(strlen($ay[3]));
					die($s1);
				}
				if(intval($ay[1]) == 316)
					$by[$ay[0]][0]=$ay[2];//cod
				else
					$by[$ay[0]][1]=$ay[2];//nhx
			}
		}
		//
		$cy=$this->get_unit();
		$i=count($cy);
		$ey=array();
		for($j=0;$j<$i;$j++)
		{
			$y=$cy[$j];
			$x=array();
			$x[0]=intval($j)+1;
			$x[1]=$y[1]; //name
			if($y[2] == NULL)
			{
				$x[2]="---";$x[3]="---";$x[4]=$by[$y[0]][0];
				$x[5]="---";$x[6]=$by[$y[0]][1];
				$x[7]="---";$x[8]="---";$x[9]="---";
			}
			else
			{
				$x[2]=substr($y[2],5,11);//date
				$x[3]=$y[3];//cod
				$x[4]=$by[$y[0]][0]; //std cod
				$x[5]=$y[4];//nhx
				$x[6]=$by[$y[0]][1];//std nhx
				$x[7]=$y[5];//ll_sh
				$x[8]=$y[6];//ll_jg
				$x[9]=$y[7]; //ll_lj
			}
			array_push($ey,$x);
		}
		return $ey;
	}//}}}
//{{{public function get_unit()
	public function get_unit()
	{
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			die("connect error");
		mysqli_set_charset($mysqli,"utf8");
		if($res=mysqli_query($mysqli,$this->con_val))
		{
			$vay=array();
			while($row=mysqli_fetch_row($res))
				array_push($vay,$row);
			mysqli_free_result($res);
		}
		else
		{
			$s1=mysqli_error($mysqli);
			mysqli_close($mysqli);
			var_dump($this->db);
			die("mysql query error!<br>".$s1."<br>"."$this->con_val");
		}
		mysqli_close($mysqli);
		return $vay;
	}//}}}

}//}}}
///////////////////////////////////////////////////////////
//{{{class data_sright_mx implements main_data_ex 废水及污水厂明晰主界面数据及标准的获取类
class data_sright_mx implements main_data_ex
{
	private $db;//目标数据库相关信息
	private $con_std,$con_val; //解析后生成的执行标准查询字符串和项目数据查询字符串
	private $para; //保存post传入的参数
	private $w;
//{{{public function __construct($y)
	public function __construct($y)
	{
		$i=0;
		$this->para=array();
		$this->w=$y;// y=1 废水 y=2 污水厂
		if(!isset($_POST['starttime']))
		{
			if(!isset($_SESSION['INTR_SEND']))
				die("符合当前控制级别和控制区域的站点为空，请指定查询的站点!");
			$this->para[0]=$_SESSION['INTR_SEND'];//uid,这里和实时界面传递的参数不同，不再是aid
			if(isset($_SESSION['EXCEL_OUT']))
			{
				$this->para[0]=$_SESSION['SEL_3'];
				$this->para[1]=$_SESSION['SEL_2'];
				$this->para[2]=$_SESSION['SEL_4'];
				$this->para[3]=$_SESSION['SEL_5'];
				$i=intval($this->para[3]);			
				unset($_SESSION['EXCEL_OUT']);
			}
			else
			{
				$this->para[1]=0;//控制级别
				$this->para[2]=0;//数据类型
				$this->para[3]=date("Y-m-d",time()); //默认日期
				$ay=array();
				$ay=getdate(time());
				$i=$ay['year'];
			}
		}
		else
		{//这是正常的从post传递
			if(isset($_SESSION['EXCEL_OUT']))
			{
				$this->para[0]=$_SESSION['SEL_3'];
				$this->para[1]=$_SESSION['SEL_2'];
				$this->para[2]=$_SESSION['SEL_4'];
				$this->para[3]=$_SESSION['SEL_5'];
				$i=intval($this->para[3]);			
				unset($_SESSION['EXCEL_OUT']);
			}
			else
			{
				if(isset($_POST['sel2p']))
					$this->para[0]=$_POST['sel2p'];
				else
					$this->para[0]=0;
				$this->para[1]=$_POST['sel3p'];
				$this->para[2]=$_POST['sel3'];
				$this->para[3]=$_POST['starttime'];
				$i=intval($_POST['starttime']);			
			}
		}
		$this->get_used_db($i);
	}//}}}
//{{{public function __destruct()
	public function __destruct()
	{
		unset($this->db);unset($this->con_std);unset($this->con_val);
	}//}}}
//{{{public function get_used_db($y)
	public function get_used_db($y)
	{
		global $DB_ADDR_TY,$DB_PORT_TY,$DB_NAME_TY,$DB_PWD_TY;
		global $DB_USER_TY;
		if(!isset($DB_ADDR_TY[$y]))
			die("你所选择的日期".$i."年，没有数据！");
		$this->db=array();
		array_push($this->db,$DB_ADDR_TY[$y]);
		array_push($this->db,$DB_PORT_TY[$y]);
		array_push($this->db,$DB_NAME_TY[$y]);
		array_push($this->db,$DB_USER_TY);
		array_push($this->db,$DB_PWD_TY);
	}//}}}
//{{{public function parse_sql()
	public function parse_sql()
	{
		switch($this->para[2])
		{
			case 0://小时值
				if($this->w == 1)//废水
					$s1="SELECT date,cod,nhx,ll_sh,ll_jg,ll_lj FROM fs_h_master WHERE uid = %u AND date BETWEEN '%s' AND '%s' ORDER BY date";
				else //污水厂
					$s1="SELECT date,cod,nhx,ll_sh,ll_jg,ll_lj FROM wsc_h_master WHERE uid = %u AND date BETWEEN '%s' AND '%s' ORDER BY date";
				break;
			case 1://日均值
				if($this->w == 1)
					$s1="SELECT date,cod,nhx,ll_sh,ll_jg,ll_lj FROM fs_d_master WHERE uid = %u AND date BETWEEN '%s' AND '%s' ORDER BY date";
				else
					$s1="SELECT date,cod,nhx,ll_sh,ll_jg,ll_lj FROM wsc_d_master WHERE uid = %u AND date BETWEEN '%s' AND '%s' ORDER BY date";
				break;
//注意：这里的超标查询字符串不完善，还需要和执行标准的比较，所以，要在取得了执行标准后在完善：" AND (cod >= %0.2f OR nhx >= %0.2f) ORDER BY date";
			case 2://小时超标值
				if($this->w == 1)
					$s1="SELECT date,cod,nhx,ll_sh,ll_jg,ll_lj FROM fs_h_master WHERE uid = %u AND date BETWEEN '%s' AND '%s'";
				else
					$s1="SELECT date,cod,nhx,ll_sh,ll_jg,ll_lj FROM wsc_h_master WHERE uid = %u AND date BETWEEN '%s' AND '%s'";
				break;
			case 3://日均超标值
				if($this->w == 1)
					$s1="SELECT date,cod,nhx,ll_sh,ll_jg,ll_lj FROM fs_d_master WHERE uid = %u AND date BETWEEN '%s' AND '%s'";
				else
					$s1="SELECT date,cod,nhx,ll_sh,ll_jg,ll_lj FROM wsc_d_master WHERE uid = %u AND date BETWEEN '%s' AND '%s'";
				break;
		}
		if(($this->para[2] == 1) || ($this->para[2] == 3))
		{//日均值相关的日期设定
			$s2=substr($this->para[3],0,8)."01 00:00:00";
			$s3=$this->para[3]." 23:59:59";
		}
		else
		{//小时值相关的日期设定
			$s2=$this->para[3]." 00:00:00";
			$s3=$this->para[3]." 23:59:59";
		}
		$this->con_val=sprintf($s1,$this->para[0],$s2,$s3);//这里暂时不对超标值进行处理。
		$s1="SELECT iid,std1,std1_area,std2 FROM gb_std WHERE uid = %u AND '%s' BETWEEN sttm AND edtm";
		$s2=$this->para[3]." 00:00:01";
		$this->con_std=sprintf($s1,$this->para[0],$s2);
	}//}}}
//{{{public function get_std()
	public function get_std()
	{
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			die("connect error");
		mysqli_set_charset($mysqli,"utf8");
		if($res=mysqli_query($mysqli,$this->con_std))
		{
			$vay=array();
			while($row=mysqli_fetch_row($res))
				array_push($vay,$row);
			mysqli_free_result($res);
		}
		else
		{
			$s1=mysqli_error($mysqli);
			mysqli_close($mysqli);
			die("mysql query error!<br>".$s1."<br>"."$this->con_std");
		}
		mysqli_close($mysqli);
		$i=count($vay);
		$by=array();
		for($j=0;$j<$i;$j++)
		{
			$ay=$vay[$j];
			if(strlen($ay[2]) == 8)
			{
				$s1=substr($ay[2],0,4); //取得开始的日期
				$b1=intval($s1);
				$s1=substr($ay[2],4,4); //取得结束日期
				$b2=intval($s1);
				$s1=substr($this->para[3],5,5);
				$a1=intval($s1);$a1*=100;
				$a2=intval(substr($s1,3,2));
				$a1+=$a2;				//取得记录的日期
				if(($a1>=$b1) && ($a1<=$b2))
				{
					if(intval($ay[0]) == 316) //cod
						$by[0] = $ay[1];//cod
					else
						$by[1] = $ay[1];//nhx
				}
				else //使用标准2
				{
					if(intval($ay[0]) == 316) //cod
						$by[0] = $ay[3];
					else
						$by[1] = $ay[3];
				}
			}
			else
			{
				if(intval($ay[0]) == 316) //cod
					$by[0] = $ay[1];//cod
				else
					$by[1] = $ay[1];//nhx
			}
		}
//2016-12-20 修改，到这里标准值已经取得，可以对超标值的查询关键字符串进行最终格式化了		
		$cy=$this->get_unit($by);
		$i=count($cy);
		$ey=array();
		for($j=0;$j<$i;$j++)
		{
			$y=$cy[$j];
			$x=array();
			$x[0]=$j;	//序号
			$x[1]=$y[0];//date
			$x[2]=$y[1];//cod
			$x[3]=$by[0];//cod std
			$x[4]=$y[2];//nhx
			$x[5]=$by[1];//nhx std
			$x[6]=$y[3];//ll_sh
			$x[7]=$y[4];//ll_jg
			$x[8]=$y[5];//ll_lj
			array_push($ey,$x);
		}
		return $ey;
	}//}}}
//{{{public function get_unit($pp)
	public function get_unit($pp)
	{
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			die("connect error");
		mysqli_set_charset($mysqli,"utf8");
		if($this->para[2] >1)
		{//这里，要完善对超标查询字符串的构造
			$s1=$this->con_val." AND (cod >= %0.2f OR nhx >= %0.2f) ORDER BY date";
			$this->con_val=sprintf($s1,$pp[0],$pp[1]);			
		}
		if($res=mysqli_query($mysqli,$this->con_val))
		{
			$vay=array();
			while($row=mysqli_fetch_row($res))
				array_push($vay,$row);
			mysqli_free_result($res);
		}
		else
		{
			$s1=mysqli_error($mysqli);
			mysqli_close($mysqli);
//			var_dump($this->db);
//			print_r($this->db);
			die("mysql query error!<br>".$s1."<br>"."$this->con_val");
		}
		mysqli_close($mysqli);
		return $vay;
	}//}}}
}//}}}
///////////////////////////////////////////////////////////////////////////
//{{{class data_qright_mx implements main_data_x 废气明晰主界面数据及标准的获取类
class data_qright_mx implements main_data_ex
{
	private $db;//目标数据库相关信息
	private $con_std,$con_val; //解析后生成的执行标准查询字符串和项目数据查询字符串
	private $para; //保存post传入的参数
//{{{public function __construct()
	public function __construct()
	{
		$i=0;
		$this->para=array();
		if(!isset($_POST['starttime']))
		{
			if(!isset($_SESSION['INTR_SEND']))
				die("符合当前控制级别和控制区域的站点为空，请指定查询的站点!");
			$this->para[0]=$_SESSION['INTR_SEND'];//uid,这里和实时界面传递的参数不同，不再是aid
			if(isset($_SESSION['EXCEL_OUT']))
			{
				$this->para[0]=$_SESSION['SEL_3'];
				$this->para[1]=$_SESSION['SEL_2'];
				$this->para[2]=$_SESSION['SEL_4'];
				$this->para[3]=$_SESSION['SEL_5'];
				$i=intval($this->para[3]);			
				unset($_SESSION['EXCEL_OUT']);
			}
			else
			{
				$this->para[1]=0;//控制级别
				$this->para[2]=0;//数据类型
				$this->para[3]=date("Y-m-d",time()); //默认日期
				$ay=array();
				$ay=getdate(time());
				$i=$ay['year'];
			}
		}
		else
		{//这是正常的从post传递
			if(isset($_SESSION['EXCEL_OUT']))
			{
				$this->para[0]=$_SESSION['SEL_3'];
				$this->para[1]=$_SESSION['SEL_2'];
				$this->para[2]=$_SESSION['SEL_4'];
				$this->para[3]=$_SESSION['SEL_5'];
				$i=intval($this->para[3]);			
				unset($_SESSION['EXCEL_OUT']);
			}
			else
			{
				$this->para[0]=$_POST['sel2p'];
				$this->para[1]=$_POST['sel3p'];
				$this->para[2]=$_POST['sel3'];
				$this->para[3]=$_POST['starttime'];
				$i=intval($_POST['starttime']);			
			}
		}
		$this->get_used_db($i);
	}//}}}
//{{{public function __destruct()
	public function __destruct()
	{
		unset($this->db);unset($this->con_std);unset($this->con_val);
	}//}}}
//{{{public function get_used_db($y)
	public function get_used_db($y)
	{
		global $DB_ADDR_TY,$DB_PORT_TY,$DB_NAME_TY,$DB_PWD_TY;
		global $DB_USER_TY;
		if(!isset($DB_ADDR_TY[$y]))
			die("你所选择的日期".$i."年，没有数据！");
		$this->db=array();
		array_push($this->db,$DB_ADDR_TY[$y]);
		array_push($this->db,$DB_PORT_TY[$y]);
		array_push($this->db,$DB_NAME_TY[$y]);
		array_push($this->db,$DB_USER_TY);
		array_push($this->db,$DB_PWD_TY);
	}//}}}
//{{{public function parse_sql()
	public function parse_sql()
	{//废气
		switch($this->para[2])
		{
			case 0://小时值
				$s1="SELECT date,so2,nox,dust,o2,dll FROM fq_h_master WHERE uid = %u AND date BETWEEN '%s' AND '%s' ORDER BY date";
				break;
			case 1://日均值
				$s1="SELECT date,so2,nox,dust,o2,dll FROM fq_d_master WHERE uid = %u AND date BETWEEN '%s' AND '%s' ORDER BY date";
				break;
			case 2://小时超标值 --这里同样不是完整的SQLSTR
				$s1="SELECT date,so2,nox,dust,o2,dll FROM fq_h_master WHERE uid = %u AND date BETWEEN '%s' AND '%s'";
				break;
			case 3://日均超标
				$s1="SELECT date,so2,nox,dust,o2,dll FROM fq_d_master WHERE uid = %u AND date BETWEEN '%s' AND '%s'";
				break;
		}
		if(($this->para[2] == 1) || ($this->para[2] == 3))
		{//日均值相关的日期设定
			$s2=substr($this->para[3],0,8)."01 00:00:00";
			$s3=$this->para[3]." 23:59:59";
		}
		else
		{//小时值相关的日期设定
			$s2=$this->para[3]." 00:00:00";
			$s3=$this->para[3]." 23:59:59";
		}
		$this->con_val=sprintf($s1,$this->para[0],$s2,$s3);//这里暂时不对超标值进行处理。
		$s1="SELECT iid,std1,std1_area,std2 FROM gb_std WHERE uid = %u AND '%s' BETWEEN sttm AND edtm";
		$s2=$this->para[3]." 00:00:01";
		$this->con_std=sprintf($s1,$this->para[0],$s2);
	}//}}}
//{{{public function get_std()
	public function get_std()
	{
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			die("connect error");
		mysqli_set_charset($mysqli,"utf8");
		if($res=mysqli_query($mysqli,$this->con_std))
		{
			$vay=array();
			while($row=mysqli_fetch_row($res))
				array_push($vay,$row);
			mysqli_free_result($res);
		}
		else
		{
			$s1=mysqli_error($mysqli);
			mysqli_close($mysqli);
			die("mysql query error!<br>".$s1."<br>"."$this->con_std");
		}
		mysqli_close($mysqli);
		$i=count($vay);
		$by=array();
		for($j=0;$j<$i;$j++)
		{
			$ay=$vay[$j];
			if(strlen($ay[2]) == 8)
			{
				$s1=substr($ay[2],0,4); //取得开始的日期
				$b1=intval($s1);
				$s1=substr($ay[2],4,4); //取得结束日期
				$b2=intval($s1);
				$s1=substr($this->para[3],5,5);
				$a1=intval($s1);$a1*=100;
				$a2=intval(substr($s1,3,2));
				$a1+=$a2;				//取得记录的日期
				if(($a1>=$b1) && ($a1<=$b2))
				{
					if(intval($ay[0]) == 101) //so2
						$by[0]=$ay[1];
					else
					{
						if(intval($ay[0]) == 102) //nox
							$by[1]=$ay[1];
						else //207
							$by[2]=$ay[1]; //dust
					}
				} //使用标准1
				else
				{
					if(intval($ay[0]) == 101) //so2
						$by[0]=$ay[3];
					else
					{
						if(intval($ay[0]) == 102) //nox
							$by[1]=$ay[3];
						else//207
							$by[2]=$ay[3];//dust
					}
				}//使用标准2
			}
			else
			{
				if(strlen($ay[2])>1)
				{
					$s1=strval(strlen($ay[3]));
					die($s1);
				}
				if(intval($ay[0]) == 101) //so2
					$by[0]=$ay[1];
				else
				{
					if(intval($ay[0]) == 102) //nox
						$by[1]=$ay[1];
					else //207
						$by[2]=$ay[1];//dust
				}
			}
		}
//2016-12-23 修改		
		$cy=$this->get_unit($by);
		$i=count($cy);
		$ey=array();
		for($j=0;$j<$i;$j++)
		{
			$y=$cy[$j];
			$x=array();
			$x[0]=intval($j)+1; //序号
			$x[1]=$y[0];		//date
			$x[2]=$y[1];		//so2
			$x[3]=$by[0];		//so2 std
			$x[4]=$y[2];		//nox
			$x[5]=$by[1];		//nox std
			$x[6]=$y[3];		//dust
			$x[7]=$by[2];		//dust std
			$x[8]=$y[4];		//o2
			$x[9]=$y[5];		//dll
			array_push($ey,$x);
		}
		return $ey;
	}//}}}
//{{{public function get_unit($pp)
	public function get_unit($pp)
	{
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			die("connect error");
		mysqli_set_charset($mysqli,"utf8");
		if($this->para[2] > 1)
		{//超标值，需要完善查询字符串
			$s1=$this->con_val." AND (so2 >= %0.2f OR nox >= %0.2f OR dust >= %0.2f) ORDER BY date";
			$this->con_val=sprintf($s1,$pp[0],$pp[1],$pp[2]);
		}
		if($res=mysqli_query($mysqli,$this->con_val))
		{
			$vay=array();
			while($row=mysqli_fetch_row($res))
				array_push($vay,$row);
			mysqli_free_result($res);
		}
		else
		{
			$s1=mysqli_error($mysqli);
			mysqli_close($mysqli);
			die("mysql query error!<br>".$s1."<br>"."$this->con_val");
		}
		mysqli_close($mysqli);
		return $vay;
	}//}}}
}//}}}
/////////////////////////////////////////////////////////////
//{{{class init_tab implements listbox_data 控制界面数据的获取类
class init_tab implements listbox_data
{
	private $conn,$str_sj,$str_ds;
	private $str_uxq,$str_usj,$str_uds;
	private $rq,$db,$utp;
//{{{public function __construct($y)	
	public function __construct($y)
	{
		if(!is_array($y))
			die("参数错误！");
		if(($y[1] == 0)||($y[1] == 1)||($y[1] == 2))
		{	$this->utp=$y[1];}
		else
			die("参数错误11！");
		if($y[0] != 0)
			$this->rq=intval($y[0]);
		else
			$this->get_cur_year();
		$this->get_used_db();
		$this->conn="SELECT aid,aname FROM area_info WHERE bused = 1";
		$this->str_sj="SELECT aid,aname FROM area_info WHERE aid BETWEEN %u AND %u AND aid%100 = 0";
		$this->str_ds="SELECT aid,aname FROM area_info WHERE aid BETWEEN %u AND %u";
		$this->str_uxq="SELECT uid,uname,ctlvl FROM zd_info WHERE utype = %d";//对于县区级，所有站点的aid都一样，所以无需判断
		$this->str_usj="SELECT uid,uname,ctlvl FROM zd_info WHERE utype = %d AND aid BETWEEN %u AND %u";//省级，需要获取在一定区间内的aid
		$this->str_uds="SELECT uid,uname,ctlvl FROM zd_info WHERE utype = %d AND aid = %u";//地市级，需要获取等于指定的aid
	}//}}}
//{{{public function __destruct()
	public function __destruct()
	{
		unset($this->db);
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
//{{{public function get_ctlarea()
	public function get_ctlarea()
	{
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			die("connect error");
		mysqli_set_charset($mysqli,"utf8");
		$res=mysqli_query($mysqli,$this->conn);
		if(mysqli_num_rows($res) != 1)
		{
			mysqli_free_result($res);
			mysqli_close($mysqli);
			die("严重错误！行政区划的设定错误！");
		}
		$row=mysqli_fetch_row($res);
		$ay=array();
		if($row[0]%10000 == 0) //省级系统
		{
			$_SESSION['sys_level'] = 1;
			$i=intval($row[0])+1;
			$j=$i+9998;
			$s1=sprintf($this->str_sj,$i,$j);
		}
		else
		{
			if($row[0]%100 == 0) //地市级系统
			{
				$_SESSION['sys_level'] = 2;
				$i=intval($row[0])+1;
				$j=$i+98;
				$s1=sprintf($this->str_ds,$i,$j);
			}
			else
			{
				$_SESSION['sys_level'] = 0; //县区级系统
				array_push($ay,$row);
			}
		}
		mysqli_free_result($res);
		if($_SESSION['sys_level'] > 0)
		{
			$res=mysqli_query($mysqli,$s1);
			while($row=mysqli_fetch_row($res))
				array_push($ay,$row);
			mysqli_free_result($res);
		}
		mysqli_close($mysqli);
		return $ay;
	}//}}}
//{{{public function get_unit($y)
	public function get_unit($y)
	{
		global $arry;
		if(!is_array($arry))
			$arry=array();
		if(!is_array($y))
			die("缺少传入参数或参数错误！");
		if(!isset($_SESSION['sys_level']))
			die("控制区域错误，无法取得相应的站点信息");
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			die("connect error");
		mysqli_set_charset($mysqli,"utf8");
		if($_SESSION['sys_level'] == 0) //县区级
		{
			//$s1=sprintf($this->str_uxq,$y[0][0]);
			$s1=sprintf($this->str_uxq,$this->utp);
			for($i=0;$i<5;$i++)
				$dy[$i]=array();
			$res=mysqli_query($mysqli,$s1);
			while($row=mysqli_fetch_row($res))
			{
				if($row[2] > 4)
				{
					mysqli_free_result($res);
					mysqli_close($mysqli);
					die("越界错误！");
				}
				array_push($dy[$row[2]],$row);
			}
			$ey=array();
			for($i=0;$i<5;$i++)
				array_push($ey,$dy[$i]);
			array_push($arry,$ey);//保证与省市控的处理一致，并同步全局变量
			mysqli_free_result($res);
			mysqli_close($mysqli);
			return;
		}
		if($_SESSION['sys_level'] == 1) //省级
		{
			$i=count($y);
			for($j=0;$j<$i;$j++)
			{
				for($k=0;$k<5;$k++)
					$dy[$k]=array();
				$cy=$y[$j];
				$m=intval($cy[0])+1;
				$n=$m+98;
				$s1=sprintf($this->str_usj,$this->utp,$m,$n);
				$res=mysqli_query($mysqli,$s1);
				while($row=mysqli_fetch_row($res))
				{
					if($row[2] > 4)
					{
						mysqli_free_result($res);
						mysqli_close($mysqli);
						die("越界错误1！");
					}
					array_push($dy[$row[2]],$row);
				}
				$ey=array();
				for($k=0;$k<5;$k++)
					array_push($ey,$dy[$k]);
				array_push($arry,$ey);//并同步全局变量
				mysqli_free_result($res);
			}
			mysqli_close($mysqli);
			return;
		}
		if($_SESSION['sys_level'] == 2) //地市级
		{
			$i=count($y);
			for($j=0;$j<$i;$j++)
			{
				$cy=$y[$j];
				$s1=sprintf($this->str_uds,$this->utp,$cy[0]);
				for($k=0;$k<5;$k++)
					$dy[$k]=array();
				$res=mysqli_query($mysqli,$s1);
				while($row=mysqli_fetch_row($res))
				{
					if($row[2] > 4)
					{
						mysqli_free_result($res);
						mysqli_close($mysqli);
						die("越界错误1！");
					}
					array_push($dy[$row[2]],$row);
				}
				$ey=array();
				for($k=0;$k<5;$k++)
					array_push($ey,$dy[$k]);
				array_push($arry,$ey);//并同步全局变量
				mysqli_free_result($res);
			}
			mysqli_close($mysqli);
			return;
		}
	}//}}}
}//}}}

//////////////////////////////////////////////////////////////
//{{{class mx_g implements gra_data
/*class mx_g implements gra_data
{
	private $xway,$yway,$gdata,$gd;
	private $tm,$w,$d; //日期，表类型，数据类型，数据类型：0,1,2,3 小时值，日均值，小时超标，日均超标
//{{{public function __construct($y)
	public function __construct($y)
	{//需要传入的参数：sel2p(站点id),sel3(数据类型)，日期（starttime）,当前操作界面（废水，废气，污水厂，这个是有函数参数传入）
		switch($y)
		{
		case 1:	//废水
		case 2://污水厂
			$a=new data_sright_mx($y);
			$a->parse_sql();
			$this->gdata=$a->get_std();
			$this->w=$y;
			break;
		default: //废气
			$a=new data_qright_mx();
			$a->parse_sql();
			$this->gdata=$a->get_std();
			$this->w=0;
			break;
		};
		$this->tm=$_POST['starttime'];
		$this->d=$_POST['sel3'];
		unset($_SESSION['fs_g_xway']);
		unset($_SESSION['fs_g_yway']);
		unset($_SESSION['fs_g_data']);
	}//}}}
//{{{public function __destruct()
	public function __destruct()
	{unset($this->gdata);unset($this->xway);unset($this->yway);}//}}}
//{{{public function range_xway()
	public function range_xway()
	{
		$this->xway=array();
		$s1=$this->tm;
		switch($this->d)
		{
		case 0: //小时
		case 2: //小时超标
			for($i=0;$i<24;$i++)
				$this->xway[$i]=$i;
			break;
		case 1: //日均
		case 3: //日均超标
			$s2=$this->get_days_by_month($s1);
			$i=intval($s2);
			for($j=0;$j<$i;$j++)
				$this->xway[$j]=$j;
			break;
		};
		$_SESSION['fs_g_xway']=$this->xway;
	}//}}}
//{{{public function range_yway()
	public function range_yway()
	{//纵坐标的处理：共11个刻度（含横坐标），标准值为中线（刻度5 0-base），标准值以下按标准值5等分，最大值不超过标准值的2倍时，以上也是五等分
	//超过最大值超过标准值2倍时，标准值以上的刻度按最大值减标准值五等分。
		$i=count($this->gdata);
		$max=array();$std=array();
		if($this->w == 0) //废气
		{
			$std[0]=$this->gdata[0][3]; //so2 std
			$std[1]=$this->gdata[0][5];//nox std
			$std[2]=$this->gdata[0][7];//dust std
			$max[0]=0;$max[1]=0;$max[2]=0;
			for($j=0;$j<$i;$j++)
			{
				if($max[0] > $this->gdata[$j][2])
					$max[0]=$this->gdata[$j][2];	//max so2
				if($max[1] > $this->gdata[$j][4])
					$max[1]=$this->gdata[$j][4];	//max nox
				if($max[2] > $this->gdata[$j][6])
					$max[2]=$this->gdata[$j][6];	//max dust
			}
		}
		else
		{
			$std[0]=$this->gdata[0][3];//cod std
			$std[1]=$this->gdata[0][5];//mhx std
			for($j=0;$j<$i;$j++)
			{
				if($max[0] > $this->gdata[$j][2])
					$max[0]=$this->gdata[$j][2];	//max cod
				if($max[1] > $this->gdata[$j][4])
					$max[1]=$this->gdata[$j][4];	//max nhx
			}
		}
		$this->yway=array();
		array_push($this->yway,$std);
		array_push($this->yway,$max);
		$_SESSION['fs_g_yway']=$this->yway;  
	}//}}}
//{{{public function range_ary()
	public function range_ary()
	{//虽然目前的gdata中包含了所有的数据，但是用于显示的只是其中一小部分，因此先精简一下再传递
		$ay=array();
		$i=count($this->gdata);
		if($this->w == 0) //废气
		{
			for($j=0;$j<$i;$j++)
			{
				$by=array();
				$by[0]=$this->gdata[$j][2];		//get so2
				$by[1]=$this->gdata[$j][4];		//get nox
				$by[2]=$this->gdata[$j][6];		//get dust
				array_push($ay,$by);
			}
		}
		else
		{
			for($j=0;$j<$i;$j++)
			{
				$by=array();
				$by[0]=$this->gdata[$j][2];		//get cod
				$by[1]=$this->gdata[$j][4];		//get nhx
				array_push($ay,$by);
			}
		}
		$_SESSION['fs_g_data']=$ay;
	}//}}}
	public function analysis_post()	//对post传递值的处理
	{}
//{{{protected function get_days_by_month($tmfmt)
	protected function get_days_by_month($tmfmt)
	{//取得指定月份的天数
		$month=substr($tmfmt,5,2);
		$year=substr($tmfmt,0,4);
		return date("d",mktime(0,0,0,$month+1,0,$year));
	}//}}}
}*/
//}}}



///////////////////////////////////////////////////////////
//{{{class bak_data_sright_mx implements main_data 废水及污水厂明晰主界面数据及标准的获取类
/*class bak_data_sright_mx implements main_data
{
	private $db;//目标数据库相关信息
	private $con_std,$con_val; //解析后生成的执行标准查询字符串和项目数据查询字符串
	private $para; //保存post传入的参数
	private $w;
//{{{public function __construct($y)
	public function __construct($y)
	{
		$i=0;
		$this->para=array();
		$this->w=$y;// y=1 废水 y=2 污水厂
		if(!isset($_POST['starttime']))
		{
			if(!isset($_SESSION['INTR_SEND']))
				die("符合当前控制级别和控制区域的站点为空，请指定查询的站点!");
			$this->para[0]=$_SESSION['INTR_SEND'];//uid,这里和实时界面传递的参数不同，不再是aid
			$this->para[1]=0;//控制级别
			$this->para[2]=0;//数据类型
			$this->para[3]=date("Y-m-d",time()); //默认日期
			$ay=array();
			$ay=getdate(time());
			$i=$ay['year'];
		}
		else
		{//这是正常的从post传递
			$this->para[0]=$_POST['sel2p'];
			$this->para[1]=$_POST['sel3p'];
			$this->para[2]=$_POST['sel3'];
			$this->para[3]=$_POST['starttime'];
			$i=intval($_POST['starttime']);			
		}
		$this->get_used_db($i);
	}//}}}
//{{{public function __destruct()
	public function __destruct()
	{
		unset($this->db);unset($this->con_std);unset($this->con_val);
	}//}}}
//{{{public function get_used_db($y)
	public function get_used_db($y)
	{
		global $DB_ADDR_TY,$DB_PORT_TY,$DB_NAME_TY,$DB_PWD_TY;
		global $DB_USER_TY;
		if(!isset($DB_ADDR_TY[$y]))
			die("你所选择的日期".$i."年，没有数据！");
		$this->db=array();
		array_push($this->db,$DB_ADDR_TY[$y]);
		array_push($this->db,$DB_PORT_TY[$y]);
		array_push($this->db,$DB_NAME_TY[$y]);
		array_push($this->db,$DB_USER_TY);
		array_push($this->db,$DB_PWD_TY);
	}//}}}
//{{{public function parse_sql()
	public function parse_sql()
	{//废水
		if($this->w == 1)
		{//目前仅是小时值，没有超标值和日均值。
//			$s1="SELECT date,cod,nhx,ll_sh,ll_jg,ll_lj FROM fs_h_master WHERE uid = %u AND date > date_add(now(),interval -2 month) ORDER BY date";
			$s1="SELECT date,cod,nhx,ll_sh,ll_jg,ll_lj FROM fs_h_master WHERE uid = %u AND date BETWEEN '%s' AND '%s' ORDER BY date";
			$s2=$this->para[3]." 00:00:00";
			$s3=$this->para[3]." 23:59:59";
			$this->con_val=sprintf($s1,$this->para[0],$s2,$s3);
//			$this->con_val=sprintf($s1,$this->para[0]);
			$s1="SELECT iid,std1,std1_area,std2 FROM gb_std WHERE uid = %u AND '%s' BETWEEN sttm AND edtm";
			$s2=$this->para[3]." 00:00:01";
			$this->con_std=sprintf($s1,$this->para[0],$s2);
		}
		else
		{
//			$s1="SELECT date,cod,nhx,ll_sh,ll_jg,ll_lj FROM wsc_h_master WHERE uid = %u AND date > date_add(now(),interval -2 month) ORDER BY date";
			$s1="SELECT date,cod,nhx,ll_sh,ll_jg,ll_lj FROM wsc_h_master WHERE uid = %u AND date BETWEEN '%s' AND '%s' ORDER BY date";
			$s2=$this->para[3]." 00:00:00";
			$s3=$this->para[3]." 23:59:59";
			$this->con_val=sprintf($s1,$this->para[0],$s2,$s3);			
//			$this->con_val=sprintf($s1,$this->para[0]);
			$s1="SELECT iid,std1,std1_area,std2 FROM gb_std WHERE uid = %u AND '%s' BETWEEN sttm AND edtm";
			$s2=$this->para[3]." 00:00:01";
			$this->con_std=sprintf($s1,$this->para[0],$s2);
		}
	}//}}}
//{{{public function get_std()
	public function get_std()
	{
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			die("connect error");
		mysqli_set_charset($mysqli,"utf8");
		if($res=mysqli_query($mysqli,$this->con_std))
		{
			$vay=array();
			while($row=mysqli_fetch_row($res))
				array_push($vay,$row);
			mysqli_free_result($res);
		}
		else
		{
			$s1=mysqli_error($mysqli);
			mysqli_close($mysqli);
			die("mysql query error!<br>".$s1."<br>"."$this->con_std");
		}
		mysqli_close($mysqli);
		$i=count($vay);
		$by=array();
		for($j=0;$j<$i;$j++)
		{
			$ay=$vay[$j];
			if(strlen($ay[2]) == 8)
			{
				$s1=substr($ay[2],0,4); //取得开始的日期
				$b1=intval($s1);
				$s1=substr($ay[2],4,4); //取得结束日期
				$b2=intval($s1);
				$s1=substr($this->para[3],5,5);
				$a1=intval($s1);$a1*=100;
				$a2=intval(substr($s1,3,2));
				$a1+=$a2;				//取得记录的日期
				if(($a1>=$b1) && ($a1<=$b2))
				{
					if(intval($ay[0]) == 316) //cod
						$by[0] = $ay[1];//cod
					else
						$by[1] = $ay[1];//nhx
				}
				else //使用标准2
				{
					if(intval($ay[0]) == 316) //cod
						$by[0] = $ay[3];
					else
						$by[1] = $ay[3];
				}
			}
			else
			{
				if(intval($ay[0]) == 316) //cod
					$by[0] = $ay[1];//cod
				else
					$by[1] = $ay[1];//nhx
			}
		}
		$cy=$this->get_unit();
		$i=count($cy);
		$ey=array();
		for($j=0;$j<$i;$j++)
		{
			$y=$cy[$j];
			$x=array();
			$x[0]=$j;	//序号
			$x[1]=$y[0];//date
			$x[2]=$y[1];//cod
			$x[3]=$by[0];//cod std
			$x[4]=$y[2];//nhx
			$x[5]=$by[1];//nhx std
			$x[6]=$y[3];//ll_sh
			$x[7]=$y[4];//ll_jg
			$x[8]=$y[5];//ll_lj
			array_push($ey,$x);
		}
		return $ey;
	}//}}}
//{{{public function get_unit()
	public function get_unit()
	{
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			die("connect error");
		mysqli_set_charset($mysqli,"utf8");
		if($res=mysqli_query($mysqli,$this->con_val))
		{
			$vay=array();
			while($row=mysqli_fetch_row($res))
				array_push($vay,$row);
			mysqli_free_result($res);
		}
		else
		{
			$s1=mysqli_error($mysqli);
			mysqli_close($mysqli);
//			var_dump($this->db);
//			print_r($this->db);
			die("mysql query error!<br>".$s1."<br>"."$this->con_val");
		}
		mysqli_close($mysqli);
		return $vay;
	}//}}}
}*/
//}}}


?>
