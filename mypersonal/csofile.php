<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<font size=5 color=#ff0000><center>linux C 动态链接库相关</center></font><br>";
echo "<font size=4 color=#0000ff><pre>
	<font size=4 color=#ff0000>一、 </font> 动态链接库makefile的编写：
	libmysofile.so:myso.o
		gcc -shared -lc -o libmysofile.so myso.o
	myso.o:myso.c
		gcc -c -fpic -o myso.o myso.c
	install:
		mv libmysofile.so /home/myname/mlib/
		mv myso.h	/home/myname/mlib/include/
	clean:
		rm *.o
	以上就是so文件的makefile的一般写法，参数：shared 表示生成共享库，参数：lc 表示链接c库。
	参数 c 表示只进行编译，	参数 fpic  表示生成位置无关的代码。
	<font size=4 color=#ff0000>二、 </font> 一个动态链接库的简单实例（myso.c）:
	# include 
	int getresult(int i,int j)
	{
		i+=j;
		return i;
   	}
	<font size=4 color=#ff0000>三、</font> 头文件（myso.h）:
	int getresult(int i,int j);
	四、上面三个文件编辑安成后，即可在当前目录下运行make,生成so文件。生成的动态链接库文件一般要放在特定的目录下才能被调用进程正确加载。
	所以，还需要一步安装，运行make install 即可将so文件安装到指定的位置。一般系统默认的库文件目录为：／lib；／usr／lib；／usr／local／lib
	如果你不想将你的so文件放在上述目录中，你可以仅仅在上述目录中做个链接：ln -s ./libmysofile.so /usr/lib/。
	如果你连链接也不想做，那么只能修改<font size=4 color=#ff0000>LD_LIBRARY_PATH</font>，将你的路径添加到变量<font size=4 color=#ff0000>LD_LIBRARY_PATH</font>中去：
	export LD_LIBRARY_PATH=/home/myname:/lib:/usr/lib:/usr/local/lib
	<font size=4 color=#ff0000>五、</font> 调用进程的编写（lso.c）：
	#include
	#include\"/home/myname/mlib/include/myso.h \" 
	int main(int argc,char **argv)
	{
		int i=20;
		int j=19;
		getresult(i,j);
		return 0;
	}
	makefile的编写：
	lso:lso.c
		gcc -o lso lso.c -L /home/myname/mlib -lmysofile

		
	<hr width=80% size=2>

</pre></font>";

?>
