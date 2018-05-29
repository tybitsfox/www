#include"f01.h"

<a name=gf001></a>//{{{void crt_window(int a,char** b); 
void crt_window(int a,char** b)
{
	gtk_init(&a,&b);//关于gtk_set_locale(),init函数自动调用了locale函数
//所以无需由用户调用set locale函数了。
	ws.window=gtk_window_new(GTK_WINDOW_TOPLEVEL);//建立新窗口
	gtk_window_set_title(GTK_WINDOW(ws.window),win_title);//设置标题
	gtk_widget_set_size_request(ws.window,win_x,win_y);//设置窗口大小，函数gtk_window_set_default_size也可以设置窗口的初始化大小，但是不能配合gtk_window_set_resizable函数固定窗口大小。
	gtk_window_set_resizable(GTK_WINDOW(ws.window),FALSE);//窗口大小固定
	gtk_window_set_position(GTK_WINDOW(ws.window),GTK_WIN_POS_CENTER);
	gtk_window_set_icon(GTK_WINDOW(ws.window),crt_pixbuf(iconfile));
	ws.vbox=gtk_vbox_new(FALSE,0);//建立纵向排列容器控件
	gtk_container_add(GTK_CONTAINER(ws.window),ws.vbox);//将vbox加入到窗口
	crt_toolbar();//工具栏的建立函数
	ws.fixed=gtk_fixed_new();//建立fixed容器
	gtk_box_pack_start(GTK_BOX(ws.vbox),ws.fixed,FALSE,FALSE,0);//将fixed容器加入vbox容器中
	//如果要加入背景图片，可以调用下列函数，并确保该函数在fixed中第一个调用
	crt_background();
	crt_textview();//文本视图的建立函数
	crt_eventbox();//事件盒的建立
	crt_entry();//编辑框的建立
	crt_statusicon();//托盘图标的建立和应用
	g_signal_connect(G_OBJECT(ws.window),"delete-event",G_CALLBACK(hide_window),ws.sicon);//启动了托盘后禁止关闭按钮的退出，改为隐藏窗口，并显示托盘图标。
	crt_mapevent();//地图事件盒的建立函数
	gtk_widget_show_all(ws.window);
//	g_signal_connect_swapped(G_OBJECT(ws.window),"destroy",G_CALLBACK(gtk_main_quit),NULL);
	gtk_main();
}//}}}
<a name=gf003></a>//{{{void crt_toolbar();
void crt_toolbar()
{
	GtkWidget *img,*pixbuf;
	ws.toolbar=gtk_toolbar_new();
	gtk_toolbar_set_style(GTK_TOOLBAR(ws.toolbar),GTK_TOOLBAR_ICONS);
	gtk_toolbar_set_tooltips(GTK_TOOLBAR(ws.toolbar),TRUE);
	img=gtk_image_new_from_pixbuf(crt_pixbuf(ticon1));
	ws.bnt[0]=gtk_tool_button_new(img,"");
	gtk_toolbar_insert(GTK_TOOLBAR(ws.toolbar),ws.bnt[0],-1);
	img=gtk_image_new_from_pixbuf(crt_pixbuf(ticon2));
	ws.bnt[1]=gtk_tool_button_new(img,"");
	gtk_toolbar_insert(GTK_TOOLBAR(ws.toolbar),ws.bnt[1],-1);
	img=gtk_image_new_from_pixbuf(crt_pixbuf(ticon3));
	ws.bnt[2]=gtk_tool_button_new(img,"");
	gtk_toolbar_insert(GTK_TOOLBAR(ws.toolbar),ws.bnt[2],-1);
	img=gtk_image_new_from_pixbuf(crt_pixbuf(ticon4));
	ws.bnt[3]=gtk_tool_button_new(img,"");
	gtk_toolbar_insert(GTK_TOOLBAR(ws.toolbar),ws.bnt[3],-1);
	img=gtk_image_new_from_pixbuf(crt_pixbuf(ticon5));
	ws.bnt[4]=gtk_tool_button_new(img,"");
	gtk_toolbar_insert(GTK_TOOLBAR(ws.toolbar),ws.bnt[4],-1);
	gtk_box_pack_start(GTK_BOX(ws.vbox),ws.toolbar,FALSE,FALSE,0);
	//开始建立tooltips
	crt_tooltips(GTK_WIDGET(ws.bnt[0]),GTK_WIDGET(ws.tips[0]),tmsg0);
	crt_tooltips(GTK_WIDGET(ws.bnt[1]),GTK_WIDGET(ws.tips[1]),tmsg1);
	crt_tooltips(GTK_WIDGET(ws.bnt[2]),GTK_WIDGET(ws.tips[2]),tmsg2);
	crt_tooltips(GTK_WIDGET(ws.bnt[3]),GTK_WIDGET(ws.tips[3]),tmsg3);
	crt_tooltips(GTK_WIDGET(ws.bnt[4]),GTK_WIDGET(ws.tips[4]),tmsg4);
	g_signal_connect(G_OBJECT(ws.bnt[0]),"clicked",G_CALLBACK(on_bnt0),NULL);
	g_signal_connect(G_OBJECT(ws.bnt[1]),"clicked",G_CALLBACK(on_bnt1),NULL);
	g_signal_connect(G_OBJECT(ws.bnt[2]),"clicked",G_CALLBACK(on_bnt2),NULL);
	g_signal_connect(G_OBJECT(ws.bnt[3]),"clicked",G_CALLBACK(on_bnt3),NULL);
	g_signal_connect(G_OBJECT(ws.bnt[4]),"clicked",G_CALLBACK(on_bnt4),NULL);

}//}}}
<a name=gf004></a>//{{{void crt_tooltips(GtkWidget *widget,GtkWidget *tips,gpointer gp)
void crt_tooltips(GtkWidget *widget,GtkWidget *tips,gpointer gp)
{
	tips=(GtkWidget *)gtk_tooltips_new();
	gtk_tooltips_enable(GTK_TOOLTIPS(tips));
	gtk_tooltips_set_tip(GTK_TOOLTIPS(tips),widget,(gchar*)gp,"");	
}//}}}
<a name=gf002></a>//{{{GdkPixbuf *crt_pixbuf(gchar *filename);
GdkPixbuf *crt_pixbuf(gchar *filename)
{
	GdkPixbuf *pix;
	GError	  *error=NULL;
	pix=gdk_pixbuf_new_from_file(filename,&error);
	if(!pix)
	{
		g_print("%s\n",error-&gt;message);
		g_error_free(error);
	}
	return pix;
}//}}}
<a name=gf005></a>//{{{ void crt_textview()
void crt_textview()
{
	ws.textview=gtk_text_view_new();//建立新的文本视图控件
	gtk_widget_set_size_request(ws.textview,tv_x,tv_y);//设置文本视图的大小
	ws.buffer=gtk_text_view_get_buffer(GTK_TEXT_VIEW(ws.textview));//取得文本视图的缓冲
//设置不同的显示样式:
	gtk_text_buffer_create_tag(ws.buffer,tag_pal,"pixels_above_lines",30,NULL);//文字上方30像素的空余
	gtk_text_buffer_create_tag(ws.buffer,tag_lmarg,"left_margin",5,NULL);//文字左方空5像素
	gtk_text_buffer_create_tag(ws.buffer,tag_pbl,"pixels_below_lines",30,NULL);//文字下方30像素的空余
	gtk_text_buffer_create_tag(ws.buffer,tag_red_fg,"foreground","red",NULL);//文字前景色为红色
	gtk_text_buffer_create_tag(ws.buffer,tag_blue_fg,"foreground","blue",NULL);//文字前景色为蓝色
	gtk_text_buffer_create_tag(ws.buffer,tag_gray_bg,"background","gray",NULL);//文字背景色为灰色
	gtk_text_buffer_create_tag(ws.buffer,tag_undline,"underline",PANGO_UNDERLINE_SINGLE,NULL);//带下划线
    gtk_text_buffer_create_tag(ws.buffer,tag_bold,"weight",PANGO_WEIGHT_BOLD,NULL);//粗体
    gtk_text_buffer_create_tag(ws.buffer,tag_italic,"style",PANGO_STYLE_ITALIC,NULL);//斜体
    gtk_text_buffer_create_tag(ws.buffer,tag_strike,"strikethrough",TRUE,NULL);//中划线
    gtk_text_buffer_create_tag(ws.buffer,tag_quarter,"scale",(double)0.25,NULL);//1/4大小字号
    gtk_text_buffer_create_tag(ws.buffer,tag_des,"scale",PANGO_SCALE_XX_SMALL,NULL);//特小小
    gtk_text_buffer_create_tag(ws.buffer,tag_es,"scale",PANGO_SCALE_X_SMALL,NULL);//特小
    gtk_text_buffer_create_tag(ws.buffer,tag_small,"scale",PANGO_SCALE_SMALL,NULL);//小
    gtk_text_buffer_create_tag(ws.buffer,tag_med,"scale",PANGO_SCALE_MEDIUM,NULL);//正常字号
	gtk_text_buffer_create_tag(ws.buffer,tag_large,"scale",PANGO_SCALE_LARGE,NULL);//大字体
	gtk_text_buffer_create_tag(ws.buffer,tag_elrg,"scale",PANGO_SCALE_X_LARGE,NULL);//超大字体
	gtk_text_buffer_create_tag(ws.buffer,tag_delrg,"scale",PANGO_SCALE_XX_LARGE,NULL);//超超大字体
	gtk_text_buffer_create_tag(ws.buffer,tag_dsz,"scale",(double)2.0,NULL);//2倍字体
//测试字体的设置：
	gtk_text_buffer_create_tag(ws.buffer,tag_kaiti,"font","楷体_GB2312",NULL);//楷体
	gtk_text_buffer_create_tag(ws.buffer,tag_yahei,"font","YaHei Consolas Hybrid",NULL);//雅黒
	gtk_text_buffer_create_tag(ws.buffer,tag_fsong,"font","FangSong_GB2312",NULL);//仿宋
	gtk_text_buffer_create_tag(ws.buffer,tag_simsong,"font","SimSun",NULL);//宋体
	gtk_text_buffer_get_iter_at_offset(ws.buffer,&ws.iter,0);//取得位置偏移
	gtk_text_buffer_insert(ws.buffer,&ws.iter,"this is a test,这是一个测试\n",-1);//正常的文字插入
	gtk_text_buffer_insert_with_tags_by_name(ws.buffer,&ws.iter,"this is a test,这是一个测试\n",-1,tag_red_fg,tag_strike,tag_italic,NULL);//带显示式样的文字插入
	gtk_text_buffer_insert_with_tags_by_name(ws.buffer,&ws.iter,"this is a test,这是一个测试\n",-1,tag_pbl,tag_dsz,NULL);
	gtk_text_buffer_insert_with_tags_by_name(ws.buffer,&ws.iter,"this is a test,这是一个测试\n",-1,tag_italic,tag_elrg,tag_undline,NULL);
	gtk_text_buffer_insert_with_tags_by_name(ws.buffer,&ws.iter,"this is a test,这是一个测试\n",-1,tag_bold,tag_dsz,tag_gray_bg,tag_blue_fg,NULL);
	gtk_text_buffer_insert_pixbuf(ws.buffer,&ws.iter,crt_pixbuf(insert_pix));//图片的插入
	gtk_text_buffer_insert_with_tags_by_name(ws.buffer,&ws.iter,"this is a test,这是一个测试\n",-1,tag_kaiti,tag_elrg,tag_blue_fg,NULL);
	gtk_text_buffer_insert_with_tags_by_name(ws.buffer,&ws.iter,"this is a test,这是一个测试\n",-1,tag_yahei,tag_dsz,tag_undline,NULL);
	gtk_text_view_set_editable(GTK_TEXT_VIEW(ws.textview),FALSE);//设置文本视图为不可编辑
	gtk_fixed_put(GTK_FIXED(ws.fixed),ws.textview,vpos_x,vpos_y);
}//}}}
<a name=gf006></a>//{{{ void crt_background()
void crt_background()
{
	GtkWidget *img;
	img=gtk_image_new_from_file(back_img);
	gtk_widget_set_size_request(img,wbk_x,wbk_y);
	gtk_fixed_put(GTK_FIXED(ws.fixed),img,1,1);
}//}}}
<a name=gf007></a>//{{{ void crt_eventbox()
void crt_eventbox()
{
	GtkWidget *img,*tips;
	ws.event_box[0]=gtk_event_box_new();
	gtk_event_box_set_visible_window(GTK_EVENT_BOX(ws.event_box[0]),FALSE);//该设置可使包含的图片透明色显示窗口的背景色
	gtk_widget_set_events(ws.event_box[0],GDK_BUTTON_PRESS);//支持tooltips的显示
	img=gtk_image_new_from_pixbuf(crt_pixbuf(enty_img));
	gtk_container_add(GTK_CONTAINER(ws.event_box[0]),img);//在事件盒中加入图片
	crt_tooltips(ws.event_box[0],tips,"编辑栏的隐藏和显示\ntoggle button");//建立tooltips
	gtk_fixed_put(GTK_FIXED(ws.fixed),ws.event_box[0],5,470);//放置fixed容器中
	g_signal_connect(G_OBJECT(ws.event_box[0]),"button_press_event",G_CALLBACK(disp_entry),NULL);
}//}}}
<a name=gf008></a>//{{{ void crt_entry()
void crt_entry()
{
	ws.entry=gtk_entry_new();//建立编辑框
	gtk_entry_set_max_length(GTK_ENTRY(ws.entry),60);//设置编辑框的最大字符长度
	gtk_widget_set_size_request(ws.entry,610,25);//设置编辑框的尺寸大小
	gtk_fixed_put(GTK_FIXED(ws.fixed),ws.entry,50,470);//放入fixed容器
	sv.show_entry=1;//默认开始时编辑框可见
}//}}}
<a name=gf009></a>//{{{ void crt_statusicon();
void crt_statusicon()
{
	ws.sicon=gtk_status_icon_new_from_file(iconfile);//建立托盘图标
	ws.menu=gtk_menu_new();//建立托盘菜单
	ws.menu_restore=gtk_menu_item_new_with_label("恢复窗口");//建立菜单项
	ws.menu_set=gtk_menu_item_new_with_label("系统设置");
	ws.menu_exit=gtk_menu_item_new_with_label("退    出");
	gtk_menu_shell_append(GTK_MENU_SHELL(ws.menu),ws.menu_restore);//加入菜单项
	gtk_menu_shell_append(GTK_MENU_SHELL(ws.menu),ws.menu_set);
	gtk_menu_shell_append(GTK_MENU_SHELL(ws.menu),ws.menu_exit);
	g_signal_connect(G_OBJECT(ws.menu_restore),"activate",G_CALLBACK(restore_window),NULL);//菜单项的响应函数
	g_signal_connect(G_OBJECT(ws.menu_set),"activate",G_CALLBACK(set_window),NULL);
	g_signal_connect(G_OBJECT(ws.menu_exit),"activate",G_CALLBACK(exit_window),NULL);
	gtk_widget_show_all(ws.menu);
	gtk_status_icon_set_tooltip(ws.sicon,tip_statusicon);//设置托盘图标的tooltips
	g_signal_connect(GTK_STATUS_ICON(ws.sicon),"activate",GTK_SIGNAL_FUNC(restore_window),ws.window);//设置托盘图标单击时的响应函数
	g_signal_connect(GTK_STATUS_ICON(ws.sicon),"popup_menu",GTK_SIGNAL_FUNC(show_menu),ws.menu);//设置托盘图标右键点击时的响应函数
	gtk_status_icon_set_visible(ws.sicon,FALSE);//设置托盘图标在窗口显示时为不可见
}//}}}
<a name=gf016></a>//{{{ gint hide_window(GtkWidget *widget,GdkEvent *event,gpointer gp)
gint hide_window(GtkWidget *widget,GdkEvent *event,gpointer gp)
{
	gtk_widget_hide(ws.window);
	gtk_status_icon_set_visible(ws.sicon,TRUE);
	return TRUE;
}//}}}
<a name=gf012></a>//{{{ void restore_window(GtkWidget *widget,gpointer gp)
void restore_window(GtkWidget *widget,gpointer gp)
{
	gtk_widget_show(ws.window);
	gtk_window_deiconify(GTK_WINDOW(ws.window));
	gtk_status_icon_set_visible(ws.sicon,FALSE);
}//}}}
<a name=gf013></a>//{{{ void set_window(GtkWidget *widget,gpointer gp)
void set_window(GtkWidget *widget,gpointer gp)
{
	char ch[512];
	GtkWidget *dlg,*fixed,*label,*img;
	dlg=gtk_dialog_new();
	gtk_window_set_title(GTK_WINDOW(dlg),"系统设置");
	gtk_window_set_position(GTK_WINDOW(dlg),GTK_WIN_POS_CENTER);
	gtk_widget_set_size_request(dlg,350,200);
	gtk_window_set_resizable(GTK_WINDOW(dlg),FALSE);
	fixed=gtk_fixed_new();
	gtk_box_pack_start(GTK_BOX(GTK_DIALOG(dlg)-&gt;vbox),fixed,FALSE,FALSE,0);
	gtk_container_set_border_width(GTK_CONTAINER(dlg),2);
	img=gtk_image_new_from_file(set_dlg_pix);
	gtk_widget_set_size_request(img,96,96);
	gtk_fixed_put(GTK_FIXED(fixed),img,5,5);
	label=gtk_label_new("");
	memset(ch,0,sizeof(ch));
	snprintf(ch,sizeof(ch),"&lt;span style=\"italic\" face=\"YaHei Consolas Hybrid\" font=\"20\" color=\"#ff00ff\"&gt;系统设置界面&lt;/span&gt;");
	gtk_label_set_markup(GTK_LABEL(label),ch);
	gtk_widget_set_size_request(label,200,30);
	gtk_fixed_put(GTK_FIXED(fixed),label,110,40);
	gtk_widget_show_all(dlg);
	gtk_dialog_run(GTK_DIALOG(dlg));
	gtk_widget_destroy(dlg);
}//}}}
<a name=gf014></a>//{{{ void exit_window(GtkWidget *widget,gpointer gp)
void exit_window(GtkWidget *widget,gpointer gp)
{
	gtk_main_quit();
}//}}}
<a name=gf015></a>//{{{ void show_menu(GtkWidget *widget,gint button,guint32 activate_time,gpointer gp)
void show_menu(GtkWidget *widget,guint button,guint32 activate_time,gpointer gp)
{
	gtk_menu_popup(GTK_MENU(ws.menu),NULL,NULL,gtk_status_icon_position_menu,widget,button,activate_time);
}//}}}
<a name=gf010></a>//{{{ void crt_mapevent()
void crt_mapevent()
{
	GtkWidget *img,*tips;
	ws.event_box[1]=gtk_event_box_new();
	gtk_event_box_set_visible_window(GTK_EVENT_BOX(ws.event_box[1]),FALSE);
	gtk_widget_set_events(ws.event_box[1],GDK_BUTTON_PRESS);
	img=gtk_image_new_from_file(sml_map);
	gtk_widget_set_size_request(img,112,120);
	crt_tooltips(ws.event_box[1],tips,"当前场景缩略图\na small map of current position");
	gtk_container_add(GTK_CONTAINER(ws.event_box[1]),img);
	gtk_fixed_put(GTK_FIXED(ws.fixed),ws.event_box[1],675,5);
}///}}}

