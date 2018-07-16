<?php
$err_msg='我的专家组';
$tab_act=array("active","");				//横向标签页的动态保存
$ven_act=array("active","","","");			//纵向标签页的动态保存
$glb_chk=array("","","","","","","","");	//专家选择按钮的动态保存
$glb_chk1=array("","","","","","","","");	//团队选择按钮的动态保存
$cnt=array(0,0,0,0,0);			//四个纵向标签页中每页的记录总条数	
$curr_pg=array(0,0,0,0,0);		//四个纵向标签页中每页的当前翻页数记录
$exp=array();					//已合作的专家队列
$term=array();					//已合作的团队队列
$xexp=array();					//所有未合作的专家队列
$xterm=array();					//所有未合作的团队队列
$sel_exp=array();				//符合用户选择条件的未合作专家队列
$sel_term=array();				//符合用户选择条件的未合作团队列表
$esel1=0;						//未合作专家的筛选条件
$esel2=0;						//未合作团队的筛选条件
//{{{ 数据的取得及准备操作
if(isset($_GET['action']))  //这个判断不是必须的，但会保证在apache2的运行日志中不会出现访问未定义变量的消息记录
{//前置性影响的操作：查询，添加，删除。这些动作的处理要在读取数据之前进行。因为他们决定了读取数据的条件或者先要更新数据库才能读取
//后置性操作：翻页，这个动作须在读取数据后进行。后置性操作必须依据取得的数据才能进一步操作。
//所以，这里不能集中处理所有的动作，而要将上述两类操作分开。	
	if($_GET['action'] == 'false') //=false 表示按下查询按钮的操作
	{
		if(intval($_GET['vendor']) == 2) //标签页3,查询未邀请的专家
		{
			if(isset($_POST['checkn']))
			{
				foreach($_POST['checkn'] as $a)
					$esel1+=intval($a);
			}
			else
				$esel1=0;
			$glb_chk=get_chk($esel1);
			$err_msg='查找新的专家';
		}
		if(intval($_GET['vendor']) == 3)//标签页4,查询未邀请的团队
		{
			if(isset($_POST['checkm']))
			{
				foreach($_POST['checkm'] as $a)
					$esel2+=intval($a);
			}
			else
				$esel2=0;
			$glb_chk1=get_chk($esel2);
			$err_msg='查找新的团队';
		}
	}
	elseif($_GET['action'] == 'true') //tab2 退出邀请
	{
		if(isset($_GET['iid']))
		{
			$ta=new tb_my_expert();
			$ay=array($_GET['iid'],$_SESSION['CURR_USR'][0]);
			$ta->drop_my_expert($ay);
		}
	}
	else //action=uid; 上面的操作和下面的操作不会并存的
	{
		$ta=new tb_my_expert();	//通过vendor就可以直接判断出下面的操作了
		if(intval($_GET['vendor']) > 1)//邀请或解除合作的动作
		{//邀请
			$ay=array($_SESSION['CURR_USR'][0],$_GET['action']);
			$ta->add_my_expert($ay);
		}
		else	//解除
		{
			$ay=array($_SESSION['CURR_USR'][0],$_GET['action']);
			$ta->drop_my_expert($ay);
		}
	}
}
$ta=new tb_my_expert();
$a=1;$ay=array();
$ay=$ta->get_my_expert($a);//查找所有没被当前用户添加的专家和团队
//uid(0),category(1),name(2),addr(3),phone(4),major(5),intro(6),mid(7),imgpath(8)
foreach($ay as $b)
{
	if($b[0] == $_SESSION['CURR_USR'][0])
		continue;
	if($b[1] == 0) //专家
		array_push($xexp,$b);
	else
		array_push($xterm,$b);//团队
}
unset($ta);$ay=array();
$sel_exp=get_my_sel($esel1,$xexp);
$sel_term=get_my_sel($esel2,$xterm);
$ta=new tb_my_expert();
$a=0;$ay=array();
$ay=$ta->get_my_expert($a); //再取得已添加的专家团队
foreach($ay as $b)
{
	if($b[0] == $_SESSION['CURR_USR'][0])
		continue;
	if($b[1] == 1)
		array_push($term,$b);
	else
		array_push($exp,$b);	
}
//至此，数据取得完成，开始进行后置性操作：翻页的处理
$cnt[0]=floor(count($exp)/5);
if(count($exp)%5)
	$cnt[0]++;
$cnt[1]=floor(count($term)/5);
if(count($term)%5)
	$cnt[1]++;
