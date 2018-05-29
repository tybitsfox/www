enum{COL_DISPLAY_NAME,COL_PIXBUF,NUM_COLS};
enum e_depot{LIST_NAME=0,LIST_COUNT,LIST_PRICE,LIST_TOTAL,LIST_SIGNED,U_NUMS};
//纠结的g_thread...
struct TAG_THREAD_DATA
{
	unsigned int index;
	unsigned int num;
}ttd[8];
void create_win(int *c,char*** v);  //建立窗口及控件
GdkPixbuf *create_pixbuf(char *filename); //建立图标pixbuf
void restore_window(GtkWidget *widget,gpointer pt);
void game_set(GtkWidget *widget,gpointer pt);
void show_menu(GtkWidget *widget,guint button,guint32 activate_time,gpointer pt);
gint hide_window(GtkWidget *widget,GdkEvent *event,gpointer pt);
void on_bt1(GtkWidget *widget,gpointer pt);
void array_str(char *p,int sz,int nomod);//用于显示信息的字符串整理函数
void put_field();//消息盒以及土地图片的控件的添加函数。
void put_entry();//编辑框控件的添加。
void disp_cmdline(GtkWidget *widget,GdkEvent *event,gpointer pt);//编辑框的显示和隐藏
void farm_tim_set(gpointer pt);//农场的定时器
void on_shop(GtkWidget *widget,gpointer pt);//工具栏商店按钮的响应函数
GtkTreeModel *crt_model();//商店对话框iconview的建立函数
void on_shop_item_activated(GtkWidget *widget,GtkTreePath *treepath,gpointer pt);//商店购买的响应函数
void on_farm(GtkWidget *widget,gpointer pt);//点击工具栏农场图标的响应函数
void on_farm_exit(GtkWidget *widget,gpointer pt);//on_farm对话框的关闭按钮响应
void on_depot(GtkWidget *widget,gpointer pt);//工具栏仓库的响应
void on_depot_init_list(GtkWidget *widget);//仓库对话框中列表框的建立函数
void on_depot_add_item(GtkWidget *widget);//仓库对话框添加已有或收获的项目
void on_depot_sell_item(GtkWidget *widget,gpointer pt);//仓库卖出单项存货
gpointer thd_tim(gpointer pt);//线程执行函数
int on_shop_get_index(char *ch);//取得用户选取的种子索引号
void on_harvest(GtkWidget *widget,GdkEvent *event,gpointer pt);//点击土地收获的函数
void on_field_tips(GtkWidget *widget,GdkEvent *event,gpointer pt);//进入土地的tooltip设定函数
int exp_calc(int e);//计算等级、经验值的函数,返回1表示升级，否则为0
void parse_cmd(GtkWidget *widget,gpointer pt);//解析命令





