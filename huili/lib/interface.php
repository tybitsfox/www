
<?php
//本文件定义了所有类的实现接口
?>
<?php
interface inter_sign
{
	public function check_it($a,$b);	//定义了所有的有效性检查
	public function signin();			//登录验证
	public function signup();			//注册
	public function resets();			//重置密码
	public function err_msg($errno);	//错误信息显示函数	
}

?>
