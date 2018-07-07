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
		case 5:
			return "申请失败！该帐户已申请认证";
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
		case 14:
			return "邮箱格式错误！";
		case 15:
			return "该邮箱已在您的邀请列表中";
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
		if(is_null($ay[0][12]))
			$ay[0][12]=constant("DEF_IMG");
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
		$conn=sprintf("INSERT INTO auth(uid,email,uname,pwd,priv,lvl,sex,expr,coin,treasure,signup,lastlogin,imgpath) VALUES(%d,'%s','%s','%s',%d,1,0,0,0,0,now(),now(),'')",$uid,$u,$str3,$str1,$str2);
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
		if((!isset($_SESSION['CURR_USR'])) || (count($_SESSION['CURR_USR']) != 13))
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
			$conn="SELECT uid FROM auth WHERE email = '".$ay[1]."'";
			$res=mysqli_query($this->mysqli,$conn);
			$row=mysqli_fetch_row($res);
			mysqli_free_result($res);
			mysqli_close($this->mysqli);
			if(!is_null($row))
			{$this->err_no=9;return;}
			$this->init_db();
			if($this->err_no)
				return;
			$st1="UPDATE auth SET email = '".$ay[1]."' WHERE uid = ".$_SESSION['CURR_USR'][0];
			break;
		case 3://picimg
			$st1="UPDATE auth SET imgpath ='".$ay[1]."' WHERE uid = ".$_SESSION['CURR_USR'][0];
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
//{{{public function get_usr() 取得所有注册的用户
	public function get_usr()
	{
		$ay=array();
		$this->init_db();
		if($this->err_no)
			return $ay;
		$conn="SELECT * from auth";
		$res=mysqli_query($this->mysqli,$conn);
		while($row=mysqli_fetch_row($res))
			array_push($ay,$row);
		mysqli_free_result($res);
		mysqli_close($this->mysqli);
		return $ay;
	}//}}}
}//}}}
//{{{class tb_choose extends base_login
class tb_choose extends base_login
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
		$this->init_db();
		if($this->err_no)
			return;
		$conn=sprintf("INSERT INTO choose(uid,mid,cid,mname,mlink,mclass,micon) VALUES(%d,%d,'%s','%s','%s','%s','%s')",$a[0],$a[1],$a[2],$a[3],$a[4],$a[5],$a[6]);
		$res=mysqli_query($this->mysqli,$conn);
		mysqli_close($this->mysqli);
		if($res == TRUE)
			return;
		else
			$this->err_no=3;
	}//}}}
}//}}}
//{{{class used_sign extends base_login
//登录用户的信息:uid(0),email(1),uname(2),pwd(3),priv(4),lvl(5),sex(6),expr(7),coin(8),treasure(9),signup(10),lastlogin(11),imgpath(12)
//security:uid(0),lastlog(1),signed(2),lgip(3),lgsys(4),lgbrow(5),trust(6),perm(7)
class used_sign extends base_login
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
		$this->init_db();
		if($this->err_no)
			return;
		$a=array();
		$a=$this->get_secu();
		if($a[2] == 0)//添加防止刷金币的代码,没有错误代码
			return;
		$exp=intval($_SESSION['CURR_USR'][7])+1;
		$i=floor($exp/100)+1;
		if($i > intval($_SESSION['CURR_USR'][5]))
			$conn="UPDATE auth set lvl = ".$i.",expr = expr+1,coin = coin+1,lastlogin = '".date("Y-m-d H:i:s",$_SESSION['USR_AGENT'][1])."' WHERE uid = ".$_SESSION['CURR_USR'][0];
		else
			$conn="UPDATE auth set expr = expr+1,coin = coin+1,lastlogin = '".date("Y-m-d H:i:s",$_SESSION['USR_AGENT'][1])."' WHERE uid = ".$_SESSION['CURR_USR'][0];
		$res=mysqli_query($this->mysqli,$conn);
		mysqli_close($this->mysqli);
		if($res == TRUE)
		{
			if($i > intval($_SESSION['CURR_USR'][5]))
				$_SESSION['CURR_USR'][5]=$i;
			$_SESSION['curr_USR'][7]=$exp;
			return;//success
		}
		else
			$this->err_no=11;//update error
	}//}}}
