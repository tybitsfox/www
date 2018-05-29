<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<center><font size=5 color=red>debian602下mutt+exim4+fetchmail+procmail+formail搭建邮件收发系统</font></center>";
echo "<br><table border=0 width=100%><tr width=100%><td width=10%></td><td width=80%><font size=4 color=black><pre>";
echo "
<font color=blue size=4>一、各程序功能简介</font>
1、mutt是一个综合的邮件收发，阅读管理平台。其具体功能实现，仰仗其他软件的协同工作。
2、exim4这是debian下默认安装的MTA（邮件传输代理），mutt使用她来完成邮件发送工作。
3、fetchmail是一款邮件接收软件，虽然mutt自身可以接收邮件，但是若要实现多个邮箱的查询接收要靠fetchmail。
4、procmail是一款邮件分拣、过滤工具，她可以设定阻止垃圾邮件接收和按条件分类邮件。
5、formail是邮件格式化工具。
各程序的工作机制为：发送邮件由mutt调用exim4完成，接收邮件由mutt调用fetchmail实现，在接收时，fetchmail
又借助于procmail和formail来完成邮件的分类、过滤以及文件的格式化工作。mutt实现前台的邮件列表管理、邮件
阅读、转发、删除等工作。
<font color=blue size=4>二、程序安装</font>
由于我使用的debian，exim4是系统默认安装的，同样procmail、formail都是系统默认安装的。如果没有可使用
apt-get 自行安装。mutt和fetchmail使用apt-get install安装。
<font color=blue size=4>三、exim4的设置</font>
虽然exim4是系统默认安装的，但是在没有配置前是不可以直接发送外网邮件的，必须要对其进行进一步的设置。
其配置的路径为/etc/exim4/,配置前所有的文件为：
exim4.conf.template						这是一个重要的配置模板文件，一般无须手动
update-exim4.conf.conf					exim4启动时的配置文件。
passwd.client							在未进行配置前，该文件为空。
conf.d/									该目录中的文件一般无需改动。
首先运行dkpg-reconfigure exim4-config,进入一个配置界面，根据个人需要可以选直接使用smtp发送或者使用smarthost
代理发送，使用smtp发送有个坏处，就是收信人看到的邮件地址是你本机设置的，无法回复。选择使用smarthost发送需要
指定一个网络上真实的smtp服务器，是借用这个服务器上你的邮箱发送邮件。例如：你的邮箱是：aaa@gmail.com，则要指
定smarthost为smtp.gmail.com。给别人发信时，显示的是你aaa@gmail.com邮箱发来的。
我选择了smtp发送。其他的选项为：
1、直接使用smtp的服务类型
2、系统邮件名称设置 	随意（我的tiny.edu）
3、监听联入的smtp的ip	一般选择127.0.0.1(仅本机可用)，*允许任何人
4、其他的选默认
配置完成后exim4会按照新的配置重新启动服务，此时如果选择的是smtp方式则配置完成，如果你选择了smarthost
类型的服务则还要进一步进行设置（该设置适用于smarthost类型的邮件服务系统）：
在/etc/exim4/下修改passwd.client,添加smarthost服务器名：用户名：密码：
smtp1.mail.vip.cnb.yahoo.com:aaa@yahoo.cn:password
在/etc/exim4/下新建文件email-addresses,添加本机用户明和邮箱用户名（该名必须和passwd.client中用户名一致）：
root:aaa@yahoo.cn