<a name=gf011></a>//{{{gint disp_entry(GtkWidget *widget,GdkEvent *event,gpointer gp);
gint disp_entry(GtkWidget *widget,GdkEvent *event,gpointer gp)
{
	if(sv.show_entry==1)
	{
		gtk_widget_hide(ws.entry);
		sv.show_entry=0;
	}
	else
	{
		gtk_widget_show(ws.entry);
		sv.show_entry=1;
	}
}//}}}
<a name=gf017></a>//{{{ void on_bnt0(GtkWidget *widget,gpointer gp)
void on_bnt0(GtkWidget *widget,gpointer gp)
{
	char ch[512];
	GtkWidget *dlg,*label,*fixed,*img;
	dlg=gtk_dialog_new();
	gtk_window_set_title(GTK_WINDOW(dlg),"基本信息设置");
	gtk_widget_set_size_request(dlg,480,320);
	gtk_window_set_position(GTK_WINDOW(dlg),GTK_WIN_POS_CENTER);
	fixed=gtk_fixed_new();
	gtk_box_pack_start(GTK_BOX(GTK_DIALOG(dlg)-&gt;vbox),fixed,FALSE,FALSE,0);
	img=gtk_image_new_from_file(set_dlg_pix);
	gtk_widget_set_size_request(img,96,96);
	gtk_fixed_put(GTK_FIXED(fixed),img,20,100);
	label=gtk_label_new("");
	memset(ch,0,sizeof(ch));
	snprintf(ch,sizeof(ch),"&lt;span face='YaHei Consolas Hybrid' color='red'&gt;这是系统设置界面&lt;/span&gt;");
	gtk_label_set_markup(GTK_LABEL(label),ch);
	//gtk_label_set_text();
	gtk_widget_set_size_request(label,250,30);
	gtk_fixed_put(GTK_FIXED(fixed),label,120,140);
	gtk_widget_show_all(dlg);
	gtk_dialog_run(GTK_DIALOG(dlg));
	gtk_widget_destroy(dlg);
}//}}}
<a name=gf018></a>//{{{ void on_bnt1(GtkWidget *widget,gpointer gp);
void on_bnt1(GtkWidget *widget,gpointer gp)
{
	GtkWidget *dlg,*fixed,*label,*img;
	char ch[512];
	memset(ch,0,sizeof(ch));
	snprintf(ch,sizeof(ch),"&lt;span style=\"oblique\" color=\"#660066\" font=\"16\"&gt;电子公告栏设置界面&lt;/span&gt;");
	dlg=gtk_dialog_new();
	gtk_window_set_title(GTK_WINDOW(dlg),"电子公告栏设置");
	gtk_widget_set_size_request(dlg,480,320);
	gtk_window_set_position(GTK_WINDOW(dlg),GTK_WIN_POS_CENTER);
	gtk_window_set_resizable(GTK_WINDOW(dlg),FALSE);
	fixed=gtk_fixed_new();
	gtk_box_pack_start(GTK_BOX(GTK_DIALOG(dlg)-&gt;vbox),fixed,FALSE,FALSE,0);
	img=gtk_image_new_from_file(set_dlg_pix);
	gtk_widget_set_size_request(img,96,96);
	gtk_fixed_put(GTK_FIXED(fixed),img,22,100);
	label=gtk_label_new("");
	gtk_widget_set_size_request(label,250,30);
	gtk_label_set_markup(GTK_LABEL(label),ch);
	gtk_fixed_put(GTK_FIXED(fixed),label,120,140);
	gtk_widget_show_all(dlg);
	gtk_dialog_run(GTK_DIALOG(dlg));
	gtk_widget_destroy(dlg);
}//}}}
<a name=gf019></a>//{{{ void on_bnt2(GtkWidget *widget,gpointer gp)
void on_bnt2(GtkWidget *widget,gpointer gp)
{
	char ch[512];
	GtkWidget *dlg,*fixed,*label,*img;
	dlg=gtk_dialog_new();
	gtk_window_set_title(GTK_WINDOW(dlg),"bot操作设置");
	gtk_widget_set_size_request(dlg,480,320);
	gtk_window_set_resizable(GTK_WINDOW(dlg),FALSE);
	gtk_window_set_position(GTK_WINDOW(dlg),GTK_WIN_POS_CENTER);
	fixed=gtk_fixed_new();
	gtk_box_pack_start(GTK_BOX(GTK_DIALOG(dlg)-&gt;vbox),fixed,FALSE,FALSE,0);
	img=gtk_image_new_from_file(set_dlg_pix);
	gtk_widget_set_size_request(img,96,96);
	gtk_fixed_put(GTK_FIXED(fixed),img,20,100);
	label=gtk_label_new("");
	memset(ch,0,sizeof(ch));
	snprintf(ch,sizeof(ch),"&lt;span style=\"italic\" color=\"#ff0000\"&gt;bot操作界面&lt;/span&gt;");
	gtk_label_set_markup(GTK_LABEL(label),ch);
	gtk_widget_set_size_request(label,250,30);
	gtk_fixed_put(GTK_FIXED(fixed),label,120,140);
	gtk_widget_show_all(dlg);
	gtk_dialog_run(GTK_DIALOG(dlg));
	gtk_widget_destroy(dlg);
}//}}}
<a name=gf020></a>//{{{ void on_bnt3(GtkWidget *widget,gpointer gp)
void on_bnt3(GtkWidget *widget,gpointer gp)
{
	char ch[512];
	GtkWidget *dlg,*fixed,*label,*img;
	dlg=gtk_dialog_new();
	gtk_window_set_title(GTK_WINDOW(dlg),"服务器设置");
	gtk_window_set_position(GTK_WINDOW(dlg),GTK_WIN_POS_CENTER);
	gtk_widget_set_size_request(dlg,480,320);
	gtk_window_set_resizable(GTK_WINDOW(dlg),FALSE);
	fixed=gtk_fixed_new();
	gtk_box_pack_start(GTK_BOX(GTK_DIALOG(dlg)-&gt;vbox),fixed,FALSE,FALSE,0);
	img=gtk_image_new_from_file(set_dlg_pix);
	gtk_widget_set_size_request(img,96,96);
	gtk_fixed_put(GTK_FIXED(fixed),img,20,100);
	label=gtk_label_new("");
	memset(ch,0,sizeof(ch));
	snprintf(ch,sizeof(ch),"&lt;span style=\"normal\" font=\"15\" color=\"green\"&gt;服务器设置&lt;/span&gt;");
	gtk_widget_set_size_request(label,250,30);
	gtk_label_set_markup(GTK_LABEL(label),ch);
	gtk_fixed_put(GTK_FIXED(fixed),label,120,140);
	gtk_widget_show_all(dlg);
	gtk_dialog_run(GTK_DIALOG(dlg));
	gtk_widget_destroy(dlg);
}//}}}
<a name=gf021></a>//{{{ void on_bnt4(GtkWidget *widget,gpointer gp)
void on_bnt4(GtkWidget *widget,gpointer gp)
{
	GtkWidget *dlg,*fixed,*label,*img;
	char ch[512];
	memset(ch,0,sizeof(ch));
	snprintf(ch,sizeof(ch),"&lt;span style=\"italic\" color=\"red\" font=\"20\"&gt;mud游戏界面设置&lt;/span&gt;");
	dlg=gtk_dialog_new();
	gtk_window_set_title(GTK_WINDOW(dlg),"mud界面设置");
	gtk_window_set_position(GTK_WINDOW(dlg),GTK_WIN_POS_CENTER);
	gtk_widget_set_size_request(dlg,480,320);
	gtk_window_set_resizable(GTK_WINDOW(dlg),FALSE);
	fixed=gtk_fixed_new();
	gtk_box_pack_start(GTK_BOX(GTK_DIALOG(dlg)-&gt;vbox),fixed,FALSE,FALSE,0);
	img=gtk_image_new_from_file(set_dlg_pix);
	gtk_widget_set_size_request(img,96,96);
	gtk_fixed_put(GTK_FIXED(fixed),img,20,100);
	label=gtk_label_new("");
	gtk_label_set_markup(GTK_LABEL(label),ch);
	gtk_widget_set_size_request(label,250,30);
	gtk_fixed_put(GTK_FIXED(fixed),label,120,140);
	gtk_widget_show_all(dlg);
	gtk_dialog_run(GTK_DIALOG(dlg));
	gtk_widget_destroy(dlg);
}//}}}