$cnt[2]=floor(count($sel_exp)/5);
if(count($sel_exp)%5)
	$cnt[2]++;
$cnt[3]=floor(count($sel_term)/5);
if(count($sel_term)%5)
	$cnt[3]++;
if(isset($_GET['vendor']))
{
	$ven_act=array("","","","");
	$i=intval($_GET['vendor']);
	if($i<0 || $i >3)
		$i=0;	//防止越界
	$ven_act[$i]='active';
	if(isset($_GET['prevb']) || isset($_GET['nextb'])) //翻页按钮的动作
	{
		if(isset($_GET['prevb']))
			$curr_pg[$i]=intval($_GET['prevb'])+1;
		else
			$curr_pg[$i]=intval($_GET['nextb'])-1;
		if($curr_pg[$i] >= $cnt[$i])
			$curr_pg[$i] = 0;
	}
}//}}}
//{{{tab 2 相关的操作  邀请我的，可以是普通账户，也可以是认证账户
$my_ary=array();				//邀请我的队列
$err_msg1="<span>您还未被邀请吗？通过认证才会得到邀请</span>";
$ta=new tb_my_expert();
$i=$_SESSION['CURR_USR'][0];
$my_ary=$ta->get_invite_me($i);
$idt=$ta->err_no;
if($idt)
	$err_msg1="<div class='alert alert-warning' role='alert'><strong>提示：</strong>".$ta->err_msg()."</div>";
if(isset($_GET['action']) && ($_GET['action'] == 'true'))
{
	$cnt[4]=floor(count($my_ary)/5);
	if(count($my_ary)%5)
		$cnt[4]++;
	if(isset($_GET['prevc']) || isset($_GET['nextc'])) //翻页按钮的动作
	{
		if(isset($_GET['prevc']))
			$curr_pg[4]=intval($_GET['prevc'])+1;
		else
			$curr_pg[4]=intval($_GET['nextc'])-1;
		if($curr_pg[4] >= $cnt[4])
			$curr_pg[$i] = 0;
	}
	$tab_act=array("","active");	
}
//}}}
?>
<?php
//{{{左边导航栏栏
include_once('../template/def_setting.php');
//}}}
//{{{右边显示栏抬头		div +6
		$st2="<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li><a href='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE']."'>设置</a></li><li>我的合作";
		$st1=sprintf($SIG_HTML['RIGHT_TOP1'],$st2);
		echo $st1;
		echo "<div class='inner' id='modal_container' >\n<h2 class='sect first'>设置 / 我的合作</h2>\n";
		$st1="<div class='block'>
            <div class='panel shadow'>
                <!-- Nav tabs -->
                <ul class='nav nav-tabs nav-tabs-hor' role='tablist'>
                        <li role='presentation' class='%s'><a href='#share' aria-controls='share' role='tab' data-toggle='tab' data-history-enabled>我邀请的合作</a></li>
                        <li role='presentation' class='%s'><a href='#sharedwith' aria-controls='sharedwith' role='tab' data-toggle='tab' data-history-enabled>邀请我的合作</a></li>
                </ul>
                <div class='body'>                
                    <div class='body body-settings'>
                        <div class='tab-content'>";
		$st2=sprintf($st1,$tab_act[0],$tab_act[1]);
		echo $st2;
//}}}
//{{{横向标签页1
//{{{纵向标签页显示		div +3
		$st1="                <!-- Tab 1 -->
                                <div role='tabpanel' class='tab-pane %s' id='share'>
                                    <div class='inner-narrow inner-midnarrow'>   
    <div id='tip_msg2' class='intro-block intro-block-slim'><p>".$err_msg."</p></div>";
		$st2=sprintf($st1,$tab_act[0]);
		echo $st2;
            $st1= "<div class='nav-vendors'>
                    <!-- Vendor nav -->
                    <ul class='nav nav-tabs nav-tabs-vertical' role='tablist'>
                            <li role='presentation' class='%s' onclick='chg_msg_coll(1);'>
                                <a href='#vendor-amazon' role='tab' data-toggle='tab'>
                                    <i class='icon-user'></i><span>专家团队</span>
                                </a>
                            </li>
                            <li role='presentation' class='%s' onclick='chg_msg_coll(2);'>
                                <a href='#vendor-ebay' role='tab' data-toggle='tab'>
                                    <i class='icon-wechat'></i><span>业务伙伴</span>
                                </a>
							</li>
							<li role='presentation' class='%s' onclick='chg_msg_coll(3);'>
								<a href='#vendor-etsy' role='tab' data-toggle='tab'>
									<i class='icon-group'></i><span>查找专家</span>
								</a>
							</li>
							<li role='presentation' class='%s' onclick='chg_msg_coll(4);'>
								<a href='#vendor-delta' role='tab' data-toggle='tab'>
									<i class='icon-airplane'></i><span>查找团队</span>
								</a>
							</li>
                    </ul>";
		$st2=sprintf($st1,$ven_act[0],$ven_act[1],$ven_act[2],$ven_act[3]);
		echo $st2;
