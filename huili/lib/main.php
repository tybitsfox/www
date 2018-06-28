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
//{{{private function check_it()
	private function check_it()
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
		return 0;//返回0为正确
	}//}}}
//{{{public function signin()
	public function signin()
	{
		$_SESSION['CURR_USR']=array();
		$i=$this->check_it();
		if($i != 0)
			return $i;
		$ay=array();
		$this->conn=sprintf("SELECT * FROM auth WHERE email = '%s'",$this->usr);
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
		$str=md5($this->pwd);
		if($str != $ay[0][3])
			return 7;
		$_SESSION['CURR_USR']=array_merge($_SESSION['CURR_USR'],$ay[0]);
		unset($ay);
		return 0;
	}//}}}
//{{{public function signup()
	public function signup()
	{
		$_SESSION['CURR_USR']=array();
		$i=$this->check_it($this->usr,$this->pwd);
		if($i != 0)
			return $i;
		$ay=array();
		$this->conn=sprintf("SELECT email FROM auth WHERE email = '%s'",$this->usr);
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			return 5;
		$res=mysqli_query($mysqli,$this->conn);
		while($row=mysqli_fetch_row($res))
			array_push($ay,$row);
		mysqli_free_result($res);
		mysqli_close($mysqli);
		if(count($ay) !=0 )
			return 10;
		$ay=array();
		$this->conn="SELECT uid FROM auth ORDER BY uid DESC LIMIT 1";
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			return 5; //connect error
		$res=mysqli_query($mysqli,$this->conn);
		while($row=mysqli_fetch_row($res))
			array_push($ay,$row);
		mysqli_free_result($res);
		mysqli_close($mysqli);
		if(count($ay) == 0)
			$uid=100000;
		else
			$uid=intval($ay[0][0])+1;
		$str1=md5($this->pwd);//pwd
		$str2=7;//1,3,7,15,31,63,  priv
		$str3=substr($this->usr,0,strpos($this->usr,'@'));//uname
		$str4=date("Y-m-d H:i:s",time());
		$ay=array($uid,$this->usr,$str3,$str1,$str2,1,0,'',0,0,$str4,$str4);
		$this->conn=sprintf("INSERT INTO auth(uid,email,uname,pwd,priv,lvl,sex,expr,coin,treasure,lastlogin,signup) VALUES(%d,'%s','%s','%s',%d,1,0,0,0,0,now(),now())",$uid,$this->usr,$str3,$str1,$str2);
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			return 5; //connect error
		$res=mysqli_query($mysqli,$this->conn);
		mysqli_close($mysqli);
		if($res == TRUE)
		{
			$_SESSION['CURR_USR']=array_merge($_SESSION['CURR_USR'],$ay);
			return 0;
		}
		else
			return 8;//regist error
	}//}}}
//{{{public function resets($p)
	public function resets($p)
	{
		$i=$this->check_it();
		if($i != 0)
			return $i;
		$cona=sprintf("UPDATE auth SET pwd = '%s' WHERE email = '%s'",md5($p),$this->usr);
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			return 5; //connect error
		mysqli_set_charset($mysqli,"utf8");
		$res=mysqli_query($mysqli,$cona);
		mysqli_close($mysqli);
		if($res != TRUE)
			return 9;
		echo "<div class='alert alert-danger' role='alert'><strong>密码重置完成</strong> 请重新登录</div>";
		return 0;
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
		case 9://密码重置失败
			echo "<div class='alert alert-danger' role='alert'><strong>错误</strong>密码重置失败</div>";
			break;
		case 10://用户已经注册
			echo "<div class='alert alert-danger' role='alert'><strong>错误</strong>该邮箱已注册</div>";
			break;
		default:
			echo "<div class='alert alert-danger' role='alert'><strong>错误</strong>注册失败</div>";
			break;
		}
	}//}}}

}//}}}

