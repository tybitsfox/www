#ifndef HAPPY_FARM_OWN
#define HAPPY_FARM_OWN		0x33
//{{{定义内存分配的大小
#define HP_BLOCK_SIZE			1024
//定义的信息栏缓冲大小
#define HP_MSG_BUF_LEN			512
//定义商店物品名称缓冲大小
#define HP_SHOP_NAME_LEN		32
//定义商店物品数量
#define HP_SHOP_COUNTS			16
//定义的rc.conf所用的关键字
#define HP_MAIN_ICON			"mainicon"
#define HP_STATUS_ICON			"statusicon"
#define HP_BACK_IMG				"backimg"
//下面定义工具栏图标在rc.conf中所用的关键字
#define HP_FNM0					"fnm0"
#define HP_FNM1					"fnm1"
#define HP_FNM2					"fnm2"
#define HP_FNM3					"fnm3"
#define HP_FNM4					"fnm4"
#define HP_FNM5					"fnm5"
#define HP_FNM6					"fnm6"
#define HP_FNM7					"fnm7"
//2011-1-8 add
#define HP_TYPHOON				"typhoonimg"
#define HP_8PM					"8pmimg"
#define HP_CST					"cstimg"
//下面定义土地图片在rc.conf中所用的关键字
#define HP_FLAND0				"fland0"
#define HP_FLAND1				"fland1"
#define HP_FLAND2				"fland2"
#define HP_FLAND3				"fland3"
#define HP_FLAND4				"fland4"
//下面定义作物的四种状态图片在rc.conf中所用的关键字
#define HP_FSTAT0				"fstat0"
#define HP_FSTAT1				"fstat1"
#define HP_FSTAT2				"fstat2"
#define HP_FSTAT3				"fstat3"
//下面定义控制编辑框显示、隐藏的按钮使用的图片资源
#define HP_EDIT_ICON1			"cmdicon1"
//下面定义光标的图片资源
#define HP_FIELD_CURSOR1		"fieldcursor1"
//下面定义信息栏字体属性
#define HP_FONT_FACE			"msgfontface"
#define HP_FONT_COLOR			"msgfontcolor"
#define HP_FONT_SIZE			"msgfontsize"
//下面定义命令别名在rc.conf中所用的关键字
//查询个人资料的关键字,默认为：who
#define CMD_WHO					"cmd_who"
//查存种植的关键字,默认为：status
#define CMD_FIELD				"cmd_field"
//设置自动运行的关键字,默认为：autorun on/off
#define CMD_AUTORUN				"cmd_play"
//下面定义信息显示效果模板：注意：这里字体我已指定
#define SYSTEM_MSG_STYLE	"&lt;span face='YaHei Consolas Hybrid' color='#ff0000' font='10'&gt;%s&lt;/span&gt;"
#define SYSTEM_MSG_STYLE_2	"&lt;span face='YaHei Consolas Hybrid' color='#ff0000' font='10'&gt;%s&lt;/span&gt;&lt;span face='YaHei Consolas Hybrid' color='#0000ff' font='10'&gt;%s&lt;/span&gt;"
#define SYSTEM_MSG_STYLE_NUM	"&lt;span face='YaHei Consolas Hybrid' color='#ff0000' font='10'&gt;%d&lt;/span&gt;"
#define FREE_MSG_STYLE	"&lt;span face='%s' color='%s' font='%s'&gt; %s&lt;/span&gt;"
//}}}
//包含gtk头文件
#include&lt;gtk/gtk.h&gt;
//{{{ typedef struct TAG_FARM
typedef struct TAG_FARM
{
	GtkWidget *window; //窗口
	GtkWidget *toolbar; //工具栏
	GtkWidget *vbox;   //主容器
	GtkWidget *label;  //消息栏
	GtkWidget *fix;	   //游戏界面容器
	GtkToolItem *nm[8]; //工具栏按钮
	GtkWidget *img;    //通用图像指针
	GdkPixbuf *pixbuf; //通用pixbuf
	GtkWidget *menu;   //托盘菜单
	GtkWidget *menuwinrestore; //托盘菜单恢复窗口项
	GtkWidget *menuset; //托盘设置对话框项
	GtkWidget *menuexit; //托盘系统退出项
	GtkStatusIcon *sicon; //托盘图标
	GtkWidget *ebox[11];//eventbox	
	GtkWidget *fimg[8];//4种状态的土地图片
	GtkWidget *cmdimg;//编辑框隐藏、显示的按钮图标
	GtkWidget *entry;//编辑框
	GtkTreeSelection *selection;//仓库对话框选择项
//下面定义的是商店使用的资源
	GtkWidget *splabel;//商店对话框使用的label
//工具栏farm使用的图片资源
	GtkWidget *ftyphoonimg;
//	土地四种状态的pixbuf
	GdkPixbuf *pix[4];
//8块土地的tooltips
	GtkTooltips *ftip[8];	
}tag_farm;
tag_farm  tf;//}}}
//{{{ typedef struct TAG_CONTROL_MINE
/*
   下面的结构体是控制变量定义,所有的游戏控制可以通过脚本、参数设置等
   传递给下面的结构中
 */