然后重启exim4服务：/etc/init.d/exim4 restart
上述步骤完成后可发送邮件测试是否成功：mutt -s \"mail test\" aaa@163.com &lt; ./aaa.txt
如果在aaa＠163.com中收到了主题为mail test的邮件则表示配置成功。
mutt命令解释：-s后带邮件主题，aaa@163.com为目的邮箱，邮件内容为aaa.txt的内容，如带附件则：
mutt -s \"mail test\" aaa@163.com -a bbb.jpg &lt; ./aaa.txt 
需要注意的是：exim4虽然简单，但是在配置过程中往往会出现些莫名其妙的错误，可能不管你怎样修改都无法更正，甚至
卸载掉重装都无济于事，这时最好不要使用apt-get remove或autoremove来卸载，使用dpkg --pruge进行彻底清除。
<font color=blue size=4>四、mutt的设置</font>
mutt的配置依然很简单（仅限于满足使用），他的配置文件一般为\$HOME/.muttrc。只要进行简单的设置mutt就可以工作了：
ignore *									#设置显示邮件时不显示邮件头
unignore From Subject Date					#设置取消屏蔽邮件头中的发件地址，邮件名称和日期。 
set editor='vim'							#设置邮件正文编辑器为vim
set sendmail='/usr/sbin/exim4'     			#设置邮件发送程序为exim4
set folder=\"~/Mail\"							#设置邮箱目录
set mbox=\"~/Mail/inbox\"						#设置收件箱
set spoolfile=\"~/Mail/inbox\"     
set record=\"~/Mail/sent\"     				
mailboxes \"+inbox\"							#收件箱
mailboxes \"+13325xxxx00\"					#分类收件箱，189邮箱
mailboxes \"+tybitsfox_gmail\"				#gmail邮箱的邮件
mailboxes \"+tyyyyt\"							#163邮箱的
mailboxes \"+tybitsfox_163\"	
mailboxes \"+tybitsfox_yahoo\"
set charset=\"utf8\"							#字体
set locale=\"zh_CN\"							
set from='QQMaster <10000@qq.com>'			#设置使用直接smtp发送时，收件方显示的你的发信地址.
<font color=blue size=4>五、fetchmail的设置</font>
fetchmail的个人配置文件为\$HOME/.fetchmailrc，如果要作为服务运行定时检查邮箱则为/etc/fetchmailrc。

defaults										#保证这几行在文件的开头
mda \"/usr/bin/procmail -d %T\"					#使用procmail过滤、分拣
set logfile \"/var/log/fetchmail.log\"			
set daemon 600 									#如果作为服务运行，指定检查邮箱的时间间隔

poll pop.163.com								#设定需要检查的邮箱
proto POP3
uidl											#只收取新邮件
username tybitsfox@163.com						
password **********
keep											#收取邮件后不删除服务器上的邮件

poll pop.189.cn									#设定其他需要检查的邮箱
proto POP3
uidl
username 13325xxxx00@189.cn
password *********
ssl												#如需验证则加入该项
keep
<font color=blue size=4>六、procmail的设置</font>
procmail的配置文件\$HOME/.procmailrc，在这里进行邮件过滤、分拣设置

PATH=/bin:/usr/bin:/usr/local/bin
MAILDIR=\"/root/Mail\"					#指定邮件目录
LOGFILE=\"/var/log/procmail.log\"			
FORMAIL=/usr/bin/formail				#指定格式化程序
VERBOSE=off

:0
* ^To.*fox@gmail.com					#我的gmail邮箱的邮件都存放在文件tybitsfox_gmail中
tybitsfox_gmail

:0
* ^To.*yyt@163.com						#tyyyyt@163.com邮箱中的信件报存在tyyyyt文件中
tyyyyt

:0
*.*
inbox									#其余邮件存放在inbox文件中