//{{{class signed_db	BASE CLASS
class signed_db
{
	public $mysqli,$db,$err_no;
//{{{public function __construct()
	public function __construct()
	{
		if(!isset($_SESSION['CURRENT']))
			$this->get_cur_year();
		$this->err_no=$this->check_it();
	}//}}}
//{{{public function __destruct()
	public function __destruct()
	{}//}}}
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
			return 4; //选择的年份没有数据
		$this->db=array();
		array_push($this->db,$DB_ADDR_TY[$i]);
		array_push($this->db,$DB_PORT_TY[$i]);
		array_push($this->db,$DB_NAME_TY[$i]);
		array_push($this->db,$DB_USER_TY[$i]);
		array_push($this->db,$DB_PWD_TY[$i]);
		return 0;//返回0为正确
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
}//}}}
//{{{class tb_choose extends signed_db
class tb_choose extends signed_db
{
//{{{public function get_db($u)
	public function get_db($u)
	{
		$ay=array();
		$i=$this->check_it();
		if($i != 0)
			return $ay;
		$by=array();
		$by=$this->db;
		$conn=sprintf("SELECT * FROM  choose WHERE uid = %d",$u);
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
		if($i != 0 )
			return $i;
		//$db=array();
		//$db=parent::$db;
		$conn=sprintf("SELECT * FROM choose WHERE uid = '%d' AND mid = '%d'",$a[0],$a[1]);
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			return 1;
		$ay=array();
		mysqli_set_charset($mysqli,"utf8");
		$res=mysqli_query($mysqli,$conn);
		while($row=mysqli_fetch_row($res))
			array_push($ay,$row);
		mysqli_free_result($res);
		mysqli_close($mysqli);
		if(count($ay) != 0)
			return 2;
		$conn=sprintf("INSERT INTO choose(uid,mid,cid,mname,mlink,mclass,micon) VALUES(%d,%d,'%s','%s','%s','%s','%s')",$a[0],$a[1],$a[2],$a[3],$a[4],$a[5],$a[6]);
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			return 1;
		mysqli_set_charset($mysqli,"utf8");
		$res=mysqli_query($mysqli,$conn);
		mysqli_close($mysqli);
		if($res == TRUE)
			return 0;
		else
			return 3;
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
//{{{class used_sign extends signed_db
//登录用户的信息:uid(0),email(1),uname(2),pwd(3),priv(4),lvl(5),sex(6),expr(7),coin(8),treasure(9),signup(10),lastlogin(11)
//security:uid(0),lastlog(1),signed(2),lgip(3),lgsys(4),lgbrow(5),trust(6),perm(7)
class used_sign extends signed_db
{
//{{{private function get_secu() 由当前会话信息生成的将要保存的信息
	private function get_secu()
	{
		$_SESSION['USR_AGENT']=array();
		$trust=0; //设备不可信
		$perm=0;
		if(isset($_COOKIE['huili_lgpwd']))
		{
			$trust=1;
			$perm=7; //1: read ,2:write,3:local
		}
		$ds=array();
		$ds=explode(" ",$_SESSION['CURR_USR'][11]);
		$dn=date("Y-m-d",time());
		if($dn > $ds[0])
			$sig=1; //没有签到
		else
			$sig=0; //已经签到
		$ay=array();
		$ay=$this->get_agent();
		$by=array($_SESSION['CURR_USR'][0],time(),$sig,$ay[2],$ay[0],$ay[1],$trust,$perm);
		$_SESSION['USR_AGENT']=$by;
		return $by;
	}//}}}
//{{{private function get_agent()
	private function get_agent()
	{
		$ay=array();
		$sname="";
		$s=$_SERVER['HTTP_USER_AGENT'];
		if(preg_match("/win/i",$s))
		{//windows
			if(preg_match("/nt 6.1/i",$s))
				$sname="windows 7";
			elseif(preg_match("/nt 10.0/i",$s))
				$sname="windows 10";
			elseif(preg_match("/nt 5.1/i",$s))
				$sname="windows xp";
			elseif(preg_match("/nt 6.2/i",$s))
				$sname="windows 8";
			elseif(preg_match("/nt 6.3/i",$s))
				$sname="windows 2012";
			else
				$sname="老版本windows系统";
		}
		elseif(preg_match("/android/i",$s))
			$sname="Android系统";
		elseif(preg_match("/linux/i",$s))
			$sname="GNU/linux操作系统";
		elseif(preg_match("/ios/i",$s))
			$sname="IOS系统";
		elseif(preg_match("/mac/i",$s))
			$sname="Mac操作系统";
		elseif(preg_match("/unix/i",$s))
			$sname="Unix操作系统";
		elseif(preg_match("/bsd/i",$s))
			$sname="Free/Net/OpenBSD操作系统";
		else
			$sname="其他操作系统";
		$sbrower="未知浏览器";
		if(preg_match("/msie/i",$s))
			$sbrower="MSIE";
		elseif(preg_match("/firefox/i",$s))
			$sbrower="Firefox";
		elseif(preg_match("/chrome/i",$s))
			$sbrower="Chrome";
		elseif(preg_match("/safari/i"))
			$sbrower="Safari";
		elseif(preg_match("/opera/i"))
			$sbrower="Opera";
		else
			$sbrower="Other";
		$ay[0]=$sname;$ay[1]=$sbrower;
		$s=$_SERVER['REMOTE_ADDR'];
		if(preg_match("/:/",$s))
			$ay[2]="localhost";
		else
			$ay[2]=$s;
		return $ay;
	}//}}}
//{{{public function update_auth() 更新auth表的函数
	public function update_auth()
	{
		$i=$this->check_it();
		if($i != 0)
			return $i;
		$a=array();
		$a=$this->get_secu();
		if($a[2] == 0)//添加防止刷金币的代码
			return 0;
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			return 2; //connect error
		mysqli_set_charset($mysqli,"utf8");
		$exp=intval($_SESSION['CURR_USR'][7])+1;
		$i=floor($exp/100)+1;
		if($i > intval($_SESSION['CURR_USR'][5]))
			$conn="UPDATE auth set lvl = ".$i.",expr = expr+1,coin = coin+1,lastlogin = '".date("Y-m-d H:i:s",$_SESSION['USR_AGENT'][1])."' WHERE uid = ".$_SESSION['CURR_USR'][0];
		else
			$conn="UPDATE auth set expr = expr+1,coin = coin+1,lastlogin = '".date("Y-m-d H:i:s",$_SESSION['USR_AGENT'][1])."' WHERE uid = ".$_SESSION['CURR_USR'][0];
//		$conn="UPDATE auth set lastlogin = now(),coin = coin+1 WHERE uid = ".$_SESSION['CURR_USR'][0];
		$res=mysqli_query($mysqli,$conn);
		mysqli_close($mysqli);
		if($res == TRUE)
		{
			if($i > intval($_SESSION['CURR_USR'][5]))
				$_SESSION['CURR_USR'][5]=$i;
			$_SESSION['curr_USR'][7]=$exp;
			return 0;//success
		}
		else
			return 1;//update error
	}//}}}
//{{{public function add_secu($a) 添加登录信息表（security）记录
	public function add_secu()
	{
		$i=$this->check_it();
		if($i != 0)
			return $i;
		$a=array();
		$a=$this->get_secu();
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			return 2; //connect error
		mysqli_set_charset($mysqli,"utf8");
		$conn=sprintf("INSERT INTO security(uid,lastlog,signed,lgip,lgsys,lgbrow,trust,perm) VALUES(%d,now(),%d,'%s','%s','%s',%d,%d)",$a[0],$a[2],$a[3],$a[4],$a[5],$a[6],$a[7]);
		$res=mysqli_query($mysqli,$conn);
		mysqli_close($mysqli);
		if($res == TRUE)
			return 0;
		else
			return 5;//保存用户登录信息失败！
	}//}}}
//{{{public function get_secu_from_db() 从数据库中取得的用于在安全页面显示的4条记录函数
	public function get_secu_from_db()
	{
		$ay=array();
		$i=$this->check_it();
		if($i != 0)
			return $ay;
		$mysqli=mysqli_connect($this->db[0],$this->db[3],$this->db[4],$this->db[2],$this->db[1]);
		if(mysqli_connect_errno())
			return $ay; //connect error
		mysqli_set_charset($mysqli,"utf8");
		$conn="SELECT * FROM security WHERE uid = ".$_SESSION['CURR_USR'][0]." ORDER BY lastlog DESC LIMIT 4";
		$res=mysqli_query($mysqli,$conn);
		while($row=mysqli_fetch_row($res))
			array_push($ay,$row);
		mysqli_free_result($res);
		mysqli_close($mysqli);
		return $ay;
	}//}}}

//{{{public function err_msg($errno)
	public function err_msg($errno)
	{
		switch($errno)
		{
		case 0:
			return "成功!";
		case 1://
			return "更新用户基本信息失败";
		case 2://
			return "连接数据库失败";
		case 3://
			return "待保存的数据格式错误";
		case 4://
			return "选择的年份没有数据";
		case 5://
			return "保存用户登录信息失败";
		}
	}//}}}
}//}}}
//{{{class tb_invite extends signed_db 发送邀请所需数据库操作类
class tb_invite extends signed_db
{
//{{{private function check_valid($e) 检查待邀请的邮箱的有效性，唯一性
	private function check_valid($e)
	{
		if($this->err_no)
			return;	//4 no data
		if(!preg_match("/^(?:[a-z\d]+[_\-\+\.]?)*[a-z\d]+@(?:([a-z\d]+\-?)*[a-z\d]+\.)+([a-z]{2,})+$/i",$e))
		{$this->err_no=11;return;} //11 format error
		$this->get_sqli();
		if($this->err_no)
			return;//1 connect error
		$conn="SELECT email FROM auth";
		$ay=array();$i=0;
		$res=mysqli_query($this->mysqli,$conn);
		while($row=mysqli_fetch_row($res))
		{$ay[$i]=$row[0];$i+=1;}
		mysqli_free_result($res);
		mysqli_close($this->mysqli);
		foreach($ay as $a)
		{
			if(strcasecmp($a,$e) == 0)
			{$this->err_no=10;return;} //10 该邮箱已经注册
		}
		$this->get_sqli();
		if($this->err_no)
			return;//1 connect error
		$conn="SELECT invemail FROM invite WHERE uid = ".$_SESSION['CURR_USR'][0];
		$ay=array();$i=0;
		$res=mysqli_query($this->mysqli,$conn);
		while($row=mysqli_fetch_row($res))
		{$ay[$i]=$row[0];$i+=1;}
		mysqli_free_result($res);
		mysqli_close($this->mysqli);
		foreach($ay as $a)
		{
			if(strcasecmp($a,$e) == 0)
			{$this->err_no=12;return;} //12 该邮箱已经注册
		}
		$this->err_no=0;
	}//}}}
//{{{public function add_invite($u)
	public function add_invite($u)
	{
		if($this->err_no)
			return;
		if(count($u) != 4)
		{$this->err_no=2;return;} //2 参数错误
		$this->check_valid($u[1]);
		if($this->err_no)
			return;
		$conn=sprintf("INSERT INTO invite(uid,invemail,invbody,invited) VALUES (%d,'%s','%s',%d)",$u[0],$u[1],$u[2],$u[3]);
		$res=mysqli_query($this->mysqli,$conn);
		mysqli_close($this->mysqli);
		if($res == TRUE)
			return;
		else
			$this->err_no=3;
	}//}}}
//{{{private function check_invite($e) 检查对方是否已经接受邀请
	private function check_invite($e)
	{
		$this->reset();
		if($this->err_no)
			return;
		$conn="SELECT email FROM auth";
		$this->get_sqli();
		if($this->err_no)
			return;
		$ay=array();$i=0;
		$res=mysqli_query($this->mysqli,$conn);
		while($row=mysqli_fetch_row($res))
		{$ay[$i]=$row;$i+=1;}
		mysqli_free_result($res);
		mysqli_close($this->mysqli);
		foreach($ay as $a)
		{
			if($a == $e)
			{
				$this->update_invite($e);
				return;
			}
		}
		$this->err_no=13;//还未接受邀请
	}//}}}
//{{{public function get_invite()
	public function get_invite()
	{
		$ay=array();
		$this->reset();
		if($this->err_no)
			return $ay;
		$this->get_sqli();
		if($this->err_no)
			return $ay;
		$conn="SELECT * FROM invite WHERE uid = ".$_SESSION['CURR_USR'][0]." ORDER BY idx DESC LIMIT 6";
		$res=mysqli_query($this->mysqli,$conn);
		while($row=mysqli_fetch_row($res))
			array_push($ay,$row);
		mysqli_free_result($res);
		mysqli_close($this->mysqli);
		return $ay;
	}//}}}
//{{{public function update_invite($e)
	public function update_invite($e)
	{
		$this->reset();
		if($this->err_no)
			return;
		$this->get_sqli();
		if($this->err_no)
			return;
		$conn="UPDATE invite set invited = 1 WHERE uid = ".$_SESSION['CURR_USR'][0]." AND invemail = '".$e."'";
		mysqli_query($this->mysqli,$conn);
		mysqli_close($this->mysqli);
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
		case 10:
			return "邀请失败，该邮箱已经注册";
		case 11:
			return "您输入的不是有效的邮箱地址";
		case 12:
			return "该邮箱已经加入到您的邀请列表中";
		case 13:
			return "该邮箱尚未接受邀请";
		}
	}//}}}
//{{{public function reset()  重置错误代码，重新调用相关函数，完成初始化
	public function reset()
	{
		if($this->err_no == 4)
			$this->check_it();
		else
			$this->err_no=0;
	}//}}}
}//}}}

?>
