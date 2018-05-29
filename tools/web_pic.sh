#!/bin/bash
tagpath=",t01/,huili/images/,googlemap/gis_hb/images/,tin16/bbb/bof3_pic/,tin16/bbb/bof4_pic/,tin16/ccc/images/,tin16/ddd/ff6_images/,tin16/ddd/ff6/ff6image/,tin16/eee/ff2_images/,tin16/fff/ff3_images/,tin16/ggg/ff4_images/,tin16/hhh/pic/,tin16/iii/gonglve/,tin16/iii/pic1/,tin16/jjj/pic/,tin16/jjj/images/,tin16/jjj/walkm2/,tin16/kkk/tuwen/,tin16/kkk/images/,tin16/lll/120810/,tin16/lll/121214/,tin16/mmm/allimg/"
st=${tagpath//,/\ \/var\/www\/}

if [ $# != 1 ];then
	echo "Usage: $0 [backup|restore]"
	exit 0
else
	ss=`echo $1 | tr '[a-z]' '[A-Z]'`
	if [ $ss == "BACKUP" ];then
		tar cjvf /tmp/pure_pic.tar.bz2 $st
	elif [ $ss == "RESTORE" ];then
		cd /tmp 		#default dir is /tmp
		cp -r var/* /var	
	else
		echo "parameters error!"
		exit 0
	fi
fi
#tar cjvf /tmp/pure_pic.tar.bz2 $st
echo "well done!"