至此你的邮件收发已经建立起来了，在没有启动fetchmail之前，使用命令进行测试：
fetchmail -akv -m \"/usr/bin/procmail -d %T\" 看看收邮件是否成功，如成功，运行mutt查看。
参数a 收取所有邮件，k 不删除服务器上的邮件，m 指定邮件传送代理mda。
依据你的实际情况确定是否将自动收取邮件fetchmail加入服务中运行，如需加入，修改/etc/default/fetchmail
将START_DAEMON=no 改为yes，重启即可。
";
echo "</pre></font></td><td width=10%></td></tr><table>";
echo "<br><table border=0 width=100%><tr width=100%><td width=10%></td><td width=80%><font size=4 color=blue><pre>";
echo "fetchmail如果提示不以root身份运行的话，可将配置文件放置到/etc目录下，但是fetchmailrc文件中包含有登录邮箱的密码
所以，请慎用。如果移动配置文件的话，可移动下列配置：Muttrc,fetchmailrc procmailrc<br>";
echo "<font size=4 color=red>----2014.2.21添加关于使用smarthost发送邮件的补充----</font>
首先，对于使用ssl/tls（465端口）的163邮箱的设置始终没有成功，虽然看了不少说明，包括debian的wiki。
而使用属于tls的STARTTLS(587端口)的gmail邮箱可以成功设置。另外对于使用非ssl的（25端口）的一些邮箱
也能成功设置，比如：smtp.sina.com,smtp.tom.com,smtp.21cn.com。这里详细记录下本次的设置操作:
1、配置/etc/exim4/update-exim4.conf.conf
运行dpkg-reconfigure exim4-config,进入设置界面
（1）选择用smarthost发信；通过SMTP或fetchmail接收信件
（2）输入系统邮件名称: debian.edu
（3）输入监听的ip地址: 127.0.0.1
（4）请输入被此主机认为是以其自身为最终目的地址的域名列表: 空
（5）本地用户的可见域名: debian.edu
（6）寄信使用的 smarthost 的 IP 地址或主机名: smtp.gmail.com::587
（7）为下列主机进行邮件中转 (relay): 空
（8）保持最小 DNS 查询量吗 (按需拔号，Dial-on-Demand): No
（9）将设置文件分拆成小文件吗: No(不拆分，使用一个配置文件)
（10）Root 和 postmaster 邮件的接收者: 空
完成后的配置（/etc/exim4/update-exim4.conf.conf）应如：
dc_eximconfig_configtype='smarthost'
dc_other_hostnames='debian.edu'
dc_local_interfaces='127.0.0.1'
dc_readhost='debian.edu'
dc_relay_domains=''
dc_minimaldns='false'				#最小dns查询
dc_relay_nets=''
#dc_smarthost='smtp.21cn.com'
dc_smarthost='smtp.sina.com'
#dc_smarthost='smtp.gmail.com::587'
#dc_smarthost='smtp.tom.com'
CFILEMODE='644'
dc_use_split_config='false'			#不分割
dc_hide_mailname='true'				#隐藏本地设置
dc_mailname_in_oh='true'			
dc_localdelivery='mail_spool'

编辑/etc/exim4/passwd.client 添加如下行：
#smtp.sian.com:yourcount@sina.com:yourpasswd
#tomsmtp.cdn.163.net:yourcount@tom.com:yourpasswd
#smtp.cdn.21cn.com:yourcount@21cn.com:yourpasswd
*.google.com:yourcount@gmail.com:yourpasswd

编辑/etc/exim4/email-addresses 添加：
root: yourcount@gmail.com
#root: yourcount@sina.com
#root: yourcount@21cn.com
#root: yourcount@tom.com

编辑/etc/exim4/exim4.conf.template 查找begin authenticators并在其后添加（在cram_md5:之前）：
AUTH_CLIENT_ALLOW_NOTLS_PASSWORDS=1

