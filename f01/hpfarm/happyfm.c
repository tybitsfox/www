#include"../include/clsscr.h"
#include"../include/stddef.h"
#include"../include/happyfm.h"
//{{{ void array_str(char *p,int sz,int nomod) 
void array_str(char *p,int sz,int nomod)
{//新加入的字符串由p传入，使用p1,p2,p3进行排列
	char ch[HP_MSG_BUF_LEN*3];
	int i;
	if(sz&gt;HP_MSG_BUF_LEN*3)
	{
		p=NULL;
		return;
	}
	i=strlen(p);
	tmb.p5=p+i-1;
	if(*tmb.p5=='\n')
		*tmb.p5=0;
	tmb.p4=tmb.pp3;
	tmb.pp3=tmb.pp1;
	tmb.pp1=tmb.pp2;
	tmb.pp2=tmb.p4;
	memset(tmb.pp3,0,HP_MSG_BUF_LEN);
	//memcpy(tmb.pp3,p,strlen(p));
	memset(ch,0,HP_MSG_BUF_LEN*3);
	if(nomod==0)
	{
	//	snprintf(ch,HP_MSG_BUF_LEN*3,"&lt;span face='%s' color='%s' font='%s'&gt;%s\n&lt;/span&gt;&lt;span face='%s' color='%s' font='%s'&gt;%s\n&lt;/span&gt;&lt;span face='%s' color='%s' font='%s'&gt;%s\n&lt;/span&gt;",tmb.fface,tmb.fcolor,tmb.fsize,tmb.pp1,tmb.fface,tmb.fcolor,tmb.fsize,tmb.pp2,tmb.fface,tmb.fcolor,tmb.fsize,tmb.pp3);
		snprintf(tmb.pp3,HP_MSG_BUF_LEN,"&lt;span face='%s' color='%s' font='%s'&gt;%s&lt;/span&gt;",tmb.fface,tmb.fcolor,tmb.fsize,p);
	}
	else
	{
	//	snprintf(ch,HP_MSG_BUF_LEN*3,"&lt;span face='%s' color='%s' font='%s'&gt;%s\n&lt;/span&gt;&lt;span face='%s' color='%s' font='%s'&gt;%s\n&lt;/span&gt;%s\n",tmb.fface,tmb.fcolor,tmb.fsize,tmb.pp1,tmb.fface,tmb.fcolor,tmb.fsize,tmb.pp2,tmb.pp3);
		snprintf(tmb.pp3,HP_MSG_BUF_LEN,"%s",p);
	}
	snprintf(ch,HP_MSG_BUF_LEN*3,"%s\n%s\n%s",tmb.pp1,tmb.pp2,tmb.pp3);
	i=strlen(ch);
	if(i&gt;HP_MSG_BUF_LEN*3)
	{
		p=NULL;
		return;
	}
	memset(p,0,sz);
	memcpy(p,ch,i);
	//g_print("%s\n",p);
}//}}}
//{{{ void create_win(int *c,char*** v)
void create_win(int *c,char*** v)
{
	int i;
	char *p;
	gtk_set_locale();
	if(!g_thread_supported())
		g_thread_init(NULL);
	gdk_threads_init();
	gtk_init(c,v);
	for(i=0;i&lt;8;i++)
	{
		ttd[i].index=HP_SHOP_COUNTS;
		ttd[i].num=HP_SHOP_COUNTS;
	}
	for(i=0;i&lt;4;i++)
		tf.pix[i]=create_pixbuf(trc.fland[i]);
	tf.window=gtk_window_new(GTK_WINDOW_TOPLEVEL);
	gtk_window_set_title(GTK_WINDOW(tf.window),"欢乐农场 v0.1");
	gtk_window_set_position(GTK_WINDOW(tf.window),GTK_WIN_POS_CENTER);
	gtk_widget_set_size_request(tf.window,800,600);
	gtk_window_set_icon(GTK_WINDOW(tf.window),create_pixbuf(trc.fmainicon));
	gtk_window_set_resizable(GTK_WINDOW(tf.window),FALSE);
	//开始实现托盘
	tf.sicon=gtk_status_icon_new_from_file(trc.fstatusicon);
	tf.menu=gtk_menu_new();
	tf.menuwinrestore=gtk_menu_item_new_with_label("恢复窗口");
	tf.menuset=gtk_menu_item_new_with_label("游戏设置");
	tf.menuexit=gtk_menu_item_new_with_label("退    出");
	g_signal_connect(G_OBJECT(tf.menuwinrestore),"activate",G_CALLBACK(restore_window),tf.window);
	g_signal_connect(G_OBJECT(tf.menuset),"activate",G_CALLBACK(game_set),NULL);
//这里在退出时需要执行游戏进度的保存工作，
//然后退出,内存的释放、清理将在窗口关闭后进行	
	g_signal_connect(G_OBJECT(tf.menuexit),"activate",G_CALLBACK(gtk_main_quit),NULL);
	gtk_menu_shell_append(GTK_MENU_SHELL(tf.menu),tf.menuwinrestore);
	gtk_menu_shell_append(GTK_MENU_SHELL(tf.menu),tf.menuset);
	gtk_menu_shell_append(GTK_MENU_SHELL(tf.menu),tf.menuexit);
	gtk_widget_show_all(tf.menu);
	gtk_status_icon_set_tooltip(tf.sicon,"欢乐农场 v0.1，欢迎您的参与\n百度linux吧 零家捣蛋精灵");
	g_signal_connect(GTK_STATUS_ICON(tf.sicon),"activate",GTK_SIGNAL_FUNC(restore_window),tf.window);//点击托盘图标，弹出窗口的响应
	g_signal_connect(GTK_STATUS_ICON(tf.sicon),"popup-menu",GTK_SIGNAL_FUNC(show_menu),tf.menu);//右键点击托盘图标，弹出菜单的响应
	gtk_status_icon_set_visible(tf.sicon,FALSE);
//这里修改托盘的显示状态转换，改为点击关闭按钮时截获delete-event
	g_signal_connect(G_OBJECT(tf.window),"delete-event",G_CALLBACK(hide_window),tf.sicon);
	tf.vbox=gtk_vbox_new(FALSE,2);
	gtk_container_add(GTK_CONTAINER(tf.window),tf.vbox);
	tf.toolbar=gtk_toolbar_new();
	gtk_toolbar_set_style(GTK_TOOLBAR(tf.toolbar),GTK_TOOLBAR_ICONS);
	gtk_container_set_border_width(GTK_CONTAINER(tf.toolbar),2);
	for(i=0;i&lt;7;i++)
	{
		tf.img=gtk_image_new_from_file(trc.fnm[i]);
		tf.nm[i]=gtk_tool_button_new(tf.img,"");
		gtk_toolbar_insert(GTK_TOOLBAR(tf.toolbar),tf.nm[i],-1);
	}
	gtk_box_pack_start(GTK_BOX(tf.vbox),tf.toolbar,FALSE,FALSE,2);
	tf.fix=gtk_fixed_new();
	tf.img=gtk_image_new_from_file(trc.backimg);
	gtk_widget_set_size_request(tf.img,799,599);
	gtk_fixed_put(GTK_FIXED(tf.fix),tf.img,1,1);
	tf.label=gtk_label_new("");
	gtk_widget_set_size_request(tf.label,796,60);
	gtk_misc_set_alignment(GTK_MISC(tf.label),0,0);
	gtk_fixed_put(GTK_FIXED(tf.fix),tf.label,20,2);
	memset(tmb.cc1,0,HP_MSG_BUF_LEN);
	memset(tmb.cc2,0,HP_MSG_BUF_LEN);
	memset(tmb.cc3,0,HP_MSG_BUF_LEN);
	tmb.pp1=tmb.cc1;tmb.pp2=tmb.cc2;tmb.pp3=tmb.cc3;
	memset(tmb.ch,0,HP_MSG_BUF_LEN*3);
	p=tmb.ch;
	snprintf(tmb.ch,HP_MSG_BUF_LEN,"欢迎来到欢乐农场.....");
	array_str(p,HP_MSG_BUF_LEN*3,0);
	memset(tmb.ch,0,HP_MSG_BUF_LEN*3);
	p=tmb.ch;
	snprintf(tmb.ch,HP_MSG_BUF_LEN,"本程序现为演示版本,希望能得到您的支持与帮助");
	array_str(p,HP_MSG_BUF_LEN*3,0);
	memset(tmb.ch,0,HP_MSG_BUF_LEN*3);
	snprintf(tmb.ch,HP_MSG_BUF_LEN*3,"Author：tybitsfox 百度linux吧－零家捣蛋精灵");
	p=tmb.ch;
	array_str(p,HP_MSG_BUF_LEN*3,0);
	gtk_label_set_markup(GTK_LABEL(tf.label),p);
	put_field();
	put_entry();
	gtk_box_pack_start(GTK_BOX(tf.vbox),tf.fix,FALSE,FALSE,2);
	for(i=0;i&lt;8;i++)
	{
		gtk_widget_realize(tf.ebox[i]);
		gdk_window_set_cursor(tf.ebox[i]-&gt;window,gdk_cursor_new_from_pixbuf(gdk_display_get_default(),create_pixbuf(trc.fcursor1),0,0));
		tf.ftip[i]=gtk_tooltips_new();
	}
	g_signal_connect(G_OBJECT(tf.nm[4]),"clicked",G_CALLBACK(on_shop),NULL);
	g_signal_connect(G_OBJECT(tf.nm[0]),"clicked",G_CALLBACK(on_farm),(gpointer)0);
	g_signal_connect(G_OBJECT(tf.nm[1]),"clicked",G_CALLBACK(on_farm),(gpointer)1);
	g_signal_connect(G_OBJECT(tf.nm[3]),"clicked",G_CALLBACK(on_farm),(gpointer)3);
	g_signal_connect(G_OBJECT(tf.nm[2]),"clicked",G_CALLBACK(on_depot),NULL);
//农场的定时器	
	g_timeout_add(5000,(GSourceFunc)farm_tim_set,NULL);
	gtk_widget_show_all(tf.window);
}//}}}
//{{{ GdkPixbuf *create_pixbuf(char *filename)
GdkPixbuf *create_pixbuf(char *filename)
{
	GdkPixbuf *pix;
	GError *error=NULL;
	pix=gdk_pixbuf_new_from_file(filename,&error);
	if(!pix)
	{
		fprintf(stderr,"%s\n",error-&gt;message);
		g_error_free(error);
	}
	return pix;
}//}}}
//{{{ void restore_window(GtkWidget *widget,gpointer pt)
//托盘菜单中或点击托盘图标时显示主界面的函数实现
void restore_window(GtkWidget *widget,gpointer pt)
{
	gtk_widget_show(GTK_WIDGET(tf.window));
	gtk_window_deiconify(GTK_WINDOW(tf.window));
	gtk_status_icon_set_visible(GTK_STATUS_ICON(tf.sicon),FALSE);
}//}}}
//{{{  void game_set(GtkWidget *widget,gpointer pt)
void game_set(GtkWidget *widget,gpointer pt)
{
	GtkWidget *dlg,*fix,*label,*imag,*bt1;
	dlg=gtk_dialog_new();
	gtk_window_set_title(GTK_WINDOW(dlg),"游戏设置");
	gtk_window_set_position(GTK_WINDOW(dlg),GTK_WIN_POS_CENTER);
	//gtk_window_set_default_size(GTK_WINDOW(dlg),400,300);
	//设置窗体透明度
	gtk_window_set_opacity(GTK_WINDOW(dlg),0.5);
	//去掉标题栏
	gtk_window_set_decorated(GTK_WINDOW(dlg),FALSE);
	fix=gtk_fixed_new();
	gtk_box_pack_start(GTK_BOX(GTK_DIALOG(dlg)-&gt;action_area),fix,TRUE,TRUE,0);
	label=gtk_label_new("在这里进行游戏的设置\n欢音您的参与  百度linux吧 零家捣蛋精灵");
	gtk_widget_set_size_request(label,390,45);
	gtk_fixed_put(GTK_FIXED(fix),label,2,5);
	imag=gtk_image_new_from_file("./imagefile/436213.png");
	gtk_widget_set_size_request(imag,128,128);
	gtk_fixed_put(GTK_FIXED(fix),imag,2,55);
	bt1=gtk_button_new_with_label("退出");
	gtk_widget_set_size_request(bt1,60,30);
	gtk_fixed_put(GTK_FIXED(fix),bt1,135,60);
	g_signal_connect(G_OBJECT(bt1),"clicked",G_CALLBACK(on_bt1),dlg);
	gtk_widget_show_all(dlg);
	gtk_dialog_run(GTK_DIALOG(dlg));
	gtk_widget_destroy(dlg);
}//}}}
//{{{ void show_menu(GtkWidget *widget,guint button,guint32 activate_time,gpointer pt)
//弹出托盘菜单的信号响应
void show_menu(GtkWidget *widget,guint button,guint32 activate_time,gpointer pt)
{
	gtk_menu_popup(GTK_MENU(pt),NULL,NULL,gtk_status_icon_position_menu,widget,button,activate_time);
}//}}}
//{{{ gint hide_window(GtkWidget *widget,GdkEvent *event,gpointer pt)
gint hide_window(GtkWidget *widget,GdkEvent *event,gpointer pt)
{
	gtk_widget_hide(GTK_WIDGET(widget));
	gtk_status_icon_set_visible(GTK_STATUS_ICON(pt),TRUE);
	return TRUE;
}//}}}
//{{{ void on_bt1(GtkWidget *widget,gpointer pt)
//游戏设置对话框的关闭按钮响应函数
void on_bt1(GtkWidget *widget,gpointer pt)
{
	gtk_widget_destroy(pt);
}//}}}
//{{{ void put_field()
void put_field()
{//单摘出来，便于查看、修改
	int i;
	for(i=0;i&lt;8;i++)
	{
		tf.ebox[i]=gtk_event_box_new();
		gtk_widget_set_events(tf.ebox[i],GDK_BUTTON_PRESS);
		tf.fimg[i]=gtk_image_new_from_file(trc.fland[0]);
		gtk_widget_set_size_request(tf.fimg[i],199,103);
		gtk_container_add(GTK_CONTAINER(tf.ebox[i]),tf.fimg[i]);
		gtk_fixed_put(GTK_FIXED(tf.fix),tf.ebox[i],2+199*(i%4),64+110*(i/4));
	}
	for(i=0;i&lt;8;i++)
	{//添加响应点击鼠标的事件
		gtk_widget_set_events(tf.ebox[i],GDK_BUTTON_PRESS_MASK);
		gtk_widget_set_events(tf.ebox[i],GDK_ENTER_NOTIFY_MASK);
	}
	for(i=0;i&lt;8;i++)
	{
		g_signal_connect(G_OBJECT(tf.ebox[i]),"button_press_event",G_CALLBACK(on_harvest),(gpointer)i);
		g_signal_connect(G_OBJECT(tf.ebox[i]),"enter_notify_event",G_CALLBACK(on_field_tips),(gpointer)i);
	}
}//}}}
//{{{ void put_entry()
void put_entry()
{//注意：tf.ebox[10]用于编辑框图片的消息响应
	tf.ebox[10]=gtk_event_box_new();
	gtk_event_box_set_visible_window((GtkEventBox *)tf.ebox[10],FALSE);
	gtk_widget_set_events(tf.ebox[10],GDK_BUTTON_PRESS);
	tf.cmdimg=gtk_image_new_from_file(trc.cmdicon);
	gtk_widget_set_size_request(tf.cmdimg,32,32);
	gtk_container_add(GTK_CONTAINER(tf.ebox[10]),tf.cmdimg);
	gtk_fixed_put(GTK_FIXED(tf.fix),tf.ebox[10],5,490);
	tf.entry=gtk_entry_new();
	gtk_entry_set_max_length(GTK_ENTRY(tf.entry),50);
	gtk_widget_set_size_request(tf.entry,400,25);
	gtk_fixed_put(GTK_FIXED(tf.fix),tf.entry,38,493);
	g_signal_connect(G_OBJECT(tf.ebox[10]),"button_press_event",G_CALLBACK(disp_cmdline),NULL);
	g_signal_connect(G_OBJECT(tf.entry),"activate",G_CALLBACK(parse_cmd),NULL);

}//}}}
//{{{ void disp_cmdline(GtkWidget *widget,GdkEvent *event,gpointer pt)
void disp_cmdline(GtkWidget *widget,GdkEvent *event,gpointer pt)
{
	if(tmb.flag_1==0)//显示
	{
		gtk_widget_hide(tf.entry);
		tmb.flag_1=1;
	}
	else
	{
		gtk_widget_show(tf.entry);
		tmb.flag_1=0;
	}
}//}}}
//{{{ void farm_tim_set(gpointer pt)
/*2011.1.13修改，原来是用的是tts结构进行判断，现改为对tpp.tif结构操作*/
void farm_tim_set(gpointer pt)
{
	int i,j,k;
	//set_field_tips();
	for(i=0;i&lt;8;i++)
	{
		if(tpp.tif[i]-&gt;num==HP_SHOP_COUNTS || tpp.tif[i]-&gt;status&gt;3)
			continue;
		tpp.tif[i]-&gt;utime--;
		if(tpp.tif[i]-&gt;utime&lt;=0)
		{
			tpp.tif[i]-&gt;status++;
			if(tpp.tif[i]-&gt;status&gt;3)
				continue;
			k=tpp.tif[i]-&gt;num;
			ttd[i].num=tpp.tif[i]-&gt;status;//土地状态序号
			ttd[i].index=i;//土地序号
			for(j=0;j&lt;HP_SHOP_COUNTS;j++)
			{
				if(tso[j]-&gt;seed_num==k)
				{
					tpp.tif[i]-&gt;utime=tso[j]-&gt;rip_time;
					break;
				}
			}
			g_thread_create(thd_tim,(gpointer)(&ttd[i]),FALSE,NULL);
		}
	}
}//}}}
//{{{ void on_shop(GtkWidget *widget,gpointer pt)
void on_shop(GtkWidget *widget,gpointer pt)
{
	GtkListStore *store;
	GtkWidget *dlg,*icon_view,*sw,*fix,*bt;
	dlg=gtk_dialog_new();
	gtk_window_set_position(GTK_WINDOW(dlg),GTK_WIN_POS_CENTER);
	gtk_window_set_opacity(GTK_WINDOW(dlg),0.5);
	gtk_window_set_decorated(GTK_WINDOW(dlg),FALSE);
	fix=gtk_fixed_new();
	gtk_box_pack_start(GTK_BOX(GTK_DIALOG(dlg)-&gt;action_area),fix,TRUE,TRUE,0);
	sw=gtk_scrolled_window_new(NULL,NULL);
	gtk_widget_set_size_request(sw,360,330);
	gtk_fixed_put(GTK_FIXED(fix),sw,2,2);
	gtk_scrolled_window_set_policy(GTK_SCROLLED_WINDOW(sw),GTK_POLICY_AUTOMATIC,GTK_POLICY_AUTOMATIC);
	gtk_scrolled_window_set_shadow_type(GTK_SCROLLED_WINDOW(sw),GTK_SHADOW_IN);
	store=(GtkListStore*)crt_model();
	icon_view=gtk_icon_view_new_with_model(GTK_TREE_MODEL(store));
	g_object_unref(store);
	gtk_container_add(GTK_CONTAINER(sw),icon_view);
	gtk_icon_view_set_text_column(GTK_ICON_VIEW(icon_view),COL_DISPLAY_NAME);
	gtk_icon_view_set_pixbuf_column(GTK_ICON_VIEW(icon_view),COL_PIXBUF);
	gtk_icon_view_set_selection_mode(GTK_ICON_VIEW(icon_view),GTK_SELECTION_SINGLE);
	tf.splabel=gtk_label_new("");
	gtk_widget_set_size_request(tf.splabel,300,30);
	gtk_fixed_put(GTK_FIXED(fix),tf.splabel,2,342);
	gtk_label_set_markup(GTK_LABEL(tf.splabel),"&lt;span face='YaHei Consolas Hybrid' color='#0000ff' font='10' &gt;双击即可购买播种&lt;/span&gt;");
	bt=gtk_button_new_with_label("退出");
	gtk_widget_set_size_request(bt,55,28);
	gtk_fixed_put(GTK_FIXED(fix),bt,304,342);
	g_signal_connect(G_OBJECT(bt),"clicked",G_CALLBACK(on_bt1),dlg);
	g_signal_connect(G_OBJECT(icon_view),"item_activated",G_CALLBACK(on_shop_item_activated),store);
	gtk_widget_show_all(dlg);
	gtk_dialog_run(GTK_DIALOG(dlg));
	gtk_widget_destroy(dlg);
}//}}}
//{{{ GtkTreeModel *crt_model()
GtkTreeModel *crt_model()
{
	GtkListStore *list_store;
	GdkPixbuf *pix[HP_SHOP_COUNTS];
	GtkTreeIter iter;
	int i;
	list_store=gtk_list_store_new(NUM_COLS,G_TYPE_STRING,GDK_TYPE_PIXBUF);
	for(i=0;i&lt;HP_SHOP_COUNTS;i++)
	{
		pix[i]=gdk_pixbuf_new_from_file(tso[i]-&gt;png_filename,NULL);
		gtk_list_store_append(list_store,&iter);
		gtk_list_store_set(list_store,&iter,COL_DISPLAY_NAME,tso[i]-&gt;crop_name,COL_PIXBUF,pix[i],-1);
	}
	return GTK_TREE_MODEL(list_store);
}//}}}
//{{{ void on_shop_item_activated(GtkWidget *widget,GtkTreepath *treepath,gpointer pt)
/*本函数中需要完成：1、对空闲土地的查找，2、金钱的判断，3、定时器运行标志的赋值。*/
void on_shop_item_activated(GtkWidget *widget,GtkTreePath *treepath,gpointer pt)
{
	int i,j;
	char *value,*p;
	GtkListStore *store;
	GtkTreeIter iter;
	p=malloc(512);
	memset(p,0,512);
	j=HP_SHOP_COUNTS;
	for(i=0;i&lt;8;i++)
	{//对空闲土地的判断
		if(tpp.tif[i]-&gt;num==HP_SHOP_COUNTS)
		{j=i;break;}
	}
	if(j==HP_SHOP_COUNTS)
	{
		snprintf(p,512,SYSTEM_MSG_STYLE,"没有空闲的土地");
		gtk_label_set_markup(GTK_LABEL(tf.splabel),p);
		free(p);
		return;
	}
	store=GTK_LIST_STORE(pt);
	gtk_tree_model_get_iter(GTK_TREE_MODEL(store),&iter,treepath);
	gtk_tree_model_get(GTK_TREE_MODEL(store),&iter,COL_DISPLAY_NAME,&value,-1);
	i=on_shop_get_index(value);
	if(tso[i]-&gt;level_limt&gt;tpp.level)
	{
		snprintf(p,512,SYSTEM_MSG_STYLE,"等级不够,不能种植");
	}
	else
	{
		if(tso[i]-&gt;seed_price&gt;tpp.money)
		{
			snprintf(p,512,SYSTEM_MSG_STYLE,"金钱不够，无法购买");
		}
		else
		{//
			tpp.money-=tso[i]-&gt;seed_price;
			tpp.tif[j]-&gt;num=tso[i]-&gt;seed_num;
			tpp.tif[j]-&gt;status=1;//1:播种期，2：成长期，3：收获期
			tpp.tif[j]-&gt;utime=tso[i]-&gt;rip_time;
			ttd[j].index=j;
			ttd[j].num=1;
			g_thread_create(thd_tim,(gpointer)(&ttd[j]),FALSE,NULL);
			snprintf(p,512,SYSTEM_MSG_STYLE_2,"成功种植：",value);
		}
	}
	gtk_label_set_markup(GTK_LABEL(tf.splabel),p);
	free(p);
	g_free(value);
}//}}}
//{{{ void on_farm(GtkWidget *widget,gpointer pt)
void on_farm(GtkWidget *widget,gpointer pt)
{
	char ch[1024],c1[256],c2[1024];
	int i,len;
	GtkWidget *dlg,*fix,*label,*image,*lname,*bt1,*bt2,*image1;
	len=(int)pt;
	if(len==0)
	{
		image=gtk_image_new_from_file(trc.typhoonimg);
		gtk_widget_set_size_request(image,82,90);
		memset(c1,0,sizeof(c1));
		snprintf(c1,sizeof(c1),SYSTEM_MSG_STYLE,"风太狼");
		memset(ch,0,sizeof(ch));
		memset(c2,0,sizeof(c2));
		snprintf(c2,sizeof(c2),FREE_MSG_STYLE,tmb.fface,"#0000ff",tmb.fsize,"欢迎您参与这款游戏的测试，我是");
		i=strlen(c2);
		memcpy(ch,c2,i);
		memset(c2,0,sizeof(c2));
		snprintf(c2,sizeof(c2),SYSTEM_MSG_STYLE,"风太狼");
		memcpy(&ch[i],c2,strlen(c2));
		i+=strlen(c2);
		memset(c2,0,sizeof(c2));
		snprintf(c2,sizeof(c2),FREE_MSG_STYLE,tmb.fface,"#0000ff",tmb.fsize,"这里的农场主管，在正式\n版中我会在游戏中给你很多帮助。如果你在游戏中遇到什么问题，记\n得来问问我哦...好了，祝你游戏愉快！");
		memcpy(&ch[i],c2,strlen(c2));
		goto begin_show1;
	}
	if(len==1)
	{
		image=gtk_image_new_from_file(trc.epmimg);
		gtk_widget_set_size_request(image,82,90);
		memset(c1,0,sizeof(c1));
		snprintf(c1,sizeof(c1),SYSTEM_MSG_STYLE,"扒皮埃姆");
		memset(ch,0,sizeof(ch));
		memset(c2,0,sizeof(c2));
		snprintf(c2,sizeof(c2),FREE_MSG_STYLE,tmb.fface,"#0000ff",tmb.fsize,"欢迎您参与这款游戏的测试，我是");
		i=strlen(c2);
		memcpy(ch,c2,i);
		memset(c2,0,sizeof(c2));
		snprintf(c2,sizeof(c2),SYSTEM_MSG_STYLE,"扒皮埃姆");
		memcpy(&ch[i],c2,strlen(c2));
		i+=strlen(c2);
		memset(c2,0,sizeof(c2));
		snprintf(c2,sizeof(c2),FREE_MSG_STYLE,tmb.fface,"#0000ff",tmb.fsize,"这里的牧场主管。在正\n式版中，我会在游戏中给你很多帮助。如果你在游戏中遇到什么问题，\n记得来问问我哦...好了，祝你游戏愉快！");
		memcpy(&ch[i],c2,strlen(c2));
		goto begin_show1;
	}
	if(len==3)
	{
		image=gtk_image_new_from_file(trc.cstimg);
		gtk_widget_set_size_request(image,82,90);
		memset(c1,0,sizeof(c1));
		snprintf(c1,sizeof(c1),SYSTEM_MSG_STYLE,"谁爱死蹄");
		memset(ch,0,sizeof(ch));
		memset(c2,0,sizeof(c2));
		snprintf(c2,sizeof(c2),FREE_MSG_STYLE,tmb.fface,"#0000ff",tmb.fsize,"欢迎您参与这款游戏的测试，我是");
		i=strlen(c2);
		memcpy(ch,c2,i);
		memset(c2,0,sizeof(c2));
		snprintf(c2,sizeof(c2),SYSTEM_MSG_STYLE,"谁爱死蹄");
		memcpy(&ch[i],c2,strlen(c2));
		i+=strlen(c2);
		memset(c2,0,sizeof(c2));
		snprintf(c2,sizeof(c2),FREE_MSG_STYLE,tmb.fface,"#0000ff",tmb.fsize,"这里的工场主管，在正\n式版中我会在游戏中给你很多帮助。如果你在游戏中遇到什么问题，\n记得来问问我哦...好了，祝你游戏愉快！");
		memcpy(&ch[i],c2,strlen(c2));
		goto begin_show1;
	}
begin_show1:	
	dlg=gtk_dialog_new();
	gtk_window_set_position(GTK_WINDOW(dlg),GTK_WIN_POS_CENTER);
	gtk_window_set_default_size(GTK_WINDOW(dlg),500,135);
	gtk_window_set_decorated(GTK_WINDOW(dlg),FALSE);
	fix=gtk_fixed_new();
	gtk_box_pack_start(GTK_BOX((GTK_DIALOG(dlg)-&gt;action_area)),fix,TRUE,TRUE,0);
	gtk_fixed_put(GTK_FIXED(fix),image,3,3);
	lname=gtk_label_new("");
	gtk_widget_set_size_request(lname,82,20);
	gtk_fixed_put(GTK_FIXED(fix),lname,3,95);
	gtk_label_set_markup(GTK_LABEL(lname),c1);
	label=gtk_label_new("");
	gtk_misc_set_alignment(GTK_MISC(label),0,0);
	gtk_widget_set_size_request(label,400,100);
	gtk_fixed_put(GTK_FIXED(fix),label,90,3);
//注意：这里没有对串长度进行验证，自己修改时小心。	
	gtk_label_set_markup(GTK_LABEL(label),ch);
	bt1=gtk_button_new_with_label("有问题");
	gtk_widget_set_size_request(bt1,60,25);
	gtk_fixed_put(GTK_FIXED(fix),bt1,180,105);
	bt2=gtk_button_new_with_label("不鸟你");
	gtk_widget_set_size_request(bt2,60,25);
	gtk_fixed_put(GTK_FIXED(fix),bt2,260,105);
	g_signal_connect(G_OBJECT(bt2),"clicked",G_CALLBACK(on_farm_exit),dlg);
	gtk_widget_show_all(dlg);
	gtk_dialog_run(GTK_DIALOG(dlg));
	gtk_widget_destroy(dlg);
}//}}}
//{{{ void on_farm_exit(GtkWidget *widgetm,gpointer pt)
void on_farm_exit(GtkWidget *widgetm,gpointer pt)
{
	gtk_widget_destroy((GtkWidget *)pt);
}//}}}
//{{{ void on_depot(GtkWidget *widget,gpointer pt)
void on_depot(GtkWidget *widget,gpointer pt)
{
	GtkWidget *dlg,*fix,*sw,*list,*bt1,*bt2,*bt3,*bt4;
	dlg=gtk_dialog_new();
	gtk_window_set_position(GTK_WINDOW(dlg),GTK_WIN_POS_CENTER);
	//gtk_window_set_default_size(GTK_WINDOW(dlg),384,400);
	gtk_window_set_opacity(GTK_WINDOW(dlg),0.5);
	gtk_window_set_decorated(GTK_WINDOW(dlg),FALSE);
	fix=gtk_fixed_new();
	gtk_box_pack_start(GTK_BOX(GTK_DIALOG(dlg)-&gt;action_area),fix,TRUE,TRUE,2);
	sw=gtk_scrolled_window_new(NULL,NULL);
	gtk_widget_set_size_request(sw,380,360);
	gtk_scrolled_window_set_policy(GTK_SCROLLED_WINDOW(sw),GTK_POLICY_AUTOMATIC,GTK_POLICY_AUTOMATIC);
	gtk_scrolled_window_set_shadow_type(GTK_SCROLLED_WINDOW(sw),GTK_SHADOW_IN);
	gtk_fixed_put(GTK_FIXED(fix),sw,2,2);
	list=gtk_tree_view_new();
	gtk_tree_view_set_headers_visible(GTK_TREE_VIEW(list),TRUE);
	on_depot_init_list(list);
	on_depot_add_item(list);
	tf.selection=gtk_tree_view_get_selection(GTK_TREE_VIEW(list));
	gtk_container_add(GTK_CONTAINER(sw),list);
	bt1=gtk_button_new_with_label("出  售");
	gtk_widget_set_size_request(bt1,70,28);
	gtk_fixed_put(GTK_FIXED(fix),bt1,2,370);
	bt2=gtk_button_new_with_label("出售全部");
	gtk_widget_set_size_request(bt2,70,28);
	gtk_fixed_put(GTK_FIXED(fix),bt2,95,370);
	bt3=gtk_button_new_with_label("标  记");
	gtk_widget_set_size_request(bt3,70,28);
	gtk_fixed_put(GTK_FIXED(fix),bt3,190,370);
	bt4=gtk_button_new_with_label("退  出");
	gtk_widget_set_size_request(bt4,70,28);
	gtk_fixed_put(GTK_FIXED(fix),bt4,285,370);

	gtk_widget_show_all(dlg);
	g_signal_connect(G_OBJECT(bt4),"clicked",G_CALLBACK(on_bt1),dlg);
	g_signal_connect(G_OBJECT(bt1),"clicked",G_CALLBACK(on_depot_sell_item),list);
	gtk_dialog_run(GTK_DIALOG(dlg));
	gtk_widget_destroy(dlg);
}//}}}
//{{{ void on_depot_init_list(GtkWidget *widget)
void on_depot_init_list(GtkWidget *widget)
{
	char *h_nm[5]={" 物   品 "," 数   量 "," 单   价 "," 合   计 "," 锁   定 "};
	int i;
	GtkCellRenderer *renderer;
	GtkTreeViewColumn *column;
	GtkListStore *store;
	for(i=0;i&lt;5;i++)
	{
		renderer=gtk_cell_renderer_text_new();
		gtk_tree_view_insert_column_with_attributes(GTK_TREE_VIEW(widget),-1,h_nm[i],renderer,"text",(enum e_depot)i,NULL);
	}
	store=gtk_list_store_new(U_NUMS,G_TYPE_STRING,G_TYPE_STRING,G_TYPE_STRING,G_TYPE_STRING,G_TYPE_STRING);
	gtk_tree_view_set_model(GTK_TREE_VIEW(widget),GTK_TREE_MODEL(store));
	g_object_unref(store);
}//}}}
//{{{ gpointer thd_tim(gpointer pt)
gpointer thd_tim(gpointer pt)
{
	int i,j;
//	struct TAG_THREAD_DATA *p;
//	p=(struct TAG_THREAD_DATA *)pt;
	i=((struct TAG_THREAD_DATA*)pt)-&gt;index;
	j=((struct TAG_THREAD_DATA*)pt)-&gt;num;
	if((j&lt;0 || j&gt;4) || (i&lt;0 || i&gt;=HP_SHOP_COUNTS))
	{
		g_print("%d %d\n",i,j);
		return;
	}
	gdk_threads_enter();
	gtk_container_remove(GTK_CONTAINER(tf.ebox[i]),tf.fimg[i]);
	tf.fimg[i]=gtk_image_new_from_pixbuf(tf.pix[j]);
	gtk_widget_set_size_request(tf.fimg[i],199,103);
	gtk_container_add(GTK_CONTAINER(tf.ebox[i]),tf.fimg[i]);
	gtk_widget_show(tf.fimg[i]);
	gdk_threads_leave();
}//}}}
//{{{ int on_shop_get_index(char *ch)
/*一个简单的做法是使tso结构的序号与tso[i]-&gt;seed_num一致，这样就可以在
  数据的处理上简化。但是缺点是配置文件shop.rc的修改、编辑也必须按照序号
  来。为了避免这种不一致的错误产生，还是获取seed_num来替代结构索引号.
 */
