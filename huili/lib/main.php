<?php
/**
 @package		huili manager
 @version		0.0.0.1
 @author		田勇 Alisa tybitsfox <tybitsfox@163.com>
 @license		GPLv2

本文件是登录类的定义和实现文件

 **/

?>
<?php
if(session_status() != PHP_SESSION_ACTIVE)
	session_start();
if(!defined("FULL_PATH"))
	define("FULL_PATH",substr(dirname(__FILE__),0,strlen(dirname(__FILE__))-strlen(strstr(dirname(__FILE__),"huili")))."huili".DIRECTORY_SEPARATOR);
if(!defined("WORK_PLACE"))
	require_once(constant("FULL_PATH")."config/glob_new.php");
require_once(constant("FULL_PATH")."lib/interface.php");

//{{{class login implements inter_sign	
class loginn implements inter_sign
{
	private $usr,$pwd,$db,$conn;
//{{{public function __construct($u,$p)	
	public function __construct($u,$p)
	{
		$this->usr=$u;$this->pwd=$p;
		if(!isset($_SESSION['CURRENT']))
			$this->get_cur_year();
	}//}}}
//{{{public function __destruct()
	public function __destruct()
	{
		unset($this->usr);unset($this->pwd);unset($this->db);unset($this->conn);
	}//}}}
//{{{private function get_cur_year()
	private function get_cur_year()
	{
		$ay=array();
		$ay=getdate(time());
		$_SESSION['CURRENT']=$ay['year'];
	}//}}}
//{{{public function check_it($a,$b)
	public function check_it($a,$b)
	{
		global $DB_ADDR_TY,$DB_PORT_TY,$DB_NAME_TY,$DB_USER_TY,$DB_PWD_TY;
		$i=intval($_SESSION['CURRENT']);
		if(!isset($DB_ADDR_TY[$i]))
			return 4; //选择的年份没有数据
		$this->db=array();
		array_push($this->db,$DB_ADDR_TY[$i]);
		array_push($this->db,$DB_PORT_TY[$i]);
		array_push($this->db,$DB_NAME_TY[$i]);
		array_push($this->db,$DB_USER_TY[$i]);
		array_push($this->db,$DB_PWD_TY[$i]);
		$i=0;
		if((strlen($a) < 4 || strlen($a) > 31) || (strlen($b) < 4 || strlen($b) > 31))
			return 2; //邮箱名或密码长度错误
		if(strchr($a,'@') == FALSE || strchr($a,'.') == FALSE )
			return 3; //邮箱名格式错误
		if((strchr($a,'(') != FALSE ) || (strchr($b,'(') != FALSE))
			$i=1; //邮箱名或密码含有括号或者引号字符。
		if((strchr($a,')') != FALSE ) || (strchr($b,')') != FALSE))
			$i=1;
		if((strchr($a,'\'') != FALSE ) || (strchr($b,'\'') != FALSE))
			$i=1;
		if((strchr($a,'"') != FALSE ) || (strchr($b,'"') != FALSE))
			$i=1;
		return $i;//返回0为正确
	}//}}}
//{{{public function signin()
	public function signin()
	{
		$i=$this->check_it($this->usr,$this->pwd);
		if($i != 0)
			return $i;
		$ay=array();
		$this->conn=sprintf("SELECT * FROM auth WHERE user = '%s'",$this->usr);
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			return 5; //connect error
		mysqli_set_charset($mysqli,"utf8");
		$res=mysqli_query($mysqli,$this->conn);
		while($row=mysqli_fetch_row($res))
			array_push($ay,$row);
		mysqli_free_result($res);
		mysqli_close($mysqli);
		if(count($ay) != 1)
			return 6; //wrong name
		$str=base64_decode(base64_decode($ay[2]));
		if($str != $this->pwd)
			return 7;//wrong pwd
		return 0;
	}//}}}
//{{{public function signup()
	public function signup()
	{
		$i=$this->check_it($this->usr,$this->pwd);
		if($i != 0)
			return $i;
		$ay=array();
		$this->conn="SELECT uid FROM auth ORDER BY uid DESC LIMIT 1";
		$mysqli=mysql_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			return 5; //connect error
		$res=mysqli_query($mysqli,$this->conn);
		while($row=mysqli_fetch_row($res))
			array_push($ay,$row);
		mysqli_free_result($res);
		mysqli_close($mysqli);
		if(count($ay) != 1)
			$uid=1;
		else
			$uid=$ay[0];
		$str1=base64_encode(base64_encode($this->pwd));
		$str2=7;
		$this->conn=fprintf("INSERT INTO auth(uid,user,pwd,priv) VALUES(%d,'%s','%s',%d)",$uid,$this->usr,$this->pwd,$str2);
		$mysqli=mysql_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			return 5; //connect error
		$res=mysqli_query($mysqli,$this->conn);
		mysqli_close($mysqli);
		if($res == TRUE)
			return 0;
		else
			return 8;//regist error
	}//}}}
//{{{public function resets()
	public function resets()
	{

	}//}}}
//{{{public function err_msg($errno)
	public function err_msg($errno)
	{
		switch($errno)
		{
		case 0://success
			//echo "return success!";
			break;
		case 1://用户名和密码不能包括引号或者括号
			echo "<div class='alert alert-danger' role='alert'><strong>错误</strong> 不能包含括号或引号字符</div>";
			break;
		case 2://邮箱或密码长度错误
			echo "<div class='alert alert-danger' role='alert'><strong>错误</strong> 邮箱或密码长度错误</div>";
			break;
		case 3://邮箱名格式错误
			echo "<div class='alert alert-danger' role='alert'><strong>错误</strong>邮箱名格式错误</div>";
			break;
		case 4://当前年份没有数据
			echo "<div class='alert alert-danger' role='alert'><strong>错误</strong>当前年份没有数据</div>";
			break;
		case 5://数据库连接错误
			echo "<div class='alert alert-danger' role='alert'><strong>错误</strong>数据库连接失败</div>";
			break;
		case 6://帐号或密码错误
		case 7://密码
			echo "<div class='alert alert-danger' role='alert'><strong>错误</strong>帐号或密码错误</div>";
			break;
		case 8://注册失败
			echo "<div class='alert alert-danger' role='alert'><strong>错误</strong>注册失败</div>";
			break;
		default:
			echo "<div class='alert alert-danger' role='alert'><strong>错误</strong>注册失败</div>";
			break;
		}
	}//}}}
}//}}}
//{{{
//echo "<input id='email' type='test' name='email' value='' placeholder='邮箱' required autocomplete='off' pattern='^[a-zA-Z0-9_-^.]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$' title='邮箱格式：必须有@.等字符' />";
//}}}
?>
