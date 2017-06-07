<?php
	$root=$_SERVER['DOCUMENT_ROOT'];
	$myconfig=parse_ini_file($root."/apiManagerEndCode/config/config.ini",true);
	$myip=$myconfig['MYSQL']['ip'];
	$myusername=$myconfig['MYSQL']['username'];
	$mypaw=$myconfig['MYSQL']['password'];
	$mydatabase=$myconfig['MYSQL']['database'];
	$dsn = "mysql:host=".$myip.";dbname=".$mydatabase;
	date_default_timezone_set('PRC');//此句用于消除时间差
	$db = new PDO($dsn,$myusername,$mypaw); //连接数据库
	$db->exec('set names utf-8'); //数据库输出编码 应该与你的数据库编码保持一致.
	
?>