int on_shop_get_index(char *ch)
{
	int i;
	for(i=0;i&lt;HP_SHOP_COUNTS;i++)
	{
		if((memcmp(tso[i]-&gt;crop_name,ch,strlen(ch)))==0)
			return i;//tso[i]-&gt;seed_num;
	}
	return HP_SHOP_COUNTS;
}//}}}
//{{{ void on_harvest(GtkWidget *widget,GdkEvent *event,gpointer pt)
void on_harvest(GtkWidget *widget,GdkEvent *event,gpointer pt)
{
	int i,j,k,m,n,v;
	unsigned int u;
	char *p,*p1;
	k=(int)pt;
	p1=NULL;j=0;m=n=-1;
	memset(tmb.ch,0,HP_MSG_BUF_LEN*3);
	if((tpp.tif[k]-&gt;num&lt;HP_SHOP_COUNTS) && (tpp.tif[k]-&gt;status==4))
	{//可收获
		for(i=0;i&lt;HP_SHOP_COUNTS;i++)
		{//在一个循环中确定库存的保存项，与商店商品的对应项。
			if(m==-1)
			{//库存中有相同的作物
				if(tpp.th[i]-&gt;num==tpp.tif[k]-&gt;num)
					m=i;
			}
			if(n==-1)
			{//查抄库存结构中第一个为空的项，如m有效则m优先
				if(tpp.th[i]-&gt;num==HP_SHOP_COUNTS)
					n=i;
			}
			if(tpp.tif[k]-&gt;num==tso[i]-&gt;seed_num)
			{
				u=tso[i]-&gt;exp;//经验
				v=tso[i]-&gt;crop_price;//售价
				j=tso[i]-&gt;crop_num;//产量
				p1=tso[i]-&gt;crop_name;//名称
				//break;
			}
		}
		if(m!=-1)
		{//仓库中有相同的作物，只累加数量即可
			tpp.th[m]-&gt;counts+=j;
		}
		else
		{//
			if(n==-1)
			{
				g_print("一个错误~~~");
				return;
			}
			//为仓库结构中第一个为空的项赋值
			tpp.th[n]-&gt;num=tpp.tif[k]-&gt;num;
			tpp.th[n]-&gt;priv=0;
			tpp.th[n]-&gt;price=v;
			tpp.th[n]-&gt;counts=j;
			tpp.th[n]-&gt;h_name=p1;
		}
		if(exp_calc(u)==1)//升级
		{
			snprintf(tmb.ch,HP_MSG_BUF_LEN*3,SYSTEM_MSG_STYLE,"恭喜您升级！！");
			p=tmb.ch;
			array_str(p,HP_MSG_BUF_LEN*3,1);
			memset(tmb.ch,0,HP_MSG_BUF_LEN*3);
		}
		snprintf(tmb.ch,HP_MSG_BUF_LEN*3,"土地%d 收获%s %d个",k,p1,j);
		p=tmb.ch;
		array_str(p,HP_MSG_BUF_LEN*3,0);
		gtk_label_set_markup(GTK_LABEL(tf.label),p);
		ttd[k].index=k;
		ttd[k].num=0;
		g_thread_create(thd_tim,(gpointer)(&ttd[k]),FALSE,NULL);
//清空tpp.tif[k]的资料
		tpp.tif[k]-&gt;num=HP_SHOP_COUNTS;
		tpp.tif[k]-&gt;status=0;
		tpp.tif[k]-&gt;utime=0;
		return;
	}
	snprintf(tmb.ch,HP_MSG_BUF_LEN*3,"当前土地%d 不能收获",(int)pt);
	p=tmb.ch;
	array_str(p,HP_MSG_BUF_LEN*3,0);
	gtk_label_set_markup(GTK_LABEL(tf.label),p);
}//}}}
//{{{ void on_field_tips(GtkWidget *widget,GdkEvent *event,gpointer pt)
void on_field_tips(GtkWidget *widget,GdkEvent *event,gpointer pt)
{
	int i,j,k,l,m;
	char cst[128],*p1;
	m=0;
	i=(int)pt;
	memset(tipbuf,0,HP_MSG_BUF_LEN);
	if(tpp.tif[i]-&gt;num==HP_SHOP_COUNTS)
		snprintf(tipbuf,HP_MSG_BUF_LEN,"土地%d状态：土地空闲，可以种植",i);
	else
	{
		memset(cst,0,sizeof(cst));
		switch(tpp.tif[i]-&gt;status)
		{
			case 0:
				m=0;
				snprintf(cst,sizeof(cst),"空闲");
				break;
			case 1:
				m=2;
				snprintf(cst,sizeof(cst),"播种");
				break;
			case 2:
				m=1;
				snprintf(cst,sizeof(cst),"成长");
				break;
			case 3:
				m=0;
				snprintf(cst,sizeof(cst),"成熟");
				break;
			case 4:
				m=0;
				snprintf(cst,sizeof(cst),"收获");
				break;
		};
		j=tpp.tif[i]-&gt;num;
		p1=cst;//无意义，防止为空
		for(k=0;k&lt;HP_SHOP_COUNTS;k++)
		{
			if(tso[k]-&gt;seed_num==j)
			{
				l=tso[k]-&gt;rip_time*m+tpp.tif[i]-&gt;utime;
				l*=5;
				p1=tso[k]-&gt;crop_name;
				break;
			}
		}
		snprintf(tipbuf,HP_MSG_BUF_LEN,"土地%d状态：%s阶段\n作物： %s 成长状态优秀\n收获时间：%d分%d秒",i,cst,p1,l/60,l%60);
	}
	gtk_tooltips_set_tip(tf.ftip[i],tf.ebox[i],tipbuf,NULL);
}//}}}
//{{{ void on_depot_add_item(GtkWidget *widget)
void on_depot_add_item(GtkWidget *widget)
{
	int i,j;
	char *p,*c[3];
	for(i=0;i&lt;3;i++)
	{
		c[i]=malloc(100);
		memset(c[i],0,100);
	}
	GtkListStore *store;
	GtkTreeIter iter;
	store=GTK_LIST_STORE(gtk_tree_view_get_model(GTK_TREE_VIEW(widget)));
	for(i=0;i&lt;HP_SHOP_COUNTS;i++)
	{
		if(tpp.th[i]-&gt;num!=HP_SHOP_COUNTS)
		{
			snprintf(c[0],100,"%d",tpp.th[i]-&gt;counts);
			snprintf(c[1],100,"%d",tpp.th[i]-&gt;price);
			j=tpp.th[i]-&gt;counts*tpp.th[i]-&gt;price;
			snprintf(c[2],100,"%d",j);
			gtk_list_store_append(store,&iter);
			gtk_list_store_set(store,&iter,LIST_NAME,tpp.th[i]-&gt;h_name,LIST_COUNT,c[0],LIST_PRICE,c[1],LIST_TOTAL,c[2],-1);
		}
	}
	for(i=0;i&lt;3;i++)
		free(c[i]);
}//}}}
//{{{ void on_depot_sell_item(GtkWidget *widget,gpointer pt)
void on_depot_sell_item(GtkWidget *widget,gpointer pt)
{
	char *p;
	int i,j,k;
	GtkListStore *store;
	GtkTreeModel *model;
	GtkTreeIter  iter;
	p=NULL;
	model=gtk_tree_view_get_model(GTK_TREE_VIEW(pt));
	store=GTK_LIST_STORE(model);
//如果没有存货：	
	if(gtk_tree_model_get_iter_first(model,&iter)==FALSE)
		return;
	if(gtk_tree_selection_get_selected(GTK_TREE_SELECTION(tf.selection),&model,&iter))
	{
		gtk_tree_model_get(model,&iter,LIST_NAME,&p,-1);//get name
		if(p==NULL || strlen(p)==0)
		{
			g_print("pppp error\n");
			return;
		}
		for(i=0;i&lt;HP_SHOP_COUNTS;i++)
		{//对付h_name为空的情况可以在这里加个判断：
			if(tpp.th[i]-&gt;num==HP_SHOP_COUNTS)
				continue;
			if(memcmp(p,tpp.th[i]-&gt;h_name,strlen(p))==0)
			{
				k=tpp.th[i]-&gt;price*tpp.th[i]-&gt;counts;
				tpp.money+=k;
				memset(tmb.ch,0,HP_MSG_BUF_LEN*3);
				snprintf(tmb.ch,HP_MSG_BUF_LEN*3,"卖出%s,获得金币%d",tpp.th[i]-&gt;h_name,k);
				p=tmb.ch;
				array_str(p,HP_MSG_BUF_LEN*3,0);
				gtk_label_set_markup(GTK_LABEL(tf.label),p);
				tpp.th[i]-&gt;num=HP_SHOP_COUNTS;
				tpp.th[i]-&gt;priv=0;
				tpp.th[i]-&gt;price=0;
				tpp.th[i]-&gt;counts=0;
//注意：这里一定不要将h_name置空，否则将出现memcmp无效的错误。
				tpp.th[i]-&gt;h_name=NULL;
				break;
			}
		}
		//g_free(p);
		gtk_list_store_remove(store,&iter);
	}
}//}}}
//{{{ int exp_calc(int e)
int exp_calc(int e)
{
	unsigned int t;
	unsigned int i;
	t=0;
	for(i=1;i&lt;=tpp.level;i++)
		t+=i;
	t*=1000;
	if(e==0)
		return t;
	tpp.exp+=e;
	if(tpp.exp&gt;=t)
	{
		tpp.level++;
		tpp.exp-=t;
		return 1;
	}
	return 0;
}//}}}
//{{{ void parse_cmd(GtkWidget *widget,gpointer pt);//解析命令
void parse_cmd(GtkWidget *widget,gpointer pt)
{
	char *ch,c[HP_MSG_BUF_LEN];
	char *p;
	int i,j;
	memset(c,0,HP_MSG_BUF_LEN);
	p=(char*)gtk_entry_get_text(GTK_ENTRY(tf.entry));
	i=strlen(p);
	if(i&lt;=1 || i&gt;HP_SHOP_NAME_LEN)
	{
		gtk_entry_set_text(GTK_ENTRY(tf.entry),"");
		return;
	}
	if(p[0]!='/')
	{
		gtk_entry_set_text(GTK_ENTRY(tf.entry),"");
		return;
	}
	if(p[i-1]==0xd||p[i-1]==0xa)
		i-=2;
	else
		i--;
	if((memcmp(&p[1],tcf.cmd_who,i))==0)
	{//显示玩家信息
		memset(tmb.ch,0,HP_MSG_BUF_LEN*3);
		snprintf(c,HP_MSG_BUF_LEN,"等级：%d",tpp.level);
		snprintf(tmb.ch,HP_MSG_BUF_LEN*3,SYSTEM_MSG_STYLE,c);
		array_str(tmb.ch,HP_MSG_BUF_LEN*3,1);
		memset(c,0,HP_MSG_BUF_LEN);
		memset(tmb.ch,0,HP_MSG_BUF_LEN*3);
		snprintf(c,HP_MSG_BUF_LEN,"经验值：%u/%u",tpp.exp,exp_calc(0));
		snprintf(tmb.ch,HP_MSG_BUF_LEN*3,SYSTEM_MSG_STYLE,c);
		p=tmb.ch;
		array_str(tmb.ch,HP_MSG_BUF_LEN*3,1);
		memset(c,0,HP_MSG_BUF_LEN);
		memset(tmb.ch,0,HP_MSG_BUF_LEN*3);
		snprintf(c,HP_MSG_BUF_LEN,"金币：%u",tpp.money);
		snprintf(tmb.ch,HP_MSG_BUF_LEN*3,SYSTEM_MSG_STYLE,c);
		p=tmb.ch;
		array_str(tmb.ch,HP_MSG_BUF_LEN*3,1);
		gtk_label_set_markup(GTK_LABEL(tf.label),p);
	}
	gtk_entry_set_text(GTK_ENTRY(tf.entry),"");
	return;
}//}}}