//}}}
//{{{纵向标签页 1内容   div +1
             $st1="<!-- Vendor Panes -->
                    <div class='tab-content tab-content-vertical'>
                            <div role='tabpanel' class='tab-pane %s' id='vendor-amazon'>
                                    <div class='shareblock'>
<ul class='list-unstyled list-accounts'>";
			$st2=sprintf($st1,$ven_act[0]);
			echo $st2;
$st1="<li>
          <div class='avatar'>
              <div class='circle'>
                    <img src='%s' alt='头像'/>
              </div>
          </div>
          <div class='account-info'>
              <p class='title'>
                     <strong>姓名：</strong>%s
              </p>
          </div>
          <div class='account-status'>
              <p class='desc'></p>
          </div>
          <div class='account-action'>
              <a href='#authorization%s' class='btn btn-outline' data-trigger='collapse'>详细信息</a>
          </div>
      </li>
      <li class='collapse' id='authorization%s'>
           <ul class='list-unstyled list-security'> <!-- start more info section -->
                <li>
                    <p class='title'>单位</p><p class='info'>%s</p>
                </li>
                <li>
                    <p class='title'>专业</p><p class='info'>%s</p>
                </li>
                <li>
                    <p class='title'>简介</p><p class='info'>%s</p>
                </li>
				<li>
					<div class='text-center'><a href='%s' style='color: #AE3E48; text-decoration: none; border-bottom: 1px solid #AE3E48;'>解除邀请</a></div>
				</li>
			</ul>
		</li>";
if(count($exp) > 0)
{
	//计算翻页
	if(isset($_GET['vendor']) && ($_GET['vendor'] == 0)) //保证不被其他标签页干扰
	{
		if(isset($_GET['nextb'])) //下翻页
		{
			if($curr_pg[0]<($cnt[0]-1))
				$curr_pg[0]++;
		}
		elseif(isset($_GET['prevb'])) //上翻页
		{
			if($curr_pg[0] > 0)
				$curr_pg[0]--;
		}
	}
	//uid(0),category(1),name(2),addr(3),phone(4),major(5),intro(6),mid(7),imgpath(8)
	$j=count($exp)-1;
	for($i=0;$i<5;$i++)
	{
		$k=$i+$curr_pg[0]*5;
		if($k>$j)
			break;
		$ay=array();
		$ay=$exp[$k];
		$cy=array($ay[7],0);
		$s1=get_major($cy);
		$s2=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FIV']."&action=".$ay[0]."&vendor=0";
		$st2=sprintf($st1,$ay[8],$ay[2],$i,$i,$ay[3],$s1,$ay[6],$s2);
		echo $st2;
	}
	echo "</ul>";
	//显示翻页
	$st1="<div class='shareblock-body'>
		<div class='text-center'>
		<a href='%s' style='%s'>&lt;&lt;</a>&nbsp;&nbsp;&nbsp;%d&nbsp;&nbsp;&nbsp;<a href='%s' style='%s'>&gt;&gt;</a>
		</div>
		</div>";
	if($curr_pg[0] == 0)
	{
		$sta1="color: gray; cursor: default; disabled: true;";
		$sta4="javascript:;";
	}
	else
	{
		$bb=intval($curr_pg[0])-1;
		$sta1="color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;";
		$sta4=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FIV']."&prevb=".$bb."&vendor=0";
	}
	if($curr_pg[0] >= ($cnt[0]-1))
	{
		$sta2="color: gray; cursor: default; disabled: true;";
		$sta3="javascript:;";
	}
	else
	{
		$bb=intval($curr_pg[0])+1;
		$sta2="color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;";
		$sta3=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FIV']."&nextb=".$bb."&vendor=0";
	}
	$st2=sprintf($st1,$sta4,$sta1,intval($curr_pg[0])+1,$sta3,$sta2);
	echo $st2;
}
else
{
	  $st1="</ul><div class='shareblock-body'>
            <ul class='list-unstyled list-shares'>
	             <p>您还没有邀请的专家</p>
            </ul>
            </div>";
	 echo $st1;
}
//	$err_txt="<div class='alert alert-warning' role='alert'><strong>提示：</strong>您还没邀请任何专家</div>";
echo "</div></div>";
//}}}
//{{{纵向标签页 2内容	div -0	
$st1="				<!-- my add -->
                            <div role='tabpanel' class='tab-pane %s' id='vendor-ebay'>
                                   <div class='shareblock'>
