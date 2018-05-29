#include"./clsscr.h"
#include"./hpfarm/stddef.h"
#include"./libdir/accsrc.h"
#include"./hpfarm/happyfm.h"
/*欢乐农场demo版，基本的窗口显示和控件放在so文件中。
		tybitsfox 2010.12.26
 */
int main(int argc,char** argv)
{
//首先读取默认的配置文件：./rc.conf
	int i,ch[1024];
	empty_rc();//NULL
	if(!get_rc())
	{
		printf("error to init proc!\n");
		free_rc();
		return 0;
	}
	if(!verf_rc())
	{
		free_rc();
		return 0;
	}
//	save_record();
	create_win(&argc,&argv);
	gdk_threads_enter();
	gtk_main();
	gdk_threads_leave();
	/*for(i=0;i<HP_SHOP_COUNTS;i++)
	{
		printf("作物名称：%s\n路径：%s\n",tso[i]->crop_name,tso[i]->png_filename);
	}*/
	/*sleep(5);
	if(load_record()!=0)
		printf("error\n");
	else
	{
		printf("玩家姓名：%s 等级：%d 金钱：%d\n",tpp.name,tpp.level,tpp.money);
	}*/
	printf("ok\n");
	free_rc();
	return 0;
}