编辑~/.muttrc(/etc/Muttrc) 添加发送邮件的设置：
#设置发信
#set from=yourcount@21cn.com
#set from=yourcount@tom.com
#set from=yourcount@sina.com
set from=yourcount@gmail.com
set use_from=yes
set envelope_from=yes
至此，设置完成。重新加载配置并运行：
# update-exim4.conf			更新配置
# invoke-rc.d exim4 restart  重新启动
# exim4 -qff				发送测试
通过 tail -20 /var/log/exim4/mainlog查看运行情况。
<font size=4 color=red>----补充完成----</font>
<font size=4 color=blue>----2014.2.24关于使用smarthost发送邮件的终极解决方案----
前几天（21日）出现的无法使用163的邮箱作为smarthost来发送信件的问题，以及一些莫名其妙其它问题
现已全部完美解决。期间出现的莫名其妙的问题包括在本本上能够成功发送的信件，相同的配置在台式机上
不能发送;发送时查看log显示发送成功，但是收信箱接收不到。对于163无法实现的原因我一直以为是他所
采用的ssl机制造成的。现在才知道阻碍这一切实现的竟然是：我的机器都躲在路由器之后，指定的代发邮
件的邮箱服务器都不能和我的exim4进行验证所造成的，当然，也有不需要验证就可以直接发送的。那就是
伟大的google邮箱。不过也正是因为他才使我没去考虑是我内网配置造成的。知道了问题的所在，修复就
简单了：在路由器上设置下端口映射，将exim4所用的端口（25：465：587）映射到目标机器的ip上即可。
做完了映射163的邮件代发就能顺利实现了。不过随之而来的另一个问题是，我的台式机和本本分配了不同
的固定内网ip，端口映射只能将同一端口映射到一个ip上。解决的方法就是在两台机器上分别设定exim4使用
不同的通讯协议，例如在台式机上指定exim4使用ssl/tls,那么就可将465端口映射到台式机的ip上。在本本
上使用非ssl协议，则将端口25映射到本本的ip上。调正完重启服务发送邮件测试----成功！！！！
修改本地exim4使用不同协议(ssl/tls STARTTLS)的操作(debian)：
(1)修改/etc/default/exim4,将SMTPLISTENEROPTIONS=''修改为：
SMTPLISTENEROPTIONS='-oX 465:587 -oP /var/run/exim4/exim.pid'
(2)修改/etc/exim4/exim4.conf.template,添加：
#####################################################
### main/03_exim4-config_tlsoptions
#####################################################
tls_on_connect_ports=465
### main/03_exim4-config_tlsoptions
#################################
做完这两步后，重新加载配置update-exim4.conf && invoke-rc.d exim4 restart就完成了
至于exim4的配置（dpkg-reconfigure exim4-config）中要求的:
寄信使用的 smarthost 的 IP 地址或主机名: smtp.163.com::465 <--这里就不必指定端口了
2014-08-13补充：在不使用ssl（465端口）协议时，端口（25）就不必做映射,一样能成功收发。
----补充完成----</font>";
echo "<pre><font color=red>2016-02-29 成功解决mutt发送带tar.bz2附件时附件被修改的问题</font>
偶尔发送了一个带tbz2附件的邮件，在收到邮件并解压时发现附件无法解压了
并且使用mutt接收邮件时发现其尝试打开该压缩包文件显示。期初以为是压缩文件时
出错，但是我又试着发送了一封带tbz2的邮件验证，结果仍然是被修改且不能在解压
看来这是个共性问题了，我又尝试发送zip格式的附件，发现该附件可以正常解压。
并且我比较了这两个邮件附件的类型描述和编码，发现了其中的差异：
tbz2的压缩包为：形态:  text/plain, 编码: quoted-printable
zip的压缩包为：形态:  application/zip, 编码: base64
以上的形态（或者说类型）是在mutt客户端下显示的。显然tbz2的彻底给我搞错了。
上网查询结果，百度这个傻逼根本没有任何有意义的搜索。google又不能用。草土鳖个妈的！！
只能自己解决了，还好，我用的是linux，万事有man，根据其类型差别，我想看看是否有指定
附件类型的参数或设置，果然有配置文件：/etc/mime.types，查看该配置文件果然对zip文件有
明确的类型设定，而bz2则没有，于是我仿照zip的设置，尝试添加了如下的关于bz2的设置：
application/x-bzip-compressed           tbz2 bz2 
重启exim4，再次发送带有tbz2格式的附件，接受...perfect！！！
接收的附件格式显示为：
形态:  application/x-bzip-compressed, 编码: base64

随着时间的流逝，我会渐渐的老去...然而，时间所不能改变的，就是我依然那么的牛逼！
</pre>";
echo "</pre></font></td><td width=10%></td></tr><table>";

?>