<ul class='list-unstyled list-accounts'>";
$st2=sprintf($st1,$ven_act[1]);echo $st2;
$st1="<li>
          <div class='avatar'>
              <div class='circle'>
                    <img src='%s' alt='头像'/>
              </div>
          </div>
          <div class='account-info'>
              <p class='title'>
                     <strong>单位：</strong>%s
              </p>
          </div>
          <div class='account-status'>
              <p class='desc'></p>
          </div>
          <div class='account-action'>
              <a href='#authorterm%s' class='btn btn-outline' data-trigger='collapse'>详细信息</a>
          </div>
      </li>
      <li class='collapse' id='authorterm%s'>
           <ul class='list-unstyled list-security'> <!-- start more info section -->
                <li>
                    <p class='title'>地址</p><p class='info'>%s</p>
                </li>
                <li>
                    <p class='title'>行业</p><p class='info'>%s</p>
                </li>
                <li>
                    <p class='title'>简介</p><p class='info'>%s</p>
                </li>
				<li>
					<div class='text-center'><a href='%s' style='color: #AE3E48; text-decoration: none; border-bottom: 1px solid #AE3E48;'>解除邀请</a></div>
				</li>
			</ul>
		</li>";
if(count($term) > 0)
{
	//计算翻页
	if(isset($_GET['vendor']) && ($_GET['vendor'] == 1)) //保证不被其他标签页干扰
	{
		if(isset($_GET['nextb'])) //下翻页
		{
			if($curr_pg[1]<($cnt[1]-1))
				$curr_pg[1]++;
		}
		elseif(isset($_GET['prevb'])) //上翻页
		{
			if($curr_pg[1] > 0)
				$curr_pg[1]--;
		}
	}
	//uid(0),category(1),name(2),addr(3),phone(4),major(5),intro(6),mid(7),imgpath(8)
	$j=count($term)-1;
	for($i=0;$i<5;$i++)
	{
		$k=$i+$curr_pg[1]*5;
		if($k>$j)
			break;
		$ay=array();
		$ay=$term[$k];
		$cy=array($ay[7],1);
		$s1=get_major($cy);
		$s2=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FIV']."&action=".$ay[0]."&vendor=1";
		$st2=sprintf($st1,$ay[8],$ay[2],$i,$i,$ay[3],$s1,$ay[6],$s2);
		echo $st2;
	}
	echo "</ul>";
	//显示翻页
	$st1="<div class='shareblock-body'>
		<div class='text-center'>
		<a href='%s' style='%s'>&lt;&lt;</a>&nbsp;&nbsp;&nbsp;%d&nbsp;&nbsp;&nbsp;<a href='%s' style='%s'>&gt;&gt;</a>
		</div>
		</div>";
	if($curr_pg[1] == 0)
	{
		$sta1="color: gray; cursor: default; disabled: true;";
		$sta4="javascript:;";
	}
	else
	{
		$bb=intval($curr_pg[1])-1;
		$sta1="color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;";
		$sta4=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FIV']."&preva=".$bb."&vendor=1";
	}
	if($curr_pg[1] >= ($cnt[1]-1))
	{
		$sta2="color: gray; cursor: default; disabled: true;";
		$sta3="javascript:;";
	}
	else
	{
		$bb=intval($curr_pg[1])+1;
		$sta2="color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;";
		$sta3=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FIV']."&nexta=".$bb."&vendor=1";
	}
	$st2=sprintf($st1,$sta4,$sta1,intval($curr_pg[1])+1,$sta3,$sta2);
	echo $st2;
}
else
{
	  $st1="</ul><div class='shareblock-body'>
            <ul class='list-unstyled list-shares'>
	             <p>您还没有邀请的团队</p>
            </ul>
            </div>";
	 echo $st1;
}
echo "</div></div>";
//}}}
//{{{纵向标签页 3内容 div -0
$st1="				<!-- my add -->
                            <div role='tabpanel' class='tab-pane %s' id='vendor-etsy'>
                                   <div class='shareblock'>
