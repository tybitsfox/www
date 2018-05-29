<?php
//header ( "Content-type:application/vnd.ms-excel" );
//header ( "Content-Disposition:filename=/tmp/csat.xls" );
/*echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<title>无标题文档</title>
</head>
<body>";
echo "</body></html>";*/
?>
<?php
session_start();
if(!defined("FULL_PATH"))
{
	$s1=dirname(__FILE__);
	$s2=strstr($s1,"php_hl");
	$i=strlen($s1)-strlen($s2);
	$s2=substr($s1,0,$i)."php_hl/";
	define("FULL_PATH",$s2);
}
$_SESSION['EXCEL_OUT']="excel_out";
$str=constant("FULL_PATH")."interface/main.php";
require_once($str);
header ( "Content-type:application/vnd.ms-excel" );
switch($_SESSION['EXCEL_TYPE'])
{
case 0://NULL
	header ( "Content-Disposition:filename=sheet.xls" );
	break;
case 1://ssfs
	header ( "Content-Disposition:filename=ssfs.xls" );
	break;
case 2://ssfq
	header ( "Content-Disposition:filename=ssfq.xls" );
	break;
case 3://sswsc
	header ( "Content-Disposition:filename=sswsc.xls" );
	break;
case 4://mxfs
	header ( "Content-Disposition:filename=mxfs.xls" );
	break;
case 5://mxfq
	header ( "Content-Disposition:filename=mxfq.xls" );
	break;
case 6://mxwsc
	header ( "Content-Disposition:filename=mxwsc.xls" );
	break;
}
//header ( "Content-Disposition:filename=sheet.xls" );
echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<title>无标题文档</title>
<style>
table.imagetable {
	font-family: verdana,arial,sans-serif;
	font-size:12px;
	color:#333333;
	border-width: 1px;
	border-color: #999999;
	border-collapse: collapse;
}
table.imagetable th {
	background:#b5cfd2;
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #999999;
}
table.imagetable td {
	background:#dcddc0;
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #999999;
}
#tdid{
	background:#dcddc0;
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #999999;
	color:#ff0000
}
</style>
</head><body>";
switch($_SESSION['EXCEL_TYPE'])
{
case 0:
	break;
case 1: //fs	
	$a=new tb_fs();
	$a->show_header();
	$a->show_body();
	$a->show_tail();
	break;
case 2://fq
	$a=new tb_fq();
	$a->show_header();
	$a->show_body();
	$a->show_tail();
	break;
case 3://wsc
	$a=new tb_wsc();
	$a->show_header();
	$a->show_body();
	$a->show_tail();
	break;
case 4://fsmx
	$a=new tb_fs_mx();
	$a->show_header();
	$a->show_body();
	$a->show_tail();
	break;
case 5://fqmx
	$a=new tb_fq_mx();
	$a->show_header();
	$a->show_body();
	$a->show_tail();
	break;
case 6://wscmx
	$a=new tb_wsc_mx();
	$a->show_header();
	$a->show_body();
	$a->show_tail();
	break;	
}
echo "</body></html>";
?>
