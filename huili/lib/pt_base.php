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
	public function __construct()
	{
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
//{{{public function get_point($u) 
/*in:	array;
 */	
	public function get_point($u)
	{

	}//}}}

}//}}}


?>