<ul class='list-unstyled list-accounts'>";
$st2=sprintf($st1,$ven_act[2]);echo $st2;
$st1="<li>
          <div class='avatar'>
              <div class='circle'>
                    <img src='%s' alt='头像'/>
              </div>
          </div>
          <div class='account-info'>
              <p class='title'>
                     <strong>姓名：</strong>%s
              </p>
          </div>
          <div class='account-status'>
              <p class='desc'></p>
          </div>
          <div class='account-action'>
              <a href='#authorselterm%s' class='btn btn-outline' data-trigger='collapse'>详细信息</a>
          </div>
      </li>
      <li class='collapse' id='authorselterm%s'>
           <ul class='list-unstyled list-security'> <!-- start more info section -->
                <li>
                    <p class='title'>单位</p><p class='info'>%s</p>
                </li>
                <li>
                    <p class='title'>专业</p><p class='info'>%s</p>
                </li>
                <li>
                    <p class='title'>简介</p><p class='info'>%s</p>
                </li>
				<li>
					<div class='text-center'><a href='%s' style='color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;'>加入合作</a></div>
				</li>
			</ul>
		</li>";
if(count($sel_exp) > 0)
{
	//计算翻页
	if(isset($_GET['vendor']) && ($_GET['vendor'] == 2)) //保证不被其他标签页干扰
	{
		if(isset($_GET['nextb'])) //下翻页
		{
			if($curr_pg[2]<($cnt[2]-1))
				$curr_pg[2]++;
		}
		elseif(isset($_GET['prevb'])) //上翻页
		{
			if($curr_pg[2] > 0)
				$curr_pg[2]--;
		}
	}
	//uid(0),category(1),name(2),addr(3),phone(4),major(5),intro(6),mid(7),imgpath(8)
	$j=count($sel_exp)-1;
	for($i=0;$i<5;$i++)
	{
		$k=$i+$curr_pg[2]*5;
		if($k>$j)
			break;
		$ay=array();
		$ay=$sel_exp[$k];
		$cy=array($ay[7],0);
		$s1=get_major($cy);
		$s2=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FIV']."&action=".$ay[0]."&vendor=2";
		$st2=sprintf($st1,$ay[8],$ay[2],$i,$i,$ay[3],$s1,$ay[6],$s2);
		echo $st2;
	}
	echo "</ul>";
	//显示翻页
	$st1="<div class='shareblock-body'>
		<div class='text-center'>
		<a href='%s' style='%s'>&lt;&lt;</a>&nbsp;&nbsp;&nbsp;%d&nbsp;&nbsp;&nbsp;<a href='%s' style='%s'>&gt;&gt;</a>
		</div>
		</div>";
	if($curr_pg[2] == 0)
	{
		$sta1="color: gray; cursor: default; disabled: true;";
		$sta4="javascript:;";
	}
	else
	{
		$bb=intval($curr_pg[2])-1;
		$sta1="color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;";
		$sta4=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FIV']."&preva=".$bb."&vendor=3";
	}
	if($curr_pg[2] >= ($cnt[2]-1))
	{
		$sta2="color: gray; cursor: default; disabled: true;";
		$sta3="javascript:;";
	}
	else
	{
		$bb=intval($curr_pg[2])+1;
		$sta2="color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;";
		$sta3=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FIV']."&nexta=".$bb."&vendor=3";
	}
	$st2=sprintf($st1,$sta4,$sta1,intval($curr_pg[2])+1,$sta3,$sta2);
	echo $st2;
}
else
{
	  $st1="</ul><div class='shareblock-body'>
            <ul class='list-unstyled list-shares'>
	             <p>请按行业选择您需要的专家</p>
            </ul>
            </div>";
	 echo $st1;
}
//开始专家的按条件选择界面
$sta3=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FIV']."&action=false&vendor=2";
$st1="<form name='form2' method='post' action='".$sta3."'>
<div class='shareblock-headz shareblock-headz-light'><p>污水处理专业</p><div class='btn-shareaccount'>
<label class='check'><input type='checkbox' name='checkn[]' value='1' class='switch' ".$glb_chk[0]."/>污水处理</label></div></div>
<div class='shareblock-headz shareblock-headz-light'><p>废气治理专业</p><div class='btn-shareaccount'>
<label class='check'><input type='checkbox' name='checkn[]' value='2' class='switch' ".$glb_chk[1]."/>废气治理</label></div></div>
<div class='shareblock-headz shareblock-headz-light'><p>噪音治理专业</p><div class='btn-shareaccount'>
<label class='check'><input type='checkbox' name='checkn[]' value='4' class='switch' ".$glb_chk[2]."/>噪音治理</label></div></div>
<div class='shareblock-headz shareblock-headz-light'><p>危废处理专业</p><div class='btn-shareaccount'>
<label class='check'><input type='checkbox' name='checkn[]' value='8' class='switch' ".$glb_chk[3]."/>危废处理</label></div></div>
<div class='shareblock-headz shareblock-headz-light'><p>环境工程专业</p><div class='btn-shareaccount'>
<label class='check'><input type='checkbox' name='checkn[]' value='16' class='switch' ".$glb_chk[4]."/>环境工程</label></div></div>
<div class='shareblock-headz shareblock-headz-light'><p>项目审批专业</p><div class='btn-shareaccount'>
<label class='check'><input type='checkbox' name='checkn[]' value='32' class='switch' ".$glb_chk[5]."/>项目审批</label></div></div>
<div class='shareblock-headz shareblock-headz-light'><p>化验分析专业</p><div class='btn-shareaccount'>
<label class='check'><input type='checkbox' name='checkn[]' value='64' class='switch' ".$glb_chk[6]."/>化验分析</label></div></div>
<div class='shareblock-headz shareblock-headz-light'><p>法律事务专业</p><div class='btn-shareaccount'>
<label class='check'><input type='checkbox' name='checkn[]' value='128' class='switch' ".$glb_chk[7]."/>法律事务</label></div></div>
<div class='shareblock-body'><div class='text-center'><br>
<button type='submit' class='btn btn-primary' id='ch001' name='ch001'>按条件查询</button>
</div></div>
</form>";
echo $st1;
echo "</div></div>";
//}}}
//{{{纵向标签页 4内容 div -4
$st1="				<!-- my add -->
                            <div role='tabpanel' class='tab-pane %s' id='vendor-delta'>
                                   <div class='shareblock'>
