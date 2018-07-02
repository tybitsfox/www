<?php
if(session_status() != PHP_SESSION_ACTIVE)
	session_start();
if(!defined("FULL_PATH"))
	define("FULL_PATH",substr(dirname(__FILE__),0,strlen(dirname(__FILE__))-strlen(strstr(dirname(__FILE__),"huili")))."huili".DIRECTORY_SEPARATOR);
if(!defined("WORK_PLACE"))
	require_once(constant("FULL_PATH")."config/glob_new.php");

//{{{class base_login   BASE CLASS
class base_login
{
	public $db,$mysqli,$err_no;
//{{{public function __construct()	
	public function __construct()
	{
		if(!isset($_SESSION['CURRENT']))
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
		$_SESSION['CURRENT']=$ay['year'];
	}//}}}
//{{{public function check_it()
	public function check_it()
	{
		global $DB_ADDR_TY,$DB_PORT_TY,$DB_NAME_TY,$DB_USER_TY,$DB_PWD_TY;
		$i=intval($_SESSION['CURRENT']);
		if(!isset($DB_ADDR_TY[$i]))
		{$this->err_no=4;return;} //选择的年份没有数据
		$this->db=array();
		array_push($this->db,$DB_ADDR_TY[$i]);
		array_push($this->db,$DB_PORT_TY[$i]);
		array_push($this->db,$DB_NAME_TY[$i]);
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
		else
			$this->err_no=0;
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
		case 5:
			return "认证失败！该帐户已通过认证";
		case 6:
			return "您输入的字段长度过长";
		case 7:
		case 8:
			return "用户名或密码错误";
		case 9:
			return "该邮箱已被注册";
		case 10:
			return "请重新登录后在执行相关操作";
		case 11:
			return "更新记录失败";
		case 12:
			return "删除记录失败";
		case 13:
			return "您要添加的模块已经存在";

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
//{{{class login extends base_login		signin and signup
class login extends base_login
{
//{{{public function signin($u,$p) 用户登录
	public function signin($u,$p)
	{
		$this->init_db();
		if($this->err_no)
			return;
		$_SESSION['CURR_USR']=array();
		$ay=array();
		$conn=sprintf("SELECT * FROM auth WHERE email = '%s'",$u);
		$res=mysqli_query($this->mysqli,$conn);
		while($row=mysqli_fetch_row($res))
			array_push($ay,$row);
		mysqli_free_result($res);
		mysqli_close($this->mysqli);
		if(count($ay) != 1)
		{$this->err_no=7;return;} //wrong name
		$str=md5($p);
		if($str != $ay[0][3])
		{$this->err_no=8;return;} //pwd error
		$_SESSION['CURR_USR']=array_merge($_SESSION['CURR_USR'],$ay[0]);
		unset($ay);
	}//}}}
//{{{public function signup($u,$p) 用户注册
	public function signup($u,$p)
	{
		$this->init_db();
		if($this->err_no)
			return;
		$_SESSION['CURR_USR']=array();
		$ay=array();
		$conn=sprintf("SELECT email FROM auth WHERE email = '%s'",$u);
		$res=mysqli_query($this->mysqli,$conn);
		while($row=mysqli_fetch_row($res))
			array_push($ay,$row);
		mysqli_free_result($res);
		mysqli_close($this->mysqli);
		if(count($ay) !=0 )
		{$this->err_no=9;return;}
		$ay=array();
		$this->init_db();
		if($this->err_no)
			return;
		$conn="SELECT uid FROM auth ORDER BY uid DESC LIMIT 1";
		$res=mysqli_query($this->mysqli,$conn);
		while($row=mysqli_fetch_row($res))
			array_push($ay,$row);
		mysqli_free_result($res);
		mysqli_close($this->mysqli);
		if(count($ay) == 0)
			$uid=100000;
		else
			$uid=intval($ay[0][0])+1;
		$str1=md5($p);//pwd
		$str2=7;//1,3,7,15,31,63,  priv
		$str3=substr($u,0,strpos($u,'@'));//uname
		$str4=date("Y-m-d H:i:s",time());
		$ay=array($uid,$u,$str3,$str1,$str2,1,0,'',0,0,$str4,$str4);
		$conn=sprintf("INSERT INTO auth(uid,email,uname,pwd,priv,lvl,sex,expr,coin,treasure,lastlogin,signup) VALUES(%d,'%s','%s','%s',%d,1,0,0,0,0,now(),now())",$uid,$u,$str3,$str1,$str2);
		$this->init_db();
		if($this->err_no)
			return;
		$res=mysqli_query($this->mysqli,$conn);
		mysqli_close($this->mysqli);
		if($res == TRUE)
			$_SESSION['CURR_USR']=array_merge($_SESSION['CURR_USR'],$ay);
		else
		{$this->err_no=3;return;}//regist error
	}//}}}
//{{{public function edit($ay) 记录编辑 auth表只允许编辑：邮箱、密码、昵称！so～
	public function edit($ay)
	{
		if((!isset($_SESSION['CURR_USR'])) || (count($_SESSION['CURR_USR']) != 12))
		{$this->err_no=10;return;}
		$this->init_db();
		if($this->err_no)
			return;
		if(count($ay) != 2)//need ay's format: ay[0]=action code,ay[1] update for
		{$this->err_no=2;return;}
		switch($ay[0])
		{
		case 0://uname
			$st1="UPDATE auth SET uname = '".$ay[1]."' WHERE uid = ".$_SESSION['CURR_USR'][0];
			break;
		case 1://password
			$st1="UPDATE auth SET pwd = '".md5($ay[1])."' WHERE uid = ".$_SESSION['CURR_USR'][0];
			break;
		case 2://email
			$st1="UPDATE auth SET email = '".$ay[1]."' WHERE uid = ".$_SESSION['CURR_USR'][0];
			break;
		default:
			$this->err_no=2;
			return;
		}
		$res=mysqli_query($this->mysqli,$st1);
		mysqli_close($this->mysqli);
		if($res == TRUE)
			return;//success
		else
			$this->err_no=11;//edit failure
	}//}}}
//{{{public function drop($u)	删除记录,只按uid删除
	public function drop($u)
	{
		$this->init_db();
		if($this->err_no)
			return;
		$conn="DELETE FROM auth WHERE uid = ".$u;
		$res=mysqli_query($this->mysqli,$conn);
		mysqli_close($this->mysqli);
		if($res == TRUE)
			return;
		else
			$this->err_no=12;
	}//}}}
}//}}}
//{{{class tb_choose extends signed_db
class tb_choose extends signed_db
{
//{{{public function get_db($u)
	public function get_db($u)
	{
		$ay=array();
		$this->init_db();
		if($this->err_no)
			return $ay;
		$conn=sprintf("SELECT * FROM  choose WHERE uid = %d",$u);
		$res=mysqli_query($this->mysqli,$conn);
		while($row=mysqli_fetch_row($res))
			array_push($ay,$row);
		mysqli_free_result($res);
		mysqli_close($this->mysqli);
		return $ay; 
	}//}}}
//{{{public function add_db($a)
	public function add_db($a)
	{
		$this->init_db();
		if($this->err_no)
			return;
		$conn=sprintf("SELECT * FROM choose WHERE uid = %d AND mid = %d",$a[0],$a[1]);
		$ay=array();
		$res=mysqli_query($this->mysqli,$conn);
		while($row=mysqli_fetch_row($res))
			array_push($ay,$row);
		mysqli_free_result($res);
		mysqli_close($this->mysqli);
		if(count($ay) != 0)
		{$this->err_no=13;return;}
		$conn=sprintf("INSERT INTO choose(uid,mid,cid,mname,mlink,mclass,micon) VALUES(%d,%d,'%s','%s','%s','%s','%s')",$a[0],$a[1],$a[2],$a[3],$a[4],$a[5],$a[6]);
		$res=mysqli_query($this->mysqli,$conn);
		mysqli_close($this->mysqli);
		if($res == TRUE)
			return;
		else
			$this->err_no=3;
	}//}}}
}//}}}
//{{{class tb_fixedmod extends signed_db
class tb_fixedmod extends signed_db
{
//{{{public function get_db($m)	if $m is null then get all
	public function get_db($m)
	{
		$ay=array();
		$i=$this->check_it();
		if($i != 0)
			return $ay;
		if(is_null($m))
			$conn="SELECT * FROM fixedmod";
		else
			$conn=sprintf("SELECT * FROM fixedmod WHERE mid = %d",intval($m));
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			return $ay;
		mysqli_set_charset($mysqli,"utf8");
		$res=mysqli_query($mysqli,$conn);
		while($row=mysqli_fetch_row($res))
			array_push($ay,$row);
		mysqli_free_result($res);
		mysqli_close($mysqli);
		return $ay;
	}//}}}
//{{{public function add_db($a)
	public function add_db($a)
	{
		$i=$this->check_it();
		if($i != 0)
			return $i;
		if( is_null($a) || (count($a) != 4))
			return 1;
		$conn=sprintf("SELECT mid from fixedmod ORDER BY mid DESC");
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			return 2;
		$ay=array();
		mysqli_set_charset($mysqli,"utf8");
		$res=mysqli_query($mysqli,$conn);
		while($row=mysqli_fetch_row($res))
			array_push($ay,$row);
		mysqli_free_result($res);
		mysqli_close($mysqli);
		$i=intval($ay[0][0])+1;
		if($i > 268435456) //2^28
			return 3;
		$conn=sprintf("INSERT INTO fixedmod(mid,mname,mlink,micon) VALUES(%d,'%s','%s','%s')",$a[0],$a[1],$a[2],$a[3]);
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			return 2;
		mysqli_set_charset($mysqli,"utf8");
		$res=mysqli_query($mysqli,$conn);
		mysqli_close($mysqli);
		if($res == TRUE)
			return 0;
		else
			return 6;
	}//}}}
}//}}}


?>
