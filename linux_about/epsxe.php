<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<center><font size=5 color=#0000ff>Debian下老旧程序的迁移</font></center><br>";
echo "ePSxe 这是我最爱的一款sonyPS模拟器，然而在2016年之后其开发团队就停止了
对其的维护和更新<br>
这款史上最优秀的模拟器停止在了2.05版本。虽然在debian的软件仓库中还有其他的ps模拟器，但是根本无法与这款优秀的软件媲美。<br>
虽然epsxe一直没有出现在debian的软件仓库中，但是在debian9之前都能一直在debian系统中完美的运行，其完美的画面，几乎0bug的运行，<br>
以及超低的资源占用，都使这款软件成为极品！然而自debian9开始，随着系统的升级，使其所依赖的链接库都不再支持这款软件了，<br>我当时为了继续保留这款软件，在升级到debian9时，从之前的发行版中拷贝了两个其所依赖的库文件。<br>现在我的debian已经用到了版本10,这回有更多的依赖不能使用了。可我实在又不想放弃。在了解了snapd和flatpak之后，我也考虑到跨版本对他继续使用<br>
于是，我将他之前能用的各个链接库文件都拷贝至一个文件夹中。
并将该文件夹的路径添加至/etc/ld.so.conf.d/目录下，使用ldconfig更新搜索路径
终于，这款经典软件又在debian10中能正常运行了！";
?>