<ul class='list-unstyled list-accounts'>";
$st2=sprintf($st1,$ven_act[3]);echo $st2;
$st1="<li>
          <div class='avatar'>
              <div class='circle'>
                    <img src='%s' alt='头像'/>
              </div>
          </div>
          <div class='account-info'>
              <p class='title'>
                     <strong>单位：</strong>%s
              </p>
          </div>
          <div class='account-status'>
              <p class='desc'></p>
          </div>
          <div class='account-action'>
              <a href='#authorselterm%s' class='btn btn-outline' data-trigger='collapse'>详细信息</a>
          </div>
      </li>
      <li class='collapse' id='authorselterm%s'>
           <ul class='list-unstyled list-security'> <!-- start more info section -->
                <li>
                    <p class='title'>地址</p><p class='info'>%s</p>
                </li>
                <li>
                    <p class='title'>行业</p><p class='info'>%s</p>
                </li>
                <li>
                    <p class='title'>简介</p><p class='info'>%s</p>
                </li>
				<li>
					<div class='text-center'><a href='%s' style='color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;'>加入合作</a></div>
				</li>
			</ul>
		</li>";
if(count($sel_term) > 0)
{
	//计算翻页
	if(isset($_GET['vendor']) && ($_GET['vendor'] == 3)) //保证不被其他标签页干扰
	{
		if(isset($_GET['nextb'])) //下翻页
		{
			if($curr_pg[3]<($cnt[3]-1))
				$curr_pg[3]++;
		}
		elseif(isset($_GET['prevb'])) //上翻页
		{
			if($curr_pg[3] > 0)
				$curr_pg[3]--;
		}
	}
	//uid(0),category(1),name(2),addr(3),phone(4),major(5),intro(6),mid(7),imgpath(8)
	$j=count($sel_term)-1;
	for($i=0;$i<5;$i++)
	{
		$k=$i+$curr_pg[3]*5;
		if($k>$j)
			break;
		$ay=array();
		$ay=$sel_term[$k];
		$cy=array($ay[7],1);
		$s1=get_major($cy);
		$s2=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FIV']."&action=".$ay[0]."&vendor=3";
		$st2=sprintf($st1,$ay[8],$ay[2],$i,$i,$ay[3],$s1,$ay[6],$s2);
		echo $st2;
	}
	echo "</ul>";
	//显示翻页
	$st1="<div class='shareblock-body'>
		<div class='text-center'>
		<a href='%s' style='%s'>&lt;&lt;</a>&nbsp;&nbsp;&nbsp;%d&nbsp;&nbsp;&nbsp;<a href='%s' style='%s'>&gt;&gt;</a>
		</div>
		</div>";
	if($curr_pg[3] == 0)
	{
		$sta1="color: gray; cursor: default; disabled: true;";
		$sta4="javascript:;";
	}
	else
	{
		$bb=intval($curr_pg[3])-1;
		$sta1="color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;";
		$sta4=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FIV']."&preva=".$bb."&vendor=3";
	}
	if($curr_pg[3] >= ($cnt[3]-1))
	{
		$sta2="color: gray; cursor: default; disabled: true;";
		$sta3="javascript:;";
	}
	else
	{
		$bb=intval($curr_pg[3])+1;
		$sta2="color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;";
		$sta3=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FIV']."&nexta=".$bb."&vendor=3";
	}
	$st2=sprintf($st1,$sta4,$sta1,intval($curr_pg[3])+1,$sta3,$sta2);
	echo $st2;
}
else
{
	  $st1="</ul><div class='shareblock-body'>
            <ul class='list-unstyled list-shares'>
	             <p>请按行业选择您需要的团队</p>
            </ul>
            </div>";
	 echo $st1;
}
//echo "</div>";
//开始专家的按条件选择界面
$sta3=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FIV']."&action=false&vendor=3";
$st1="<form name='form2' method='post' action='".$sta3."'>
<div class='shareblock-headz shareblock-headz-light'><p>环境服务行业</p><div class='btn-shareaccount'>
<label class='check'><input type='checkbox' name='checkm[]' value='1' class='switch' ".$glb_chk1[0]."/>环境服务</label></div></div>
<div class='shareblock-headz shareblock-headz-light'><p>仪器设备行业</p><div class='btn-shareaccount'>
<label class='check'><input type='checkbox' name='checkm[]' value='2' class='switch' ".$glb_chk1[1]."/>仪器设备</label></div></div>
<div class='shareblock-headz shareblock-headz-light'><p>污水处理行业</p><div class='btn-shareaccount'>
<label class='check'><input type='checkbox' name='checkm[]' value='4' class='switch' ".$glb_chk1[2]."/>污水处理</label></div></div>
<div class='shareblock-headz shareblock-headz-light'><p>石油化工行业</p><div class='btn-shareaccount'>
<label class='check'><input type='checkbox' name='checkm[]' value='8' class='switch' ".$glb_chk1[3]."/>石油化工</label></div></div>
<div class='shareblock-headz shareblock-headz-light'><p>食品药品行业</p><div class='btn-shareaccount'>
<label class='check'><input type='checkbox' name='checkm[]' value='16' class='switch' ".$glb_chk1[4]."/>食品药品</label></div></div>
<div class='shareblock-headz shareblock-headz-light'><p>餐饮服务行业</p><div class='btn-shareaccount'>
<label class='check'><input type='checkbox' name='checkm[]' value='32' class='switch' ".$glb_chk1[5]."/>餐饮服务</label></div></div>
<div class='shareblock-headz shareblock-headz-light'><p>畜禽养殖行业</p><div class='btn-shareaccount'>
<label class='check'><input type='checkbox' name='checkm[]' value='64' class='switch' ".$glb_chk1[6]."/>畜禽养殖</label></div></div>
<div class='shareblock-headz shareblock-headz-light'><p>其他行业</p><div class='btn-shareaccount'>
<label class='check'><input type='checkbox' name='checkm[]' value='128' class='switch' ".$glb_chk1[7]."/>其他行业</label></div></div>
<div class='shareblock-body'><div class='text-center'><br>
<button type='submit' class='btn btn-primary' id='ch002' name='ch002'>按条件查询</button>
</div></div>
</form>";
echo $st1;
echo "</div></div>";

