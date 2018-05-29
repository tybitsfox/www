#include"../clsscr.h"
#ifndef HAPPY_FARM_OWN
#include"../hpfarm/stddef.h"
#endif
#include"./accsrc.h"
#define SAVE_FILE	"./farm.sav"
//注意：该值在以后由玩家修改时，应判断不超过32
#define USER_NAME	"农场玩家"
//{{{void empty_rc()
void empty_rc()
{
	int i;
	trc.initflag=0;
	trc.fmainicon=NULL;
	trc.fstatusicon=NULL;
	trc.backimg=NULL;
	trc.cmdicon=NULL;
	trc.fcursor1=NULL;
	trc.typhoonimg=NULL;
	trc.epmimg=NULL;
	trc.cstimg=NULL;
	for(i=0;i&lt;8;i++)
		trc.fnm[i]=NULL;
	for(i=0;i&lt;5;i++)
		trc.fland[i]=NULL;
	for(i=0;i&lt;4;i++)
		trc.fstat[i]=NULL;
//2011-1-16 add:
	tcf.cmd_who=NULL;
	tcf.cmd_field=NULL;
	tcf.cmd_run=NULL;
//2011-1-2添加：
	trc.cmdicon=NULL;
	trc.fcursor1=NULL;
//2010-12-29添加：
	tmb.cc1=NULL;
	tmb.cc2=NULL;
	tmb.cc3=NULL;
	tmb.ch=NULL;//只需对上述4个指针置空，因为只对他们进行实际的内存分配
	tmb.flag_1=0;
	tmb.fface=NULL;
	tmb.fcolor=NULL;
	tmb.fsize=NULL;
//2011-1-2添加
	for(i=0;i&lt;8;i++)
	{
		tts[i].ifseeding=0;
		tts[i].ripening_time=0;
		tts[i].time_left=0;
		tts[i].crop_num=0;
	}
	for(i=0;i&lt;HP_SHOP_COUNTS;i++)
	{
		tso[i]=NULL;
	}
	for(i=0;i&lt;HP_SHOP_COUNTS;i++)
	{
		tpp.th[i]=NULL;
	}
	for(i=0;i&lt;8;i++)
		tpp.tif[i]=NULL;
	tpp.name=NULL;
	tipbuf=NULL;
}//}}}
//{{{ get_rc()
int get_rc()
{
	FILE *file;
	int i,j,k;
	char *c,*p,ch[2048],c1[20];
	if(trc.initflag!=0)
		return 0;//err flag is zero
	if((trc.fmainicon=malloc(HP_BLOCK_SIZE))==NULL)
		return 0;
	if((trc.fstatusicon=malloc(HP_BLOCK_SIZE))==NULL)
		return 0;
	if((trc.backimg=malloc(HP_BLOCK_SIZE))==NULL)
		return 0;
	for(i=0;i&lt;8;i++)
		if((trc.fnm[i]=malloc(HP_BLOCK_SIZE))==NULL)
			return 0;
	for(i=0;i&lt;5;i++)
		if((trc.fland[i]=malloc(HP_BLOCK_SIZE))==NULL)
			return 0;
	for(i=0;i&lt;4;i++)
		if((trc.fstat[i]=malloc(HP_BLOCK_SIZE))==NULL)
			return 0;
	if((trc.cmdicon=malloc(HP_BLOCK_SIZE))==NULL)
		return 0;
	if((trc.fcursor1=malloc(HP_BLOCK_SIZE))==NULL)
		return 0;
	if((trc.typhoonimg=malloc(HP_BLOCK_SIZE))==NULL)
		return 0;
	if((trc.epmimg=malloc(HP_BLOCK_SIZE))==NULL)
		return 0;
	if((trc.cstimg=malloc(HP_BLOCK_SIZE))==NULL)
		return 0;
	if(alloc_msg_buf()==0)
		return 0;
//2011-1-16 add:
	if((tcf.cmd_who=malloc(HP_SHOP_NAME_LEN))==NULL)
		return 0;
	if((tcf.cmd_field=malloc(HP_SHOP_NAME_LEN))==NULL)
		return 0;
	if((tcf.cmd_run=malloc(HP_SHOP_NAME_LEN))==NULL)
		return 0;
//现在开始读取默认配置文件:./rc.conf
	file=fopen("./rc.conf","r");
	if(file==NULL)
	{
		return 0;
	}
	memset(tcf.cmd_run,0,HP_SHOP_NAME_LEN);
	memset(tcf.cmd_field,0,HP_SHOP_NAME_LEN);
	memset(tcf.cmd_who,0,HP_SHOP_NAME_LEN);
	memset(ch,0,sizeof(ch));
	while(fgets(ch,sizeof(ch),file)!=NULL)
	{
		if(ch[0]=='#' || ch[0]=='\n')
		{
			memset(ch,0,sizeof(ch));
			continue;//注释
		}
		p=ch;
		c=strchr(ch,':');
		if(c==NULL)
		{
			fclose(file);
			return 0;
		}
		i=(int)(c-p);
		memset(c1,0,sizeof(c1));
		memcpy(c1,p,i);
		c++;
		j=strlen(ch);
		j=j-i-2;
		if(j&gt;1024)//文件名长限制在1024
		{
			fclose(file);
			printf("filename is too long\n");
			return 0;
		}
		if(memcmp(c1,HP_MAIN_ICON,strlen(c1))==0)
		{//主程序图标
			memset(trc.fmainicon,0,HP_BLOCK_SIZE);
			memcpy(trc.fmainicon,c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_STATUS_ICON,strlen(c1))==0)
		{//托盘图标
			memset(trc.fstatusicon,0,HP_BLOCK_SIZE);
			memcpy(trc.fstatusicon,c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_BACK_IMG,strlen(c1))==0)
		{//背景图片
			memset(trc.backimg,0,HP_BLOCK_SIZE);
			memcpy(trc.backimg,c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_FNM0,strlen(c1))==0)
		{//工具栏按钮图片1
			memset(trc.fnm[0],0,HP_BLOCK_SIZE);
			memcpy(trc.fnm[0],c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_FNM1,strlen(c1))==0)
		{//工具栏按钮图片2
			memset(trc.fnm[1],0,HP_BLOCK_SIZE);
			memcpy(trc.fnm[1],c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_FNM2,strlen(c1))==0)
		{//工具栏按钮图片3
			memset(trc.fnm[2],0,HP_BLOCK_SIZE);
			memcpy(trc.fnm[2],c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_FNM3,strlen(c1))==0)
		{//工具栏按钮图片4
			memset(trc.fnm[3],0,HP_BLOCK_SIZE);
			memcpy(trc.fnm[3],c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_FNM4,strlen(c1))==0)
		{//工具栏按钮图片5
			memset(trc.fnm[4],0,HP_BLOCK_SIZE);
			memcpy(trc.fnm[4],c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_FNM5,strlen(c1))==0)
		{//工具栏按钮图片6
			memset(trc.fnm[5],0,HP_BLOCK_SIZE);
			memcpy(trc.fnm[5],c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_FNM6,strlen(c1))==0)
		{//工具栏按钮图片7
			memset(trc.fnm[6],0,HP_BLOCK_SIZE);
			memcpy(trc.fnm[6],c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_FNM7,strlen(c1))==0)
		{//工具栏按钮图片8
			memset(trc.fnm[7],0,HP_BLOCK_SIZE);
			memcpy(trc.fnm[7],c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_FLAND0,strlen(c1))==0)
		{//土地的状态图片0
			memset(trc.fland[0],0,HP_BLOCK_SIZE);
			memcpy(trc.fland[0],c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_FLAND1,strlen(c1))==0)
		{//土地的状态图片1
			memset(trc.fland[1],0,HP_BLOCK_SIZE);
			memcpy(trc.fland[1],c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_FLAND2,strlen(c1))==0)
		{//土地的状态图片2
			memset(trc.fland[2],0,HP_BLOCK_SIZE);
			memcpy(trc.fland[2],c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_FLAND3,strlen(c1))==0)
		{//土地的状态图片3
			memset(trc.fland[3],0,HP_BLOCK_SIZE);
			memcpy(trc.fland[3],c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_FLAND4,strlen(c1))==0)
		{//土地的状态图片4
			memset(trc.fland[4],0,HP_BLOCK_SIZE);
			memcpy(trc.fland[4],c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_FSTAT0,strlen(c1))==0)
		{//作物的4种状态图0
			memset(trc.fstat[0],0,HP_BLOCK_SIZE);
			memcpy(trc.fstat[0],c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_FSTAT1,strlen(c1))==0)
		{//作物的4种状态图1
			memset(trc.fstat[1],0,HP_BLOCK_SIZE);
			memcpy(trc.fstat[1],c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_FSTAT2,strlen(c1))==0)
		{//作物的4种状态图2
			memset(trc.fstat[2],0,HP_BLOCK_SIZE);
			memcpy(trc.fstat[2],c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_FSTAT3,strlen(c1))==0)
		{//作物的4种状态图3
			memset(trc.fstat[3],0,HP_BLOCK_SIZE);
			memcpy(trc.fstat[3],c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_EDIT_ICON1,strlen(c1))==0)
		{//命令行控制图标
			memset(trc.cmdicon,0,HP_BLOCK_SIZE);
			memcpy(trc.cmdicon,c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_FIELD_CURSOR1,strlen(c1))==0)
		{//进入土地的光标图片资源
			memset(trc.fcursor1,0,HP_BLOCK_SIZE);
			memcpy(trc.fcursor1,c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_TYPHOON,strlen(c1))==0)
		{//工具栏农场对话框的图片资源
			memset(trc.typhoonimg,0,HP_BLOCK_SIZE);
			memcpy(trc.typhoonimg,c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_8PM,strlen(c1))==0)
		{//工具栏牧场对话框的图片资源
			memset(trc.epmimg,0,HP_BLOCK_SIZE);
			memcpy(trc.epmimg,c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_CST,strlen(c1))==0)
		{//工具栏加工厂对话框的图片资源
			memset(trc.cstimg,0,HP_BLOCK_SIZE);
			memcpy(trc.cstimg,c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_FONT_FACE,strlen(c1))==0)
		{//字体名称
			memset(tmb.fface,0,HP_MSG_BUF_LEN);
			if(j&gt;=HP_MSG_BUF_LEN)
			{
				fclose(file);
				printf("font face error!\n");
				return 0;
			}
			memcpy(tmb.fface,c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_FONT_COLOR,strlen(c1))==0)
		{//字体颜色
			memset(tmb.fcolor,0,HP_MSG_BUF_LEN);
			if(j&gt;=HP_MSG_BUF_LEN)
			{
				fclose(file);
				printf("font color error!\n");
				return 0;
			}
			memcpy(tmb.fcolor,c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(memcmp(c1,HP_FONT_SIZE,strlen(c1))==0)
		{//字体大小
			memset(tmb.fsize,0,HP_MSG_BUF_LEN);
			if(j&gt;=HP_MSG_BUF_LEN)
			{
				fclose(file);
				printf("font size error!\n");
				return 0;
			}
			memcpy(tmb.fsize,c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
//2011-1-16 add:
		if((memcmp(c1,CMD_WHO,strlen(c1)))==0)
		{//查询玩家资料的命令别名：
			if(j&gt;HP_SHOP_NAME_LEN)
			{
				fclose(file);
				printf("alias cmd1 err\n");
				return 0;
			}
			memcpy(tcf.cmd_who,c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if((memcmp(c1,CMD_WHO,strlen(c1)))==0)
		{//查询土地资料的命令别名：
			if(j&gt;HP_SHOP_NAME_LEN)
			{
				fclose(file);
				printf("alias cmd1 err\n");
				return 0;
			}
			memcpy(tcf.cmd_field,c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		if((memcmp(c1,CMD_WHO,strlen(c1)))==0)
		{//查询自动运行的命令别名：
			if(j&gt;HP_SHOP_NAME_LEN)
			{
				fclose(file);
				printf("alias cmd1 err\n");
				return 0;
			}
			memcpy(tcf.cmd_run,c,j);
			memset(ch,0,sizeof(ch));
			continue;
		}
		memset(ch,0,sizeof(ch));
	}
	fclose(file);
	if(seed_rc()!=1)
		return 0;
	if(harvest_rc()!=1)
		return 0;
	if((tipbuf=malloc(HP_MSG_BUF_LEN))==NULL)
			return 0;
	memset(tipbuf,0,HP_MSG_BUF_LEN);
	return 1;//success..
}//}}}
//{{{ void free_rc()
void free_rc()
{
	int i;
	if(trc.fmainicon!=NULL)
		free(trc.fmainicon);
	if(trc.fstatusicon!=NULL)
		free(trc.fstatusicon);
	for(i=0;i&lt;8;i++)
		if(trc.fnm[i]!=NULL)
			free(trc.fnm[i]);
	for(i=0;i&lt;5;i++)
		if(trc.fland[i]!=NULL)
			free(trc.fland[i]);
	for(i=0;i&lt;4;i++)
		if(trc.fstat[i]!=NULL)
			free(trc.fstat[i]);
//2011-1-2 add:
	if(trc.cmdicon!=NULL)
		free(trc.cmdicon);
	if(trc.fcursor1!=NULL)
		free(trc.fcursor1);
//2001-1-9 add:
	if(trc.typhoonimg!=NULL)
		free(trc.typhoonimg);
	if(trc.epmimg!=NULL)
		free(trc.epmimg);
	if(trc.cstimg!=NULL)
		free(trc.cstimg);
//2010-12-29 add:	
	if(tmb.cc1!=NULL)
		free(tmb.cc1);
	if(tmb.cc2!=NULL)
		free(tmb.cc2);
	if(tmb.cc3!=NULL)
		free(tmb.cc3);
	if(tmb.ch!=NULL)
		free(tmb.ch);
	if(tmb.fface!=NULL)
		free(tmb.fface);
	if(tmb.fcolor!=NULL)
		free(tmb.fcolor);
	if(tmb.fsize!=NULL)
		free(tmb.fsize);
//2011-1-3 add:
	free_seed_rc();	
	free_harvest_rc();
	if(tipbuf!=NULL)
		free(tipbuf);
//2011-1-16 add:
	if(tcf.cmd_who!=NULL)
		free(tcf.cmd_who);
	if(tcf.cmd_field!=NULL)
		free(tcf.cmd_field);
	if(tcf.cmd_run!=NULL)
		free(tcf.cmd_run);
}//}}}
//{{{void verf_rc()
int verf_rc()
{
	struct stat buf;
	int i;
	if(stat(trc.fmainicon,&buf)!=0)
	{
		if(errno==ENOENT)
		{
			printf("err:file %s not exist!\n",trc.fmainicon);
		}
		else
		{
			printf("file:%s err:%s\n",trc.fmainicon,strerror(errno));
		}
		return 0;
	}
	if(stat(trc.fstatusicon,&buf)!=0)
	{
		if(errno==ENOENT)
		{
			printf("err:file %s not exist!\n",trc.fstatusicon);
		}
		else
		{
			printf("file:%s err:%s\n",trc.fstatusicon,strerror(errno));
		}
		return 0;
	}
	if(stat(trc.backimg,&buf)!=0)
	{
		if(errno==ENOENT)
		{
			printf("err:file %s not exist!\n",trc.backimg);
		}
		else
		{
			printf("file:%s err:%s\n",trc.backimg,strerror(errno));
		}
		return 0;
	}
	for(i=0;i&lt;7;i++)//fnm7未用
	{
		if(stat(trc.fnm[i],&buf)!=0)
		{
			if(errno==ENOENT)
			{
				printf("err:file %s not exist!\n",trc.fnm[i]);
			}
			else
			{
				printf("file:%s err:%s\n",trc.fnm[i],strerror(errno));
			}
			return 0;
		}
	}
	for(i=0;i&lt;4;i++)//fland4未用
	{
		if(stat(trc.fland[i],&buf)!=0)
		{
			if(errno==ENOENT)
			{
				printf("err:file %s not exist!\n",trc.fland[i]);
			}
			else
			{
				printf("file:%s err:%s\n",trc.fland[i],strerror(errno));
			}
			return 0;
		}
	}
	for(i=0;i&lt;2;i++)//fstat2,3未用
	{
		if(stat(trc.fstat[i],&buf)!=0)
		{
			if(errno==ENOENT)
			{
				printf("err:file %s not exist!\n",trc.fstat[i]);
			}
			else
			{
				printf("file:%s err:%s\n",trc.fstat[i],strerror(errno));
			}
			return 0;
		}
	}
//2011-1-2添加	
	if(stat(trc.cmdicon,&buf)!=0)
	{
		if(errno==ENOENT)
		{
			printf("err:file %s not exist!\n",trc.cmdicon);
		}
		else
		{
			printf("file:%s err: %s\n",trc.cmdicon,strerror(errno));
		}
		return 0;
	}
	if(stat(trc.fcursor1,&buf)!=0)
	{
		if(errno==ENOENT)
		{
			printf("err:file %s not exist!\n",trc.fcursor1);
		}
		else
		{
			printf("file:%s err: %s\n",trc.fcursor1,strerror(errno));
		}
		return 0;
	}//end of 2011-1-2
//2011-1-9 add:	
	if(stat(trc.typhoonimg,&buf)!=0)
	{
		if(errno==ENOENT)
		{
			printf("err:file %s not exist!\n",trc.typhoonimg);
		}
		else
		{
			printf("file:%s err: %s\n",trc.typhoonimg,strerror(errno));
		}
		return 0;
	}
	if(stat(trc.epmimg,&buf)!=0)
	{
		if(errno==ENOENT)
		{
			printf("err:file %s not exist!\n",trc.epmimg);
		}
		else
		{
			printf("file:%s err: %s\n",trc.epmimg,strerror(errno));
		}
		return 0;
	}
	if(stat(trc.cstimg,&buf)!=0)
	{
		if(errno==ENOENT)
		{
			printf("err:file %s not exist!\n",trc.cstimg);
		}
		else
		{
			printf("file:%s err: %s\n",trc.cstimg,strerror(errno));
		}
		return 0;
	}//end of 2011-1-9
	i=strlen(tmb.fface);
	if(i&lt;=0)
	{
		memset(tmb.fface,0,sizeof(tmb.fface));
//set default font face:SimSun
		memcpy(tmb.fface,"SimSun",6);		
	}
	i=strlen(tmb.fcolor);
	if(i&lt;=0)
	{
		memset(tmb.fcolor,0,sizeof(tmb.fcolor));
//set default font-color:black=#000000
		memcpy(tmb.fcolor,"black",5);		
	}
	i=strlen(tmb.fsize);
	if(i&lt;=0)
	{
		memset(tmb.fsize,0,sizeof(tmb.fsize));
//set default font-size:10		
		memcpy(tmb.fsize,"10",2);
	}
	if(verf_seed_rc()!=1)
		return 0;
	if(verf_harvest_rc()!=1)
		return 0;
//2011-1-16 add:
	if(tcf.cmd_who==NULL)
		return 0;
	else
	{
		if(tcf.cmd_who[0]==0)
		{memcpy(tcf.cmd_who,"who",3);}
	}
	if(tcf.cmd_field==NULL)
		return 0;
	else
	{
		if(tcf.cmd_field[0]==0)
		{memcpy(tcf.cmd_field,"status",6);}
	}
	if(tcf.cmd_run==NULL)
		return 0;
	else
	{
		if(tcf.cmd_run[0]==0)
		{memcpy(tcf.cmd_run,"autorun",7);}
	}
	return 1;//succ
}//}}}
//{{{ int alloc_msg_buf()
int alloc_msg_buf()
{
	if(tmb.cc1!=NULL||tmb.cc2!=NULL||tmb.cc3!=NULL||tmb.ch!=NULL)
		return 0;
	if((tmb.cc1=malloc(HP_MSG_BUF_LEN))==NULL)
		return 0;
	if((tmb.cc2=malloc(HP_MSG_BUF_LEN))==NULL)
		return 0;
	if((tmb.cc3=malloc(HP_MSG_BUF_LEN))==NULL)
		return 0;
	if((tmb.ch=malloc(HP_MSG_BUF_LEN*3))==NULL)
		return 0;
	if((tmb.fface=malloc(HP_MSG_BUF_LEN))==NULL)
		return 0;
	if((tmb.fcolor=malloc(HP_MSG_BUF_LEN))==NULL)
		return 0;
	if((tmb.fsize=malloc(HP_MSG_BUF_LEN))==NULL)
		return 0;
	return 1;
}//}}}
//{{{ 	int seed_rc()	
int seed_rc()
{//测试版本使用，以后考虑使用数据库保存相关数据,现使用普通文件导入
	int i,j,k,n[7],len;
	FILE *file;
	char *p,ch[1024],*p1,c[64];
	for(i=0;i&lt;HP_SHOP_COUNTS;i++)
	{
		if((tso[i]=malloc(sizeof(tag_seed_opt)))==NULL)
			return 0;
		if((tso[i]-&gt;crop_name=malloc(HP_SHOP_NAME_LEN))==NULL)
			return 0;
		if((tso[i]-&gt;png_filename=malloc(HP_BLOCK_SIZE))==NULL)
			return 0;
		tso[i]-&gt;seed_num=0;
		tso[i]-&gt;level_limt=(unsigned char)(0);
		tso[i]-&gt;rip_time=0;
		tso[i]-&gt;seed_price=0;
		tso[i]-&gt;crop_price=0;
		tso[i]-&gt;crop_num=0;
		tso[i]-&gt;exp=0;
	}	
	file=fopen("./shop.rc","r");
	if(file==NULL)
	{
		printf("error to open file:./shop.rc");
		return 0;
	}
	i=0;k=0;
	memset(ch,0,sizeof(ch));
	while(fgets(ch,sizeof(ch),file)!=NULL)
	{
		if(ch[0]=='\n' || ch[0]=='#')
		{
			memset(ch,0,sizeof(ch));
			continue;
		}
		if(i&gt;=HP_SHOP_COUNTS)
			break;
		j=strlen(ch);
		if(ch[j-1]=='\n')
			ch[--j]=0;
		if(k==0)
		{
			p1=ch;
			for(j=0;j&lt;7;j++)
			{
				p=strchr(p1,',');
				if(p==NULL)
				{
					fclose(file);
					printf("file shop.rc format error\n");
					return 0;
				}
				memset(c,0,sizeof(c));
				len=p-p1;
				memcpy(c,p1,len);
				n[j]=atoi(c);
				p1=p+1;
			}
			tso[i]-&gt;seed_num=(unsigned short)n[0];
			tso[i]-&gt;level_limt=(unsigned char)(n[1]);
			tso[i]-&gt;rip_time=(unsigned short)n[2];
			tso[i]-&gt;seed_price=(unsigned short)n[3];
			tso[i]-&gt;crop_price=(unsigned short)n[4];
			tso[i]-&gt;crop_num=(unsigned short)n[5];
			tso[i]-&gt;exp=(unsigned short)n[6];
			memset(tso[i]-&gt;crop_name,0,HP_SHOP_NAME_LEN);
			if(strlen(p1)&gt;HP_SHOP_NAME_LEN)
			{
				fclose(file);
				printf("shop.rc error:crop name is too long\n");
				return 0;
			}
			memcpy(tso[i]-&gt;crop_name,p1,strlen(p1));
		}
		else
		{
			if(strlen(ch)&gt;HP_BLOCK_SIZE)
			{
				fclose(file);
				printf("shop.rc error:filename is too long\n");
				return 0;
			}
			memset(tso[i]-&gt;png_filename,0,HP_BLOCK_SIZE);
			memcpy(tso[i]-&gt;png_filename,ch,strlen(ch));
			i++;
		}
		k=(k==0?1:0);
		memset(ch,0,sizeof(ch));
	}
	fclose(file);
	return 1;
}//}}}
//{{{ int verf_seed_rc()
int verf_seed_rc()
{
	struct stat buf;
	int i,j;
	for(i=0;i&lt;HP_SHOP_COUNTS;i++)
	{
		if(tso[i]==NULL)
			return 0;
		if(tso[i]-&gt;crop_name==NULL)
			return 0;
		if(strlen(tso[i]-&gt;crop_name)&lt;=0)
			return 0;
		if(tso[i]-&gt;png_filename==NULL)
			return 0;
		if(strlen(tso[i]-&gt;png_filename)&lt;=0)
			return 0;
		if(stat(tso[i]-&gt;png_filename,&buf)!=0)
		{
			if(errno==ENOENT)
			{
				printf("err:file %s not exist!\n",tso[i]-&gt;png_filename);
			}
			else
			{
				printf("file:%s err:%s\n",tso[i]-&gt;png_filename,strerror(errno));
			}
			return 0;
		}
	}
	return 1;
}//}}}
//{{{ void free_seed_rc()
void free_seed_rc()
{
	int i;
	for(i=0;i&lt;HP_SHOP_COUNTS;i++)
	{
		if(tso[i]-&gt;crop_name!=NULL)
			free(tso[i]-&gt;crop_name);
		if(tso[i]-&gt;png_filename!=NULL)
			free(tso[i]-&gt;png_filename);
		if(tso[i]!=NULL)
			free(tso[i]);
	}
}//}}}
//{{{ int harvest_rc()
/*该结构的初始化就是从存档文件中读取，为了简化存档文件，对于tso结构中固
  定项的值不保存，仅保存作物编号，是否锁定，作物数量。作物名称、售价、
  图片文件等资料根据作物编号获取。另保存人物等级等资料即可。
  ----------2011.1.13修改-------------------
  读档由专门的函数load_record执行，这里仅对结构指针初始化，分配空间
*/
int harvest_rc()
{
	int i;
	for(i=0;i&lt;HP_SHOP_COUNTS;i++)
	{
		if((tpp.th[i]=malloc(sizeof(tag_harvest)))==NULL)
			return 0;
/*2011.1.15修改，记得还要修改load,save两个函数，下面两个指针无需分配空
  间，使用指向tso的相应空间即可*/		
/*		if((tpp.th[i]-&gt;h_name=malloc(HP_SHOP_NAME_LEN))==NULL)
			return 0;
		if((tpp.th[i]-&gt;png_filename=malloc(HP_BLOCK_SIZE))==NULL)
			return 0;*/
	}
	if((tpp.name=malloc(HP_SHOP_NAME_LEN))==NULL)
		return 0;
	for(i=0;i&lt;8;i++)
		if((tpp.tif[i]=malloc(sizeof(tag_in_field)))==NULL)
			return 0;
//目前暂不对该结构进行赋值（读档）。2011.1.13初始化
	tpp.level=1;tpp.exp=0;tpp.money=3000;
	tpp.luck=1;
	memset(tpp.name,0,HP_SHOP_NAME_LEN);
	memcpy(tpp.name,USER_NAME,strlen(USER_NAME));
	for(i=0;i&lt;8;i++)
	{
		tpp.tif[i]-&gt;num=HP_SHOP_COUNTS;
		tpp.tif[i]-&gt;status=0;
		tpp.tif[i]-&gt;utime=0;
	}
	for(i=0;i&lt;HP_SHOP_COUNTS;i++)
	{
		tpp.th[i]-&gt;num=HP_SHOP_COUNTS;//表示该结构为空
		tpp.th[i]-&gt;priv=0;
		tpp.th[i]-&gt;price=0;
		tpp.th[i]-&gt;counts=0;
		tpp.th[i]-&gt;h_name=NULL;
		tpp.th[i]-&gt;png_filename=NULL;
		//memset(tpp.th[i]-&gt;h_name,0,HP_SHOP_NAME_LEN);
		//memset(tpp.th[i]-&gt;png_filename,0,HP_BLOCK_SIZE);
	}
	return 1;
}//}}}
//{{{ int verf_harvest_rc()
int verf_harvest_rc()
{
	int i;
	for(i=0;i&lt;HP_SHOP_COUNTS;i++)
	{
		if(tpp.th[i]==NULL)
			return 0;
//2011.1.15修改，初始化时必须为空		
//		if(tpp.th[i]-&gt;h_name==NULL)
//			return 0;
//		if(tpp.th[i]-&gt;png_filename==NULL)
//			return 0;
	}
	if(tpp.name==NULL)
		return 0;
	for(i=0;i&lt;8;i++)
		if(tpp.tif[i]==NULL)
			return 0;
	return 1;	
}//}}}
//{{{ void free_harvest_rc()
void free_harvest_rc()
{
	int i;
	if(tpp.name!=NULL)
		free(tpp.name);
	for(i=0;i&lt;HP_SHOP_COUNTS;i++)
	{
//		if(tpp.th[i]-&gt;png_filename!=NULL)
//			free(tpp.th[i]-&gt;png_filename);
//		if(tpp.th[i]-&gt;h_name!=NULL)
//			free(tpp.th[i]-&gt;h_name);
		if(tpp.th[i]!=NULL)
			free(tpp.th[i]);
	}
	for(i=0;i&lt;8;i++)
		if(tpp.tif[i]!=NULL)
			free(tpp.tif[i]);
}//}}}
//{{{ int load_record()
int load_record()
{//HP_SHOP_COUNTS*sizeof()
	int file,len,i,j,k;
	unsigned char *c1,*p;
	len=(3*sizeof(unsigned short)+sizeof(unsigned char)+HP_SHOP_NAME_LEN+HP_BLOCK_SIZE)*HP_SHOP_COUNTS;
	len+=8*sizeof(tag_in_field);
	len+=HP_SHOP_NAME_LEN+2*sizeof(unsigned int)+sizeof(unsigned short)+sizeof(unsigned char);
	if((file=open(SAVE_FILE,O_RDONLY))==-1)
	{
		printf("error 001\n");
		return 1;	
	}
	if((c1=malloc(len))==NULL)
	{
		printf("error 002\n");
		close(file);
		return 1;
	}
	memset(c1,0,len);
	i=read(file,c1,len);
	if(i!=len)
	{
		free(c1);
		close(file);
		printf("error 003\n");
		return 1;
	}
	memfrob(c1,len);
	p=c1;
	i=sizeof(unsigned short)+2*sizeof(unsigned int)+sizeof(unsigned char);
	memcpy((void*)&tpp,c1,i);
	p+=i;
	memcpy(tpp.name,p,HP_SHOP_NAME_LEN);
	p+=HP_SHOP_NAME_LEN;
	j=3*sizeof(unsigned short)+sizeof(unsigned char);
	for(i=0;i&lt;HP_SHOP_COUNTS;i++)
	{//要记得在harvest_rc中对缓冲区置零
		memcpy((void *)&tpp.th[i],p,j);
		p+=j;
		memcpy(tpp.th[i]-&gt;h_name,p,HP_SHOP_NAME_LEN);
		p+=HP_SHOP_NAME_LEN;
		memcpy(tpp.th[i]-&gt;png_filename,p,HP_BLOCK_SIZE);
		p+=HP_BLOCK_SIZE;
	}//所有th结构赋值完毕
	j=sizeof(tag_in_field);
	for(i=0;i&lt;8;i++)
	{
		memcpy(tpp.tif[i],p,j);
		p+=j;
	}//完成所有土地状态赋值
	close(file);
	free(c1);
	return 0;
}//}}}
//{{{ void save_record()
void save_record()
{
	int file,len,i,j,k;
	unsigned char *c1,*p;
	len=(3*sizeof(unsigned short)+sizeof(unsigned char)+HP_SHOP_NAME_LEN+HP_BLOCK_SIZE)*HP_SHOP_COUNTS;
	len+=8*sizeof(tag_in_field);
	len+=HP_SHOP_NAME_LEN+2*sizeof(unsigned int)+sizeof(unsigned short)+sizeof(unsigned char);
	if((file=open(SAVE_FILE,O_WRONLY|O_CREAT,0666))==-1)
	{
		return;	
	}
	if((c1=malloc(len))==NULL)
	{
		close(file);
		return;
	}
	memset(c1,0,len);
	p=c1;
	i=sizeof(unsigned short)+2*sizeof(unsigned int)+sizeof(unsigned char);
	memcpy(c1,(void *)&tpp,i);
	p+=i;
	memcpy(p,tpp.name,HP_SHOP_NAME_LEN);
	p+=HP_SHOP_NAME_LEN;
	j=3*sizeof(unsigned short)+sizeof(unsigned char);
	for(i=0;i&lt;HP_SHOP_COUNTS;i++)
	{//要记得在harvest_rc中对缓冲区置零
		memcpy(p,(void *)&tpp.th[i],j);
		p+=j;
		memcpy(p,tpp.th[i]-&gt;h_name,HP_SHOP_NAME_LEN);
		p+=HP_SHOP_NAME_LEN;
		memcpy(p,tpp.th[i]-&gt;png_filename,HP_BLOCK_SIZE);
		p+=HP_BLOCK_SIZE;
	}//所有th结构赋值完毕
	j=sizeof(tag_in_field);
	for(i=0;i&lt;8;i++)
	{
		memcpy(p,tpp.tif[i],j);
		p+=j;
	}//完成所有土地状态赋值
	memfrob(c1,len);
	i=write(file,c1,len);
	close(file);
	free(c1);
}//}}}

