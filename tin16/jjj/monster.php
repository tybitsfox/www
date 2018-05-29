<?php
echo "<html><head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<link href='./main.css' rel='stylesheet' type='text/css' />";
echo "<style type='text/css'>
body{ text-align:center} 
#divcenter{margin:0 auto;width:800px}</style>";
echo "<style>
  #liu img {border:0;}
  #liu a {color:#933; text-decoration:none;}
  #liu ul, li {margin:0; padding:0; list-style:none;}
  .clear {clear:both; line-height:1px;}

  img.series {background:url(pic/sl.gif) no-repeat; vertical-align:middle; width:24px; height:24px;}
  img.series0 {background:url(pic/ss.gif) no-repeat; vertical-align:middle; width:12px; height:12px; margin-top:-3px; margin-right:3px;}
  img.monster {background:url(pic/ml.gif) no-repeat; vertical-align:middle; width:32px; height:32px;}

  div#s_list {margin:5px 0 10px;}
  div#s_list img {margin-left:4px;}
  div#sm_list {position:absolute; z-index:5; margin-left:30px; width:245px; background-color:#eee; border:1px solid #aa88ff;}
  div#sm_head {height:25px; line-height:25px; padding-left:20px; background-color:#fa6;}
  div#sm_head span {float:right; margin-right:5px; margin-top:4px; line-height:14px; padding:0 4px; border:1px solid #666; background-color:#ccc; cursor:pointer; font-family:tahoma;}
  div#sm_slist {float:left; margin:5px; display:inline; background-color:#fff; width:90px; height:300px;}
  div#sm_slist li {padding:6px 0 0 2px; line-height:18px; border-bottom:1px dashed #aaa;}
  div#sm_slist li img {margin-top:-4px;}
  div#sm_mlist {float:left; margin:5px 5px 5px 0; display:inline; background-color:#fff; width:140px; height:300px; overflow-x:hidden; overflow-y:auto;}
  div#sm_mlist li {padding:8px 0 2px 5px; line-height:24px; border-bottom:1px dashed #aaa;}
  div#sm_mlist li img {margin-top:-6px;}
  div#sm_list li.selected {background-color:#e0ffff;}

  div#km_list {position:absolute; z-index:5; margin-left:25px; width:255px; background-color:#eee; border:1px solid #aa88ff;}
  div#km_head {height:25px; line-height:25px; padding-left:20px; background-color:#fa6;}
  div#km_head span {float:right; margin-right:5px; margin-top:4px; line-height:14px; padding:0 4px; border:1px solid #666; background-color:#ccc; cursor:pointer; font-family:tahoma;}
  div#km_klist {float:left; margin:5px; display:inline; background-color:#fff; width:100px; height:300px; overflow-x:hidden; overflow-y:auto;}
  div#km_klist li {padding:6px 0 0 2px; line-height:18px; border-bottom:1px dashed #aaa;}
  div#km_klist li img {margin-top:-4px;}
  div#km_mlist {float:left; margin:5px 5px 5px 0; display:inline; background-color:#fff; width:140px; height:300px; overflow-x:hidden; overflow-y:auto;}
  div#km_mlist li {padding:8px 0 2px 5px; line-height:24px; border-bottom:1px dashed #aaa;}
  div#km_mlist li img {margin-top:-6px;}
  div#km_list li.selected {background-color:#e0ffff;}

  div.mi_left {float:left; width:100px;}
  div.mi_right {float:left; margin-left:10px; width:200px;}
  div#m_logo {width:98px; height:98px; text-align:center;}
  div#m_logo img {border:1px solid #f96;}
  div#m_rels {margin:3px 1px 0;}
  div#m_info {font-size:14px; font-weight:bold; line-height:130%;}
  div#m_info span {font-size:12px; font-weight:normal;}
  div#m_skil table {width:150px;; border:1px solid #888;}
  div#m_skil table th {background-color:#bbad88; text-align:center; border-right:1px solid #aaa;}
  div#m_skil table td {padding:4px 5px 1px; border-top:1px dotted #aaa;}
  div#m_skil table td a {color:#633;}
  div#m_skil table tr.htt td {border-top:0;}
  div#m_data {margin-top:10px;}
  div#m_resist {margin-top:5px;}
  table.mdata {width:100%; border:1px solid #888; border-top:0;}
  table.mdata th, table.mdata td {padding:4px 0; text-align:center; border-left:1px dotted #aaa;}
  table.mdata th {background-color:#bbad88; border-top:1px solid #888; border-bottom:1px solid #bbb;}
  table.mdata th.lbn, table.mdata td.lbn {border-left:0;}
  div.selop {position:absolute;}
  div.selop span {display:inline-block; height:18px; line-height:18px; width:19px; text-align:center; cursor:pointer; background-color:#f4f4f4; border:1px solid #888; margin-right:8px;}
  div.selop span.sel {background-color:#c0ff80;}
  div#s_lang {margin-left:225px;}
  div#s_xlop {margin-left:190px; margin-top:-24px;}

  div#m_xlchg {margin-top:10px; position:relative;}
  div#m_xlchg span {display:inline-block; line-height:22px; padding:0 10px; cursor:pointer; background-color:#eee; border:1px solid #888;}
  div#m_xlchg span.selected {background-color:#bbad88;  border-bottom:1px solid #bbad88;}
  div#m_xlist {margin:-1px 0 20px;}
  div#m_xlist table {width:100%; border:1px solid #888;}
  div#m_xlist th {padding:4px 0; line-height:20px; background-color:#bbad88; border-bottom:1px solid #bbb;}
  div#m_xlist td {padding:8px 0 2px 0; line-height:24px; border-bottom:1px dotted #aaa;}
  div#m_xlist td img {margin-top:-6px;}
  div#m_xlist th.memo, div#m_xlist td.memo {text-align:center; padding-left:0; border-left:1px dotted #aaa;}
  div#m_xlist .bleft {border-left:1px dashed #aaa;}
  div#m_xlist img.series {margin-left:4px; margin-right:4px;}
</style>
<script type='text/javascript' src='dqm.js'></script>
</head>
<body>
<p>写个简单的说明，选择最上面的种类图即可选择怪物，选择窗中左边是怪物系别，右边是该系别的怪物列表；<br />点击特技可以根据该特技查找怪物，选择窗中左边为特技列表，右边为拥有该特技的怪物。点击中日英即可切换特技语言；<br>
配合中显示的怪物，点击即可查看改怪物的详细资料。
</p><center>
<div style='width:466px; margin:0 20px;' id='liu'>
  <div id='s_list'></div>
  <div id='sm_list' style='display:none;'>
    <div id='sm_head'><span onclick='closeMl();'>X</span>选择怪兽</div>
    <div id='sm_slist'></div>
    <div id='sm_mlist'></div>
  </div>
  <div id='km_list' style='display:none;'>
    <div id='km_head'><span onclick='closeKl();'>X</span>查看特技</div>
    <div id='km_klist'></div>
    <div id='km_mlist'></div>
  </div>
  <div class='clear'></div>
  <div>
    <div class='mi_left'>
      <div id='m_logo'></div>
      <div id='m_rels'></div>
    </div>
    <div class='mi_right'>
      <div id='m_info'></div>
      <div id='m_skil'></div>
    </div>
  </div>
  <div class='clear'></div>
  <div id='m_data'></div>
  <div id='m_resist'></div>
  <div id='m_xlchg'>
    <span id='m_xlsp_1' class='selected' onclick='chgXX(1);'>配合</span>
    <span id='m_xlsp_2' onclick='chgXX(2)'>血统</span>
    <span id='m_xlsp_3' onclick='chgXX(3)'>对象</span>
  </div>
  <div id='m_xlist'></div>
</div></center>
<script type='text/javascript'>initSl();</script>";
echo "</body></html>";
?>
<?php
//  <div id='s_lang' class='selop'><span class='sel' onclick='chgLn(0)'>中</span><span onclick='chgLn(1)'>日</span><span onclick='chgLn(2)'>英</span></div>
//  <div id='s_xlop' class='selop'><span class='sel' onclick='chgSxs()'>系</span><span class='sel' onclick='chgVn(1)' style='width:22px;'>GB1</span><span class='sel' onclick='chgVn(2)' style='width:22px;'>GB2</span><span class='sel' onclick='chgVn(3)'>PS</span></div>
?>
<?php
include_once("/var/www/counter.php");
upcounter(__FILE__)
?>