echo "</div></div></div></div>";
//}}}

//}}}
//{{{横向标签页2	div -6								
echo"<div role='tabpanel' class='tab-pane ".$tab_act[1]."' id='sharedwith'>
         <div class='inner-narrow inner-midnarrow'>
    		<div class='intro-block intro-block-slim'>
       			 <p>邀请你的合作</p>
		    </div>";
//{{{下面是新加的代码
echo"<div class='shareblock'><ul class='list-unstyled list-accounts'>";
$st1="<li>
          <div class='avatar'>
              <div class='circle'>
                    <img src='%s' alt='头像'/>
              </div>
          </div>
          <div class='account-info'>
              <p class='title'>
                     <strong>%s：</strong>%s
              </p>
          </div>
          <div class='account-status'>
              <p class='desc'></p>
          </div>
          <div class='account-action'>
              <a href='#zation%s' class='btn btn-outline' data-trigger='collapse'>详细信息</a>
          </div>
      </li>
      <li class='collapse' id='zation%s'>
           <ul class='list-unstyled list-security'> <!-- start more info section -->
                <li>
                    <p class='title'>账户类型</p><p class='info'>%s</p>
                </li>
                <li>
                    <p class='title'>%s</p><p class='info'>%s</p>
                </li>
                <li>
                    <p class='title'>专业</p><p class='info'>%s</p>
                </li>
                <li>
                    <p class='title'>简介</p><p class='info'>%s</p>
                </li>
				<li>
					<div class='text-center'><a href='%s' style='color: #AE3E48; text-decoration: none; border-bottom: 1px solid #AE3E48;'>解除邀请</a></div>
				</li>
			</ul>
		</li>";
