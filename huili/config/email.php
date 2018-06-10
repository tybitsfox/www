<?php
//learn from Reson
/*这是根据一个比较流行的smtp类修改的，原作者Reson.查看其代码可知这个相当古老的实现了，虽然经过修改她已支持php7.0但是里面的很多代码的写法确实
  不能在php7.0下正确的执行，好在这些代码以及其所在的函数在一般情形下很少会被执行。因此，我对上述错误进行了修正。并且去掉了现在不会被执行的函数
  因为看其正则表达式，很多写法和应用现在真是很少见了。当然，对一些代码的剔除，不可避免的会削弱整个类的功能。但作为普通的可支持身份验证的发送邮
  件操作，这个弱化的类完全可满足需要！
			tybitsfox	2018-5-16
 */
?>
<?php
class smtp
{
	public $smtp_port,$time_out,$host_name,$log_file,$relay_host;
	public $debug,$auth,$usr,$pwd;
	private $sock;
//{{{function __construct()	
	function __construct()
	{
		$this->debug = FALSE;
		$this->smtp_port = 25;
		$this->relay_host = "smtp.126.com";
		$this->time_out = 30;
		$this->auth = TRUE;
		$this->usr = "bitsfox@126.com";
		$this->pwd = "hjkl&1234AZ";
		$this->host_name = "localhost";
		$this->log_file = "";
		$this->sock = FALSE;
	}//}}}
//{{{function sendmail($to,$from,$subject = "",$body = "",$mailtype,$cc = "",$bcc = "",$ad_headers = "")
	function sendmail($to,$from,$subject = "",$body = "",$mailtype,$cc = "",$bcc = "",$ad_headers = "")
	{
		$mail_from = $this->get_address($from);
		$body = preg_replace("/(^|(\r\n))(\.)/","\\1.\\3",$body);
		$header = "MIME-Version:1.0\r\n";
		if($mailtype=="HTML")
			$header .= "Content-Type:text/html\r\n";
		$header .= "To: ${to}\r\n";
		if($cc != "")
			$header .= "Cc:${cc}\r\n";
		$header .= "From: {$from}<{$from}>\r\n";
		$header .= "Subject: ".$subject."\r\n";
		$header .= $ad_header;
		$header .= "Date: ".date("r")."\r\n";
		$header .= "X-Mailer:By Debian (PHP/".phpversion().")\r\n";
		list($msec,$sec) = explode(" ",microtime());
		$header .= "Message-ID: <".date("YmdHis",$sec).".".($msec*1000000).".".$mail_from.">\r\n";
		$TO = explode(",",$to);
		if($cc != "")
			$TO = array_merge($TO,explode(",",$cc));
		if($bcc != "")
			$TO = array_merge($TO,explode(",",$bcc));
		$send = TRUE;
		foreach($TO as $rct)
		{
			$rct=$this->get_address($rct);
			if(!$this->smtp_sockopen($rct))
			{
				$this->log_write("Error:cannot send email to ".$rct."\n");
				$sent = FALSE;
				continue;
			}
			if($this->smtp_send($mail_from,$rct,$header,$body))
				$this->log_write("E-mail has been sent to &lt;".$rct."&gt;<br>");
			else
			{
				$this->log_write("Error: Cannot send email to <".$rct.">\n");
				$sent = FALSE;
			}
			fclose($this->sock);
			$this->log_write("Disconnected from remote host<br>");
		}
		return $sent;
	}//}}}
//{{{function smtp_send($from,$to,$header,$body = "")
	function smtp_send($from,$to,$header,$body = "")
	{
		if(!$this->smtp_putcmd("HELO",$this->host_name))
			return $this->smtp_error("sending HELO command");
		if($this->auth)
		{
			if(!$this->smtp_putcmd("AUTH LOGIN",base64_encode($this->usr)))
				return $this->smtp_error("sending HELO command");
			if(!$this->smtp_putcmd("",base64_encode($this->pwd)))
				return $this->smtp_error("sending HELO command");
		}
		if(!$this->smtp_putcmd("MAIL","FROM:<".$from.">"))
			return $this->smtp_error("sending MAIL FROM command");
		if(!$this->smtp_putcmd("RCPT","TO:<".$to.">"))
			return $this->smtp_error("sending RCPT TO command");
		if(!$this->smtp_putcmd("DATA"))
			return $this->smtp_error("sending DATA command");
		if(!$this->smtp_message($header,$body))
			return $this->smtp_error("sending message");
		if(!$this->smtp_eom())
			return $this->smtp_error("sending <CR><LF>.<CR><LF> [EOM]");
		if(!$this->smtp_putcmd("QUIT"))
			return $this->smtp_error("sending QUIT command");
		return TRUE;
	}//}}}
//{{{function smtp_sockopen($address)
	function smtp_sockopen($address)
	{
		$this->log_write("Trying to ".$this->relay_host.":".$this->smtp_port."\n");
		$this->sock = @fsockopen($this->relay_host,$this->smtp_port,$errno,$errstr,$this->time_out);
		if(!($this->sock && $this->smtp_ok()))
		{
			$this->log_write("Error: Cannot connect to relay host ".$this->relay_host."\n");
			$this->log_write("Error: ".$errstr." (".$errno.")\n");
			return FALSE;
		}
		$this->log_write("Connected to relay host ".$this->relay_host."\n");
		return TRUE;
	}//}}}
//{{{function smtp_message($header,$body)
	function smtp_message($header,$body)
	{
		fputs($this->sock,$header."\r\n".$body);
		$this->smtp_debug(">".str_replace("\r\n","<br>> ",$header."<br>> ".$body."<br>>"));
		return TRUE;
	}//}}}
//{{{function smtp_eom()
	function smtp_eom()
	{
		fputs($this->sock,"\r\n.\r\n");
		$this->smtp_debug(". [EOM]<br>");
		return $this->smtp_ok();
	}//}}}
//{{{function smtp_ok()
	function smtp_ok()
	{
		$response = str_replace("\r\n","",fgets($this->sock,512));
		$this->smtp_debug($response."<br>");
		if(!preg_match("/^[23]/",$response))
		{
			fputs($this->sock,"QUIT\r\n");
			fgets($this->sock,512);
			$this->log_write("Error: Remote host returned \"".$response."\"\n");
			return FALSE;
		}
		return TRUE;
	}//}}}
//{{{function smtp_putcmd($cmd,$arg = "")
	function smtp_putcmd($cmd,$arg = "")
	{
		if($arg != "")
		{
			if($cmd == "")
				$cmd = $arg;
			else
				$cmd = $cmd." ".$arg;
		}
		fputs($this->sock,$cmd."\r\n");
		$this->smtp_debug("> ".$cmd."<br>");
		return $this->smtp_ok();
	}//}}}
//{{{function smtp_error($string)
	function smtp_error($string)
	{
		$this->log_write("Error: Error occurred while ".$string.".\n");
		return FALSE;
	}//}}}
//{{{function log_write($message)
	function log_write($message)
	{
		$this->smtp_debug($message);
		if($this->log_file == "")
			return TRUE;
		$message = date("M d H:i:s ").get_current_user()."[".getmypid()."]: ".$message;
		if(!@file_exists($this->log_file) || !($fp = @fopen($this->log_file,"a")))
		{
			$this->smtp_debug("Warning: Cannot open log file \"".$this->log_file."\"<br>");
			return FALSE;
		}
		flock($fp,LOCK_EX);
		fputs($fp,$message);
		fclose($fp);
		return TRUE;
	}//}}}
//{{{function strip_comment($address)
	function strip_comment($address)
	{//注：这个类不定是从哪个应用中扒过来的，一般不会有括号注释需要删除，而我之前的输入有效性检测中已经排除了园括号和引号的使用。所以个这函数对我无用。在里保留这个函数仅是备查备用。
		$comment = "/\([^()]*\)/";	//取得首个非嵌套括号内的字符串
//循环删除非嵌套括号内字符串，直至全部括号内内容全部删除，只保留括号外字符串。
		while(preg_match($comment,$address))
			$address=preg_replace($comment,"",$address);
		return $address;
	}//}}}
//{{{function get_address($address)
	function get_address($address)
	{
		$address = preg_replace("/([ \t\r\n])+/","",$address);
		$address = preg_replace("/^.*<(.+)>.*$/","\\1",$address);
		return $address;
	}//}}}
//{{{function smtp_debug($message)
	function smtp_debug($message)
	{
		if($this->debug)
			echo $message;
	}//}}}
}
class mixer
{
	public $needle,$email;
//{{{public funcrion __construct()
	public function __construct()
	{
		$this->needle="?code=";
		$this->email="your email";
	}//}}}
//{{{public function mix($xa = "your email")
	public function mix($xa = "your email")
	{
		$zone=intval(date("O"))*36;
		$g=intval(date("U"));
		$gg=$g-$zone; //转换为格林尼治时间
		$gx=sprintf("%X",$g);
		$l=$g%10+5;
		$b=base64_encode(base64_encode($xa));
		return sprintf("%s-%s-%s-%X",base64_encode(base64_encode($gg)),base64_encode($gx),$b,$l);
	}//}}}
//{{{public function get_nedle()
	public function get_nedle()
	{return $this->needle;}//}}}
//{{{public function unmix($st = "")
	public function unmix($st = "")
	{
		if($st == "")
			return false;
		list($gg,$gx,$ymail,$l)=explode("-",$st);
		$gg=base64_decode(base64_decode($gg));
		$gx=base64_decode($gx);
		$l=intval(base_convert($l,16,10));
		$g=intval($gg);
		$this->email=base64_decode(base64_decode($ymail));
		if($l != ($g%10+5))
			return false;
		$zone=intval(date("O"))*36;
		$ga=intval(base_convert($gx,16,10))-$zone;
		if($ga != intval($gg))
			return false;
		$gg=intval(date("U"))-$zone;
		if(($gg >= $ga) && ($gg <= ($ga+1800))) //验证时间在半小时内
			return true;
		else
			return false;
	}//}}}
//{{{public function get_mail()
	public function get_mail()
	{return $this->email;}//}}}

}

?>
