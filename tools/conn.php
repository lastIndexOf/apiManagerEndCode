<?php
	$root=$_SERVER['DOCUMENT_ROOT'];
	$myconfig=parse_ini_file($root."/apiManagerEndCode/config/config.ini",true);
	$myip=$myconfig['MYSQL']['ip'];
	$myusername=$myconfig['MYSQL']['username'];
	$mypaw=$myconfig['MYSQL']['password'];
	$mydatabase=$myconfig['MYSQL']['database'];
	date_default_timezone_set('PRC');//此句用于消除时间差
	$conn = mysql_connect($myip,$myusername,$mypaw)or die("error connecting") ; //连接数据库
	mysql_query("set names 'utf8'"); //数据库输出编码 应该与你的数据库编码保持一致.南昌网站建设公司百恒网络PHP工程师建议用UTF-8 国际标准编码.
	mysql_select_db($mydatabase); //打开数据库
	//$sql="delete  from `teacher` where id=2";
	//$rs=mysql_query($sql);
?>