if($idt == 0)
{
	if(isset($_GET['nextc'])) //下翻页
	{
		if($curr_pg[4]<($cnt[4]-1))
			$curr_pg[4]++;
	}
	elseif(isset($_GET['prevc'])) //上翻页
	{
		if($curr_pg[4] > 0)
			$curr_pg[4]--;
	}
	$j=count($my_ary)-1;
	for($i=0;$i<5;$i++)
	{
		$k=$i+$curr_pg[4]*5;
		if($k>$j)
			break;
		$cy=array();
		$ay=array();
		$ay=$my_ary[$k];
		if(count($ay) == 3) //普通账户
		{
			$cy[0]=$ay[2];//头像
			$cy[1]="昵称";$cy[2]=$ay[1];//uname
			$cy[3]=$i;$cy[4]=$i;
			$cy[5]="普通账户";
			$cy[6]="单位";$cy[7]="";
			$cy[8]="";$cy[9]="";
			$cy[10]=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FIV']."&action=true&iid=".$ay[0];
		}
		else
		{
			$cy[0]=$ay[8];//头像
			if($ay[1])
			{
				$cy[1]="单位";$cy[5]="认证团队账户";
				$cy[6]="地址";$cy[7]=$ay[3];
				$dy=array($ay[7],1);
				$cy[8]=get_major($dy);
			}
			else
			{
				$cy[1]="姓名";$cy[5]="认证专家账户";
				$cy[6]="单位";$cy[7]=$ay[3];
				$dy=array($ay[7],0);
				$cy[8]=get_major($dy);
			}
			$cy[2]=$ay[2];
			$cy[3]=$i;$cy[4]=$i;
			$cy[9]=$ay[6];
			$cy[10]=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FIV']."&action=true&iid=".$ay[0];
		}
		if($cy[0] == "")
			$cy[0]=constant("DEF_IMG");
		$st2=sprintf($st1,$cy[0],$cy[1],$cy[2],$cy[3],$cy[4],$cy[5],$cy[6],$cy[7],$cy[8],$cy[9],$cy[10]);
		echo $st2;
	}
	echo"</ul>";
	//显示翻页
	$st1="<div class='shareblock-body'>
		<div class='text-center'>
		<a href='%s' style='%s'>&lt;&lt;</a>&nbsp;&nbsp;&nbsp;%d&nbsp;&nbsp;&nbsp;<a href='%s' style='%s'>&gt;&gt;</a>
		</div>
		</div>";
	if($curr_pg[4] == 0)
	{
		$sta1="color: gray; cursor: default; disabled: true;";
		$sta4="javascript:;";
	}
	else
	{
		$bb=intval($curr_pg[4])-1;
		$sta1="color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;";
		$sta4=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FIV']."&prevc=".$bb."&action=true";
	}
	if($curr_pg[4] >= ($cnt[4]-1))
	{
		$sta2="color: gray; cursor: default; disabled: true;";
		$sta3="javascript:;";
	}
	else
	{
		$bb=intval($curr_pg[4])+1;
		$sta2="color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;";
		$sta3=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FIV']."&nextc=".$bb."&action=true";
	}
	$st2=sprintf($st1,$sta4,$sta1,intval($curr_pg[4])+1,$sta3,$sta2);
	echo $st2;
}
echo"</div>";
//}}}
   			echo"<div id='account_collaborations'>
    		     <div  class='text-center'>".$err_msg1."
		         </div>
   			</div>";
		echo"</div>
     </div>";
//}}}	 
echo"</div></div></div></div></div></div>";
echo"
            <script>
                $('input[type='checkbox'].switch').checkbox({
                    toggle: true,
                });
            </script>
";
	 echo $SIG_HTML['RIGHT_TOP3'];
?>