typedef struct TAG_CONTROL_MINE
{
	unsigned int init_once;	//游戏窗体创建的初始化标志，＝1表示已创建。
	unsigned char fieldstat[8];/*土地状况：
								 0:空闲
								 1:播种
								 2:成长
								 3:成熟
								 4:收获
								 0x10: 杂草
								 0x20: 害虫
								 0x30: 干旱
								 x040: 水涝*/
	unsigned char autosowing;    //自动播种。
	unsigned char autobuyseeds;  //自动购买种子
	unsigned char autobuycubs;   //自动购买幼崽
	unsigned char autoharvest;   //自动收获。
//以上设置暂未使用，下面为保存用户的命令行别名的设置
	char *cmd_who;
	char *cmd_field;
	char *cmd_run;
}tag_ctl_farm;
tag_ctl_farm tcf;//}}}
//{{{ typedef struct TAG_RC_FARM
/*下列结构定义了使用图片资源的路径,该结构是通过一个由用户自由配置的文件生成。在程序初始化时读取配置文件：./rc.conf获得并填充该结构.
 */
typedef struct TAG_RC_FARM
{
	int  initflag;			//内存分配、释放标志。＝1表示已分配
	char *fmainicon;		//主程序图标图片路径
	char *fstatusicon;		//托盘图标
	char *backimg;			//背景图片
	char *fnm[8];			//工具栏图标
	char *fland[5];			//土地的5中状态图片
	char *fstat[4];			//作物的4中状态图片
	char *cmdicon;			//编辑框显示、隐藏的控制按钮图片
	char *fcursor1;			//进入土地的光标图案
	char *typhoonimg;		//工具栏农场对话框使用图片
	char *epmimg;			//工具栏牧场对话框使用图片
	char *cstimg;			//工具栏加工厂对话框使用图片

}tag_rc_farm;
tag_rc_farm  trc;//}}}
//{{{  typedef struct TAG_MSG_BUFFER
/*下列结构定义信息栏缓冲区及指针,实现信息栏三行的滚动显示
 该信息栏在单机版中仅是显示一些游戏过程的各类系统提示信息，在网络版中拟
 实现聊天的信息显示等。在单机版中各系统提示不会太长，而将来用于聊天时，
 设定的每行默认输入字符为50，所以，现在先对缓冲定义为512,将来如需要在增
 加。该结构实际上仅在图形模式下使用，放入这里是为了统一操作，将内存的申
 请、释放放在一起进行操作。 
 */
typedef struct TAG_MSG_BUFFER
{
	char *cc1;//在初始状态下，保存第一行信息
	char *cc2;//第二行信息
	char *cc3;//第三行信息
	char *pp1;//
	char *pp2;
	char *pp3;
	char *p4;
	char *p5;
	char *ch;
	int  flag_1;//编辑框显示、隐藏的标志，0为显示。
	char *fface;//定义的字体名称，长度不得超过64字节
	char *fsize;//定义的字体大小，长度不得超过两字节－99
	char *fcolor;//定义的字体颜色，
}tag_msg_buffer;
tag_msg_buffer tmb;//他马B？}}}
//{{{ typedef struct TAG_TIME_SET
/*该结构保存了土地的各种状态，定时器根据各土地的结构体进行图片的切换
 在播种时设置每块土地的结构体的初始数据，收获后清空结构体。
 */
typedef struct TAG_TIME_SET
{
	unsigned char ifseeding;	//是否播种底4位＝0:未播种，1：播种，2：成长，3：收获。高4位不用了，使用了8个结构数组替代。
	unsigned short ripening_time; //成熟时间。
	unsigned short time_left;		//剩余时间
	unsigned short crop_num;		//作物名称序号。
}tag_time_set;
tag_time_set tts[8];//}}}
//{{{ typedef struct TAG_SEED_OPT
//商店种子的属性定义
typedef struct TAG_SEED_OPT
{
	unsigned short seed_num;		//索引
	unsigned short exp;				//能获得的经验
	unsigned char  level_limt;		//等级限制
	unsigned short rip_time;		//每季的生长时间。
	unsigned short seed_price;		//种子价格
	unsigned short crop_price;		//作物价格
	unsigned short crop_num;		//作物产量
	char*	crop_name;				//作物名称
	char*   png_filename;			//图片文件
}tag_seed_opt;
tag_seed_opt  *tso[HP_SHOP_COUNTS];	//暂定16种作物.}}}
//{{{ typedef struct AG_CROP_HARVEST
//收获的作物的属性定义
typedef struct TAG_CROP_HARVEST
{
	unsigned short num;		//与tso结构联系的关键，等于tso-&gt;seed_num.
	unsigned char priv;				//锁定，不自动卖出
	unsigned short price;			//售价
	unsigned short counts;			//数量
	char*	h_name;					//作物名称
	char*	png_filename;			//图片文件
}tag_harvest;
//tag_harvest *th[HP_SHOP_COUNTS];	//最多20种库存}}}
//{{{种植中的作物 typedef struct TAG_IN_FIELD
//
typedef struct TAG_IN_FIELD
{
	unsigned short num;		//与tso结构关联
	unsigned short status;	//三种成长状态
	unsigned short utime;	//每种状态所需的时间
}tag_in_field;//}}}
//{{{ typedef struct TAG_PLAYER_PROPERTY
//定义玩家的属性
typedef struct TAG_PLAYER_PROPERTY
{
	unsigned short	level;			//等级
	unsigned int	exp;			//经验
	unsigned int	money;			//
	unsigned char	luck;			//幸运值
	char*			name;			//
	tag_harvest*	th[HP_SHOP_COUNTS];
	tag_in_field*	tif[8];			//正在种植的资料
}tag_player_p;
tag_player_p tpp;	//}}}
//定义tooltips缓冲区
char *tipbuf;
#endif