//{{{public function add_secu() 添加登录信息表（security）记录
	public function add_secu()
	{
		$this->init_db();
		if($this->err_no)
			return;
		$a=array();
		$a=$this->get_secu();
		$conn=sprintf("INSERT INTO security(uid,lastlog,signed,lgip,lgsys,lgbrow,trust,perm) VALUES(%d,now(),%d,'%s','%s','%s',%d,%d)",$a[0],$a[2],$a[3],$a[4],$a[5],$a[6],$a[7]);
		$res=mysqli_query($this->mysqli,$conn);
		mysqli_close($this->mysqli);
		if($res == TRUE)
			return;
		else
			$this->err_no=3;//保存用户登录信息失败！
	}//}}}
//{{{public function get_secu_from_db() 从数据库中取得的用于在安全页面显示的4条记录函数
	public function get_secu_from_db()
	{
		$ay=array();
		$this->init_db();
		if($this->err_no)
			return $ay;
		$conn="SELECT * FROM security WHERE uid = ".$_SESSION['CURR_USR'][0]." ORDER BY lastlog DESC LIMIT 4";
		$res=mysqli_query($this->mysqli,$conn);
		while($row=mysqli_fetch_row($res))
			array_push($ay,$row);
		mysqli_free_result($res);
		mysqli_close($this->mysqli);
		return $ay;
	}//}}}
}//}}}
//{{{class tb_invite extends base_login 发送邀请所需数据库操作类
class tb_invite extends base_login
{
//{{{private function check_valid($e) 检查待邀请的邮箱的有效性，唯一性
	private function check_valid($e)
	{
		$this->init_db();
		if($this->err_no)
			return;	//4 no data
		if(!preg_match("/^(?:[a-z\d]+[_\-\+\.]?)*[a-z\d]+@(?:([a-z\d]+\-?)*[a-z\d]+\.)+([a-z]{2,})+$/i",$e))
		{$this->err_no=14;return;} //14 format error
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
			{$this->err_no=9;return;} //9 该邮箱已经注册
		}
		$this->init_db();
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
			{$this->err_no=15;return;} //15 该邮箱已经邀请了
		}
		$this->init_db();
	}//}}}
