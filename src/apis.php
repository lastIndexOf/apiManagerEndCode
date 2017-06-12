<?php

include $_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/src/MySqlPDO.class.php';
api();

function api(){
	session_start();
	include $_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/src/request.php';
	switch ($request) {
		case 'POST':
			dopost($data);
			break;
		case 'PUT':
			doput($data);
			break;
		
		default:
			# code...
			break;
	}
}

function doput($data){//不能修改文档 API的id
	$apisid = $data['apisid'];
	$type = $data['type'];
	$url = $data['url'];
	$desc = $data['desc'];
	$result = array();
	if( isset($apisid) && isset($type) && isset($url) && isset($desc) )  {
		$update = "update `api` set `desc`=?,`type`=?,`url`=? where `id` = ?";
		$mysqlpdo = new MySqlPDO();
		$myarray = array($desc,$type,$url,$apisid);
		$mysqlpdo->prepare($update);
		if ($mysqlpdo->executeArr($myarray)) {
			$result['result'] = '1';
		}else{
			$result['result'] = '0';
			$result['msg'] = '插入数据有错误';
		}

	}else{
		$result['result'] = '0';
		$result['msg'] = '传送数据有空，错误';
	}
	echo json_encode($result);

}

function dopost($data){
	$docsid = $data['docsid'];
	$type = $data['type'];
	$url = $data['url'];
	$desc = $data['desc'];
	$result = array();

	if (isset($docsid) && isset($type) && isset($url) && isset($desc) ) {
		$insert_sql = "insert into `api` (`docsid`,`type`,`url`,`desc`) values(?,?,?,?)";
		$mysqlpdo = new MySqlPDO();
		$myarray = array($docsid,$type,$url,$desc);
		$mysqlpdo->prepare($insert_sql);

		if ($mysqlpdo->executeArr($myarray)) {
			$result['result'] = '1';
		}else{
			$result['result'] = '0';
			$result['msg'] = '插入数据有错误';
		}


	}else{
		$result['result'] = '0';
		$result['msg'] = '传送数据有空，错误';
	}
	echo json_encode($result);
}

?>