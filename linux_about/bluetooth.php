<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<center><font size=5 color=#0000ff>Debian下使用蓝牙适配器</font></center><br>";
echo "<pre>hciconfig -a			查看蓝牙适配器
hcitool scan		扫描蓝牙设备
hcitool name 18:DC:56:D2:1C:1A  查看扫描到的蓝牙设备名
首次使用蓝牙适配器时，应使用下列命令对适配器进行设置：
hciconfig hci0 iscan	配置蓝牙适配器使得能被其他设备搜索到
再执行下列三条命令，保证可以配对成功
hciconfig hci0 pscan
hciconfig hci0 noencrypt
hciconfig hci0 noauth

我的蓝牙手柄的mac
A4:AE:12:38:D7:6B

蓝牙配对：bluetoothctl
进入 bluetoothctl shell:
scan on				<-扫描蓝牙设备
scan off 			<-停止扫描

pair A4:AE:12:38:D7:6B		<- 指定配对设备,之前已经配对的无需再次运行
connect A4:AE:12:38:D7:6B	<- 连接配对设备
disconnect					<- 断开
quit						<- 退出bluetoothctl shell
</pre>
";
?>
