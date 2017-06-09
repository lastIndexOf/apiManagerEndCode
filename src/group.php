<?php

include $_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/src/MySqlPDO.class.php';
include $_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/src/request.php';

function group($request){
	case 'POST':
		dopost($data);
		break;

}


function dopost($data){
	$result = array();
	$ids = explode("+",$data['ids']);
	$name = $data['name'];
	$mypdopdo = new MySqlPDO();
	$insert_group_name="insert into group (name) values(?)";
	$mypdopdo->prepare($insert_group_name);
	$myarray = array($name);
	if ($mypdopdo->executeArr($myarray)) {
		$lastid = $mypdopdo->lastInsertId();
		$result['result']='1';
		$result['id'] = $lastid;
		for ($i=0; $i < count($ids); $i++) { 
			
		}
	}else{
		$result['result']='0';
		$result['msg']='组纯收入数据库错误';
	}




}


?>