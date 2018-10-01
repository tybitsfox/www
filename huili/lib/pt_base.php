<?php
if(session_status() != PHP_SESSION_ACTIVE)
	session_start();
if(!defined("FULL_PATH"))
	define("FULL_PATH",substr(dirname(__FILE__),0,strlen(dirname(__FILE__))-strlen(strstr(dirname(__FILE__),"huili")))."huili".DIRECTORY_SEPARATOR);
if(!defined("WORK_PLACE"))
	require_once(constant("FULL_PATH")."config/glob_new.php");
require_once(constant("FULL_PATH")."template/pinyin.php");
?>
<?php
//{{{class pt_base  BASE CLASS
class pt_base
{
	public $db,$mysqli,$err_no;
//{{{public function __construct()
	public function __construct($t)
	{
		if(($t != ""))
		{
			$i=intval($t);
			if(($i < 2030 ) && ($i > 2015))
				$_SESSION['PTCURRENT']=$i;
		}
		if(!isset($_SESSION['PTCURRENT']))
			$this->get_cur_year();
		$this->err_no=$this->check_it();
	}//}}}
//{{{public function __destruct()
	public function __destruct()
	{unset($this->db);}//}}}
//{{{public function get_cur_year()
	public function get_cur_year()
	{
		$ay=array();
		$ay=getdate(time());
		$_SESSION['PTCURRENT']=$ay['year'];
	}//}}}
//{{{public function check_it()
	public function check_it()
	{
		global $DB_ADDR_TY,$DB_PORT_TY,$PT_NAME_TY,$DB_USER_TY,$DB_PWD_TY;
		$i=intval($_SESSION['CURRENT']);
		if(!isset($DB_ADDR_TY[$i]))
		{$this->err_no=4;return;} //选择的年份没有数据
		$this->db=array();
		array_push($this->db,$DB_ADDR_TY[$i]);
		array_push($this->db,$DB_PORT_TY[$i]);
		array_push($this->db,$PT_NAME_TY[$i]);
		array_push($this->db,$DB_USER_TY[$i]);
		array_push($this->db,$DB_PWD_TY[$i]);
		$this->err_no=0;//返回0为正确
	}//}}}
//{{{public function get_sqli()
	public function get_sqli()
	{
		if($this->err_no)
			return;
		$this->mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
		{
			$this->err_no=1;
			return; //connect error
		}
		mysqli_set_charset($this->mysqli,"utf8");
		return;
	}//}}}
//{{{public function init_db()  重置错误代码，重新调用相关函数，完成初始化
	public function init_db()
	{
		if($this->err_no == 4)
			$this->check_it();
		if($this->err_no == 0)
			$this->get_sqli();
	}//}}}
//{{{public function err_msg()
	public function err_msg()
	{
		switch($this->err_no)
		{
		case 1:
			return "连接数据库失败";
		case 2:
			return "参数错误！";
		case 3:
			return "添加记录失败";
		case 4:
			return "您选择的年份没有记录";
		case 6:
			return "您输入的字段长度过长";
		case 7:
		case 8:
			return "用户名或密码错误";
		case 10:
			return "请重新登录后在执行相关操作";
		case 11:
			return "更新记录失败";
		case 12:
			return "删除记录失败";
		case 16:
			return "查找记录失败";
		default:
			return "未知错误！";
		}
	}//}}}
//{{{public function set_err($n)	//设置错误代码
	public function set_err($n)
	{
		$this->err_no=$n;
	}//}}}
}//}}}
//{{{class zl extends pt_base 点位总览界面数据操作类
class zl extends pt_base
{
//{{{public function get_station($u) 
/*in:	array(0,0,0,0);
  array[0]:	操作代码；其中：
  	=0	取得全部点位记录
	=1	按区划取得全部记录
	=2	按区划和类型取得记录
	=3	按类型取得记录
	=4	按名称模糊查询
array[1]:	区划代码
array[2]:	类型代码
array[3]:	名称关键字
out:	array;
 */	
	public function get_station($u)
	{
		$ay=array();
		if(count($u) != 4)
		{$this->err_no=2;return $ay;}
		$this->init_db();
		if($this->err_no)
			return $ay;
		switch($u[0])
		{
//{{{switch
		case 0://取得全部点位记录 --这个应该不常用
			$conn="SELECT a.aid,a.sname,a.sid,a.lng,a.lat,b.link from station as a LEFT JOIN pt_link as b ON a.sid=b.sid WHERE b.lid = 0 order by a.sid";
			break;
		case 1://按区划取得全部记录
			$i=intval($u[1]);
			if($i % 100) //按地市取得
			{
				$s1="SELECT a.aid,a.sname,a.sid,a.lng,a.lat,b.link from station as a LEFT JOIN pt_link as b ON a.sid=b.sid WHERE a.aid > %u AND a.aid < %u AND b.lid = 0 order by a.sid";
				$conn=sprintf($s1,$i,$i+99);
			}
			else
			{
				$s1="SELECT a.aid,a.sname,a.sid,a.lng,a.lat,b.link from station as a LEFT JOIN pt_link as b ON a.sid=b.sid  WHERE a.aid = %u AND b.lid = 0 order by a.sid";
				$conn=sprintf($s1,$i);
			}
			break;
		case 2://按区划和类型
			$i=intval($u[1]);
			$j=intval($u[2]);
			if($j == 0) //基础点位
				$s2=" AND a.stype = 0";
			elseif($j == 1) //质控点位
				$s2=" AND (a.stype & 1) > 0";
			elseif($j == 2) //背景点位
				$s2=" AND (a.stype & 2) > 0";
			elseif($j == 3) //质控和背景点位
				$s2=" AND a.stype = 3";
			else//全部类型
				$s2="";
			if($i % 100) //按地市取得
			{
				$s1="SELECT a.aid,a.sname,a.sid,a.lng,a.lat,b.link from station as a LEFT JOIN pt_link as b ON a.sid=b.sid WHERE a.aid > %u AND a.aid < %u %s AND b.lid = 0 order by a.sid";
				$conn=sprintf($s1,$i,$i+99,$s2);
			}
			else
			{
				$s1="SELECT a.aid,a.sname,a.sid,a.lng,a.lat,b.link from station as a LEFT JOIN pt_link as b ON a.sid=b.sid  WHERE a.aid = %u %s AND b.lid = 0 order by a.sid";
				$conn=sprintf($s1,$i,$s2);
			}
			break;
		case 3://按类型
			$j=intval($u[2]);
			if($j == 0) //基础点位
				$conn="SELECT a.aid,a.sname,a.sid,a.lng,a.lat,b.link from station as a LEFT JOIN pt_link as b ON a.sid=b.sid  WHERE a.stype = 0 AND b.lid = 0 order by a.sid";
			elseif($j == 1)//质控点位
				$conn="SELECT a.aid,a.sname,a.sid,a.lng,a.lat,b.link from station as a LEFT JOIN pt_link as b ON a.sid=b.sid  WHERE (a.stype & 1) > 0 AND b.lid = 0 order by a.sid";
			elseif($j == 2)//背景点位
				$conn="SELECT a.aid,a.sname,a.sid,a.lng,a.lat,b.link from station as a LEFT JOIN pt_link as b ON a.sid=b.sid  WHERE (a.stype & 2) > 0 AND b.lid = 0 order by a.sid";
			elseif($j == 3)//质控和背景点位
				$conn="SELECT a.aid,a.sname,a.sid,a.lng,a.lat,b.link from station as a LEFT JOIN pt_link as b ON a.sid=b.sid  WHERE a.stype = 3 AND b.lid = 0 order by a.sid";
			else //全部点位
				$conn="SELECT a.aid,a.sname,a.sid,a.lng,a.lat,b.link from station as a LEFT JOIN pt_link as b ON a.sid=b.sid  WHERE b.lid = 0 order by a.sid";
			break;
		case 4://按名称关键字
				$conn="SELECT a.aid,a.sname,a.sid,a.lng,a.lat,b.link from station as a LEFT JOIN pt_link as b ON a.sid=b.sid  WHERE LOCATE('".$u[3]."',a.sname) > 0 AND b.lid = 0 order by a.sid";
			break; //}}}
		};
		$res=mysqli_query($this->mysqli,$conn);
		while($row=mysqli_fetch_row($res))
			array_push($ay,$row);
		mysqli_free_result($res);
		mysqli_close($this->mysqli);
		return $ay;
	}//}}}
//{{{ public function get_act_area() 取得有效的区划信息
/*in: none
out:	array[0] 区划代码
	 	array[1] 区划名称
 */
	public function get_act_area()
	{
		$ay=array();
		$this->init_db();
		if($this->err_no)
			return $ay;
		$conn="SELECT aid,aname FROM area_info WHERE bused = 1";
		$res=mysqli_query($this->mysqli,$conn);
		while($row=mysqli_fetch_row($res))
			array_push($ay,$row);
		mysqli_free_result($res);
		mysqli_close($this->mysqli);
		return $ay;
	}//}}}

}//}}}


?>