//{{{public function add_invite($u)
	public function add_invite($u)
	{
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
//{{{public function check_invite($e) 检查对方是否已经接受邀请
	public function check_invite($e)
	{
		$this->init_db();
		if($this->err_no)
			return;
		$conn="SELECT invemail FROM invite WHERE idx = ".$e;
		$res=mysqli_query($this->mysqli,$conn);
		$row=mysqli_fetch_row($res);
		if(is_null($row))
		{
			mysqli_free_result($res);
			mysqli_close($this->mysqli);
			$this->err_no=16; //no result
			return;
		}
		$mail=$row[0];
		mysqli_free_result($res);
		mysqli_close($this->mysqli);
		$conn="SELECT email FROM auth";
		unset($row);
		$this->init_db();
		if($this->err_no)
			return;
		$ay=array();$i=0;
		$res=mysqli_query($this->mysqli,$conn);
		while($row=mysqli_fetch_row($res))
		{$ay[$i]=$row[0];$i+=1;}
		mysqli_free_result($res);
		mysqli_close($this->mysqli);
		foreach($ay as $a)
		{
			if(strcasecmp($a,$mail) == 0)
			{
				$this->update_invite($e);
				return;
			}
		}
		$this->err_no=100;//还未接受邀请
	}//}}}
//{{{public function get_invite()
	public function get_invite()
	{
		$ay=array();
		$this->init_db();
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
//{{{private function update_invite($e)
	private function update_invite($e)
	{
		$this->init_db();
		if($this->err_no)
			return;
		$conn="UPDATE invite set invited = 1 WHERE idx = ".$e;
		mysqli_query($this->mysqli,$conn);
		mysqli_close($this->mysqli);
	}//}}}
}//}}}
//{{{class tb_expert extends base_login	专家表操作类
class tb_expert extends base_login
{
//{{{public function add_expert($e)
	public function add_expert($e)
	{
		$this->check_len($e);
		if($this->err_no)
			return; //2,6
		$this->init_db();
		if($this->err_no)
			return;//1
		$conn=sprintf("SELECT comp FROM expert WHERE uid = %s",$e[0]);
		$res=mysqli_query($this->mysqli,$conn);
		$row=mysqli_fetch_row($res);
		if($row != NULL)
		{
			mysqli_free_result($res);
			mysqli_close($this->mysqli);
			$this->err_no=5;//confirmed error
			return;
		}
		mysqli_free_result($res);
		mysqli_close($this->mysqli);
		$this->get_sqli();
		if($this->err_no)
			return;//1
		$conn=sprintf("INSERT INTO expert(uid,category,name,addr,phone,major,intro,img,mid,confirmed) VALUES(%s,%s,'%s','%s','%s','%s','%s','%s',%s,0)",$e[0],$e[1],$e[2],$e[3],$e[4],$e[5],$e[6],$e[7],$e[8]);
		$res=mysqli_query($this->mysqli,$conn);
		mysqli_close($this->mysqli);
		if($res == TRUE)
			return;
		else
			$this->err_no=3;		
	}//}}}
//{{{public function get_expert($e)	e[0]=0:by uid;e[0]=1:by mid confirmed;e[0]=2:by mid not confirmed;e[0]=3 by confirmed;e[0]=4 by not confirmed
	public function get_expert($e)
	{
		$ay=array();
		if(count($e) != 2)
		{$this->err_no=2;return $ay;} //2
		$this->init_db();
		if($this->err_no)
			return $ay;
		switch(intval($e[0]))
		{
		case 0://按uid取得
			$conn="SELECT * FROM expert WHERE uid = ".$e[1];
			break;
		case 1://按专业和取得认证
			$conn="SELECT * FROM expert WHERE (mid & ".$e[1].") != 0 AND confirmed = 1";
			break;
		case 2://按专业和未取得认证
			$conn="SELECT * FROM expert WHERE (mid & ".$e[1].") != 0 AND confirmed = 0";
			break;
		case 3://已被认证的
			$conn="SELECT * FROM expert WHERE confirmed = 1";
			break;
		case 4://未被认证的
			$conn="SELECT * FROM expert WHERE confirmed = 0";
			break;
		default:
			$conn="SELECT * FROM expert";  //select all
			break;
		}
		$res=mysqli_query($this->mysqli,$conn);
		while($row=mysqli_fetch_row($res))
			array_push($ay,$row);
		mysqli_free_result($res);
		mysqli_close($this->mysqli);
		return $ay;
	}//}}}
//{{{private function check_len($e)  输入的合法性检查
	private function check_len($e)
	{//only check string length
		if(count($e) != 9)
		{$this->err_no=2;return;} //2 参数错误
		if(strlen($e[2]) >= 32)
		{$this->err_no=6;return;}
		if(strlen($e[3]) >= 48)
		{$this->err_no=6;return;}
		if(strlen($e[4]) >= 12)
		{$this->err_no=6;return;}
		if(strlen($e[5]) >= 32)
		{$this->err_no=6;return;}
		if(strlen($e[6]) >= 512)
		{$this->err_no=6;return;}
		if(strlen($e[7]) >= 255)
		{$this->err_no=6;return;}
	}//}}}
//{{{public function update_expert($e) 更新认证标志和图片的函数 e[0]=0:confirmed; e[0]=1:disconfirmed; e[0]=2:update pic
	public function update_expert($e)
	{
		if(count($e)<2)
		{$this->err_no=2;return;}
		$this->init_db();
		if($this->err_no)
			return;
		switch($e[0])
		{
		case 0://认证
			$conn="UPDATE expert SET confirmed = 1 WHERE uid =".$e[1];
			break;
		case 1://解除认证
			$conn="UPDATE expert SET confirmed = 0 WHERE uid =".$e[1];
			break;
		case 2://更改图片	e[0]=2;e[1]=uid,e[2]=new pic link
			if(strlen($e[2]) >= 255)
			{$this->err_no=6;return;}
			$conn="SELECT img FROM expert WHERE uid =".$e[1];
			$res=mysqli_query($this->mysqli,$conn);
			$row=mysqli_fetch_row($res);
			mysqli_free_result($res);
			mysqli_close($this->mysqli);
			$a=constant("FULL_PATH");
			$defpath=substr($a,0,strpos($a,"huili")-1);
			if($row != null)
			{
				$a=$defpath.$row[0];
				unlink($a);
			}
			$a=$defpath."/huili/images/logo/guest.png";
			$this->init_db();
			if($this->err_no)
				return;
			$conn="UPDATE expert set img = '".$e[2]."' WHERE uid =".$e[1];
			$res=mysqli_query($this->mysqli,$conn);
			mysqli_close($this->mysqli);
			if($res == TRUE)
				return;
			else
			{
				$this->err_no=11;
				return;
			}
		}
	}//}}}

}//}}}
?>
