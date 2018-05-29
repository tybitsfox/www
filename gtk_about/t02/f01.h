#include&lt;gtk/gtk.h&gt;
#include"clsscr.h"
/*本程序基本上是对t04程序的重写，为了便于以后查阅，将所有控件的建立
 分别独立的函数实现。
 			tybitsfox		2013-11-20
 */
/*定义gtk控件变量结构*/
//{{{ ---struct
struct win_var
{
	GtkWidget	*window;		//窗口控件
	GtkWidget	*vbox;			//容器控件Vbox
	GtkWidget	*fixed;			//容器控件fixed
	GtkWidget	*toolbar;		//工具栏控件
	GtkToolItem	*bnt[5];		//工具栏按钮控件
	GtkTooltips	*tips[5];		//工具栏按钮提示控件
	GtkWidget	*label;			//文字输出控件
	GtkWidget	*textview;		//文本视图控件
	GtkTextBuffer	*buffer;	//文本视图缓冲
	GtkTextIter	iter;			//文本视图，位置偏移
	GtkStatusIcon	*sicon;		//托盘控件
	GtkWidget	*menu;			//托盘的菜单实现
	GtkWidget	*menu_restore;	//托盘菜单-恢复窗口菜单项
	GtkWidget	*menu_set;		//托盘菜单-系统设置菜单项
	GtkWidget	*menu_exit;		//托盘菜单-程序退出菜单项
	GtkWidget	*entry;			//编辑框控件
	GtkWidget	*event_box[2];	//事件箱控件
	GtkWidget	*button;		//按钮控件
};
struct win_var ws;
/*定义全局变量结构*/
struct sys_vall
{
	int	show_entry;				//编辑框的显示与隐藏标志，1为显示0隐藏
	
};
struct sys_vall sv; //}}}
//{{{ defines
//这里是一些资源和常量的定义
#define	 iconfile			"/root/Desktop/20131113114643935_easyicon_net_48.png"
#define  ticon1				"/root/Desktop/20131113114524776_easyicon_net_48.png"
#define	 ticon2				"/root/Desktop/20131113114546330_easyicon_net_48.png"
#define  ticon3				"/root/Desktop/20131113114601370_easyicon_net_48.png"
#define  ticon4				"/root/Desktop/20131113114631150_easyicon_net_48.png"
#define  ticon5				"/root/Desktop/20131113114727305_easyicon_net_48.png"
#define  ticon6				"/root/Desktop/20131113114735974_easyicon_net_48.png"
#define  insert_pix			"/root/Desktop/2013111311474498_easyicon_net_48.png"
#define  set_dlg_pix		"/root/Desktop/20131116090351738_easyicon_net_96.png"
#define  back_img			"/root/Desktop/635188111932812500.jpg"
#define  enty_img			"/root/Desktop/dsga.png"
#define  sml_map			"/root/Desktop/20131118033339907_easyicon_net_118.png"
#define  win_title			"tybitsfox"
#define  win_x				800
#define  win_y				600
#define	 wbk_x				796
#define  wbk_y				534
#define  tv_x				660
#define  tv_y				450

