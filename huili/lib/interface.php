
<?php
//本文件定义了所有类的实现接口
?>
<?php
interface inter_sign
{
	public function signin();			//登录验证
	public function signup();			//注册
	public function resets($p);			//重置密码
	public function err_msg($errno);	//错误信息显示函数	
}
//这是后台界面对数据库管理维护的实现接口,针对每个表都依此接口实现一个类。
interface root_setting
{
	public function add($ay);			//添加记录
	public function edit($ay);			//编辑
	public function del($ay);			//删除
	public function err_msg($errno);	//错误提示
}
?>
