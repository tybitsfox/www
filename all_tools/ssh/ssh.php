<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<font size=4 color=red><center>ssh基本应用</center></font><br>";
echo "<font size=3 color=black>
ssh连接服务器： ssh usename@hostname<br>
例如： ssh root@192.168.5.100<br>
连接后可进行各种shell操作。退出时输入：exit结束ssh连接<br>
文件传输：scp,该命令可单独执行，也可在ssh中执行： scp username@remote_host:/dir/filename username@localhost:/dir/<br>
该命令将拷贝服务器dir目录下filename到本地dir文件夹中，如带目录拷贝可加参数r。<br>
将本地文件拷贝至remotehost：scp ./dir/filename username@remote_host:/dir/<br></font><font size=3 color=blue><br>
ssh和git配合建立一个简单的git服务器也非常的实用,详细的做法见git的介绍。这里只记录下我的git服务器的搭配<br>
在机器上安装了git和ssh后，就基本上可以工作了，呵呵。作为服务器目录我选择了/opt/git/，首先建立一个git专用帐户git<br>
adduser git<br>
su git<br>
cd<br>
mkdir .ssh<br>
为了以后操作的方便，将常用用户的ssh公钥加入到git的.ssh/authorized_keys文件中。<br>
比如root的公钥：id_rsa.root.pub >> ~/.ssh/authorized_keys<br>
如果在当前用户~/.ssh/下没有pub文件，则运行下ssh-keygen即可生成。<br>
下一步开始建立一个空仓库：<br>
cd /opt/git<br>
mkdir www.git<br>
cd www.git<br>
<font size=3 color=red>git --bare init<br></font>
这样一个www.git的仓库就建立起来了，如果这个空仓库是在本地建立起来的，则需要推送到服务器上去：<br>
<font size=3 color=red>scp -r www.git git@remote_host:/opt/git/<br></font>
然后开始开始添加这个远程仓库：<font size=3 color=red>git remote add origin git@remote_host:/opt/git/www.git</font><br>
可通过<font size=3 color=red>git remote show</font>或者<font size=3 color=red>git remote show origin</font>查看当前项目远程仓库的信息。<br>
将本地的原数据推送至远程空仓库：<font size=3 color=red>git push origin master。</font><br>
从远程仓库抓取数据：<font size=3 color=red>git fetch origin</font><br>注意，该命令仅是拉取本地仓库中没有的数据，运行完后可以在本地查看远程仓库中<br>
所有的分支，但是数据并没有合并到当前工作分支。如果需要合并可使用：<font size=3 color=red>git pull origin</font><br></font>
";
echo "<br><hr size=2 width=80%>
<center><font color=red size=4>github使用注意事项</font></center><br><font color=black size=3>
网址：<a href='http://www.github.com' target=_blank>http://www.github.com</a> user:tybitsfox pwd:.........<br>
目前在github上保存的唯一一个有用的仓库为我的个人网站的源代码，这样我就可以在家在办公室修改的时候能方便的进行同步更新、合并<br>
建立和推送的步骤为：<br>
一、建立一个新的知识库：create a new Repository<br>
二、输入库的名称，例如：www。<br>
三、输入新库的简短描述。<br>
四、免费用户只能选择该库为公共的，即public。<br>
五、这一步对于将本地现有的库能正常推送至服务端至关重要，不要选择使用readme初始化新库。否则在推送时会出现本地版本落后与<br>
新库而拒绝推送的情况。<br>
六、建立完新库后，将服务器上的库加入本地：git remote add origin https://github.com/tybitsfox/www.git<br>
虽然在github上注明可以使用ssh但是git@github.com:tybitsfox/www.git并不可用。只能使用https的链接了<br>
运行：git push origin master,输入你注册的名用户和密码就可以推送了。在新建的页面上给出的命令是<br>
git push -u origin master。我还没弄明白这个u参数到底何用。<br> 
七、删除github上的一个仓库：登录->选择Repositories->选择待删除的仓库->右上角settings->进入删除。
<br></font>";
echo "<a name=\"koding\"></a>";
echo "<pre><font color=red size=5>koding应用的简单介绍</font>
1、在本地机上运行ssh-keygen 生成 .ssh/id_rsa.pub文件。
将该文件内容拷贝至koding.com中->个人设置->ssh key里面,并保存。
2、在本地~/.ssh/下建立config文件。并添加下列内容：
Host *.kd.io
 User bitsfox
#ProxyCommand ssh %r@ssh.koding.com nc %h %p
 ProxyCommand ssh %r@68.68.97.75 nc %h %p
保存该文件，注意，域名ssh.koding.com可能会被狗日的和谐。所以我使用
了ip地址。
3、清空本地的known_hosts文件（之前如果没正确链接到koding时这是必须
的一步）。
4、在本地shell中输入：
ssh vm-0.bitsfox.koding.kd.io
连接成功～～～
scp ./php5.tar.bz2  vm-0.bitsfox.koding.kd.io:Web/

web访问的网址为：
<a href='http://tybitsfox.koding.io' target=_blank>http://tybitsfox.koding.io/</a>
<a href='https://tybitsfox.koding.io' target=_blank>https://tybitsfox.koding.io/</a>
第一中网址总能访问到正常的网页，第二种必须要将域名tybitsfox.kd.io与虚拟服务器链接：
链接的方法是在用户的environments界面将两者链接起来：用鼠标拖出一条线来链接....
<img src='./111.png'>
5、在虚拟服务器上使用mysql:
koding的虚拟服务器默认安装了mysql，你可以直接使用你的登录名如tybitsfox进入mysql，
但是由于没有授权所以进入mysql也什么都做不了，要取得授权就必须先以root的身份登录
mysql，在控制台下可以使用help phpmyadmin来查询phpmyadmin的使用，由查询可知，在服
务器上使用mysqladmin -u root password NEWPASSWORD 为root账户设定一个新密码。设置
成功后就可使用root登录mysql，并且建立新的数据库以及为你的普通账户赋予权限了：
grant select,insert,update,create,drop on web_data.* to 'taenv'@'localhost' identified by 'password';

6、虚拟服务器的激活，未付费的用户在虚拟控制台关闭15分钟后，虚拟服务器即关闭，比在提供web服务。
而此时因为虚拟控制台没有启动所以也无法通过ssh链接激活，只能通过登录网页<a href='https://koding.com/' target=_blank>koding登录</a>来激活
控制台开启web服务。
7、文件的上传，可通过上面介绍的scp来将本地文件上传至服务器，但是由于ssh有时会链接不上，为做后
备，我又使用了github来传递文件：https://github.com/tybitsfox/git_trans.git 这个仓库将作为本地与
koding虚拟服务器传送文件的桥梁。
8、长时间（24小时）不登录的话，不仅网站而且连数据库也关闭了，再次打开数据库的操作：
sudo service mysql restart
-----------------------2014-10-1起koding网站进行了升级----------------------------------
不管是控制台登录还是网站的url都进行了很大的改动，上面的很多做法已不再适用：
1、新的web网址为固定的，但很难记了：<a href='http://utkk49ccbca1.tybitsfox.koding.io/' target=_blank>http://utkk49ccbca1.tybitsfox.koding.io/</a>
2、旧网站及vm控制台数据的迁移：在新的用户目录下默认存放了一个脚本程序：migrate.sh，运行该脚本，
如果无误的话会将你原来的所有的数据资料都拷贝至~/Backup/目录下。
3、一些新的操作及配置参看主菜单中的contact support。

</pre><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";

?>