//下面的两项是textview的相对位置
#define  vpos_x				5				
#define  vpos_y				5
//定义textview tag name
#define  tag_pal			"pal"		//pixels_above_lines
#define  tag_lmarg			"lmarg"		//left_margin
#define  tag_pbl			"pbl"		//pixels_below_lines
#define  tag_red_fg			"red_fg"	//foreground red
#define  tag_blue_fg		"blue_fg"	//foreground blue
#define	 tag_gray_bg		"gray_bg"	//background gray
#define	 tag_undline		"underline"	//underline PANGO_UNDERLINE_SINGLE
#define  tag_bold			"bold"		//weight  PANGO_WEIGHT_BOLD
#define  tag_italic			"italic"	//style	  PANGO_STYLE_ITALIC
#define	 tag_strike			"strike"	//strikethrough  TRUE
//font size
#define  tag_quarter		"quater sized"		//scale  0.25
#define	 tag_des			"double_extra_small"	//scale PANGO_SCALE_XX_SMALL
#define	 tag_es				"extra_small"			//scale PANGO_SCALE_X_SMALL
#define  tag_small			"small"					//scale PANGO_SCALE_SMALL
#define  tag_med			"medium"				//scale PANGO_SCALE_MEDIUM
#define  tag_large			"large"					//scale PANGO_SCALE_LARGE
#define  tag_elrg			"extra large"			//scale PANGO_SCALE_X_LARGE
#define  tag_delrg			"double extra large"	//scale PANGO_SCLAE_XX_LARGE
#define  tag_dsz			"double size"			//scale 2.0
//font name
#define  tag_fsong			"FangSong_GB2312"
#define  tag_yahei			"YaHei Consolas Hybrid"
#define  tag_simsong		"SimSun"
#define  tag_kaiti			"KaiTi_GB2312"
//define some message and tooltips
#define  tip_statusicon		"仙游MUD客户端V0.1\n百度linux吧\n0+捣蛋精灵\n2011-11-16"
//tips message
#define  tmsg0				"基本信息设置界面"
#define  tmsg1				"电子公告栏设置界面"
#define  tmsg2				"bot操作设置界面"
#define  tmsg3				"服务器、网络链接设置界面"
#define  tmsg4				"mud游戏设置界面"

//}}}

//{{{ functions
//主窗口建立函数
<a href=gtk_simple.php#gf001>void crt_window(int a,char** b);</a>
//pixbuf生成函数
<a href=gtk_simple.php#gf002>GdkPixbuf *crt_pixbuf(gchar *filename);</a>
//工具栏的建立函数
<a href=gtk_simple.php#gf003>void crt_toolbar();</a>
//tooltips的建立函数
<a href=gtk_simple.php#gf004>void crt_tooltips(GtkWidget *widget,GtkWidget *tips,gpointer gp);</a>
//文本视图的建立函数
<a href=gtk_simple.php#gf005>void crt_textview();</a>
//建立窗口背景的函数
<a href=gtk_simple.php#gf006>void crt_background();</a>
//事件盒的建立
<a href=gtk_simple.php#gf007>void crt_eventbox();</a>
//编辑框的建立函数
<a href=gtk_simple.php#gf008>void crt_entry();</a>
//托盘图标的建立和应用函数
<a href=gtk_simple.php#gf009>void crt_statusicon();</a>
//事件盒-地图的建立函数
<a href=gtk_simple.php#gf010>void crt_mapevent();</a>

//事件盒的事件响应函数
<a href=gtk_simple.php#gf011>gint disp_entry(GtkWidget *widget,GdkEvent *event,gpointer gp);</a>
//托盘菜单恢复窗口的响应函数
<a href=gtk_simple.php#gf012>void restore_window(GtkWidget *widget,gpointer gp);</a>
//托盘菜单系统设置的响应函数
<a href=gtk_simple.php#gf013>void set_window(GtkWidget *widget,gpointer gp);</a>
//托盘菜单程序退出的响应函数
<a href=gtk_simple.php#gf014>void exit_window(GtkWidget *widget,gpointer gp);</a>
//右键点击托盘图标弹出菜单的响应函数
<a href=gtk_simple.php#gf015>void show_menu(GtkWidget *widget,guint button,guint32 activate_time,gpointer gp);</a>
//delete事件响应函数
<a href=gtk_simple.php#gf016>gint hide_window(GtkWidget *widget,GdkEvent *event,gpointer gp);</a>
//工具栏的响应函数
<a href=gtk_simple.php#gf017>void on_bnt0(GtkWidget *widget,gpointer gp);</a>
<a href=gtk_simple.php#gf018>void on_bnt1(GtkWidget *widget,gpointer gp);</a>
<a href=gtk_simple.php#gf019>void on_bnt2(GtkWidget *widget,gpointer gp);</a>
<a href=gtk_simple.php#gf020>void on_bnt3(GtkWidget *widget,gpointer gp);</a>
<a href=gtk_simple.php#gf021>void on_bnt4(GtkWidget *widget,gpointer gp);</a>

//}}}



