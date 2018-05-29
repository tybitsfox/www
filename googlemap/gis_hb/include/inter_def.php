<?php
/**
 * @package base
 * @version 0.1.0.0
 * @author 田勇 Alias tybitsfox <tybitsfox@163.com>
 * @copyright (c) 2017 by tybitsfox
 * @license GPLv2
 * 
 * 本文件是土壤环境信息系统其中的一个文件
 * Available at http://202.102.134.68
 *
 * 这一程序是自由软件，你可以遵照自由软件基金会出版的GNU通用公共许可证条款来修改和重新
 * 发布这一程序。或者用许可证的第二版，或者（根据你的选择）用任何更新的版本。
 *
 * 发布这一程序的目的是希望它有用，但没有任何担保。甚至没有适合特定目的的隐含的担保。更
 * 详细的情况请参阅GNU通用公共许可证。
 *
 * 你应该已经和程序一起收到一份GNU通用公共许可证的副本。如果还没有，请查阅：
 * <http://www.gnu.org/licenses/>.
 * 或者写信给： The Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston,
 * MA  02111-1307  USA
 */
?>
<?php
/*本文件是所有接口的定义文件
 
 	2016-4-17 田勇 alias tybitsfox
 */
//下面的接口是用户定义本项目中所有目录的取得函数及一些常规值的取得函数
interface inter_base_def
{
	public function get_base_dir();//取得顶级目录的函数
	public function get_conf_dir();//取得config目录的函数
	public function get_temp_dir();//取得模板（template）目录的函数
	public function get_incl_dir();//取得include目录的函数
	public function get_core_dir();//取得core目录的函数
	public function get_intr_dir();//取得interface目录的函数
}
//下面的接口定义了数据库的基本操作
interface sqli_def
{
	public function get_cur_year();//取得当前年份
	public function get_used_db();//取得目标数据库的信息
	public function query_db($n);//数据库操作函数
}
//下面的接口定义了所有的显示界面的实现
interface tab_show
{
	public function show_header();//表头的显示
	public function show_body();//表内容的显示
	public function show_tail();//表尾的显示
}
//下面的接口定义了图形显示所需数据的准备实现
interface gra_data
{//接口定义的必须是public类型
/*attention:
  该接口与tab_show不同，不直接参与显示界面的生成，而仅仅是实现显示数据的准备和
  序列化工作。所以，在具体实现时，应考虑同时继承本接口和sql_def接口。
 */	
	public function range_xway();//横坐标信息生成
	public function range_yway();//纵坐标信息生成
	public function range_ary();//显示数据的序列化
	public function analysis_post();//对post传递值的处理
}
//下面的接口定义了左边栏的控制区域中下拉列表中数据的取得。
interface listbox_data
{
	public function get_used_db();//取得待访问的数据库服务器和数据库访问相关信息
	public function get_cur_year();//取得当前的年份
	public function get_ctlarea();//取得控制区域列表框中数据的函数
	public function get_unit($y);	//取得站点名称列表框中数据的函数
}
//下面的接口定义了右边栏数据及标准的取得
interface main_data
{
	public function get_used_db($y);	//取得待访问的数据库服务器和数据库访问相关信息
	public function parse_sql();	//解析并生成访问字符串
	public function get_std();		//取得标准
	public function get_unit();		//取得数据
}
//2016-12-20 将明晰显示的右边栏数据及标准的取得定一个新的接口，该接口是main_data的一个扩展
interface main_data_ex
{
	public function get_used_db($y);	//取得待访问的数据库服务器和数据库访问相关信息
	public function parse_sql();	//解析并生成访问字符串
	public function get_std();		//取得标准
	public function get_unit($pp);		//取得数据
//	public function hour_range_unit($dt);	//按小时顺序（若存在无效数据则需插入表示无效数据的记录）重新排列
//	public function day_range_unit($dt);	//按日顺序（若存在无效数据则需插入表示无效数据的记录）重新排列
//	public function geth($tm);	//取得date字符串中的小时
//	public function getd($tm);	//取得daye字符串中的日
}



?>


