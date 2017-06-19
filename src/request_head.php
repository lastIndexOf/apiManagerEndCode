<?php

include $_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/src/MySqlPDO.class.php';
request_head();



function request_head(){
	session_start();
	include $_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/src/request.php';

	switch($request){
		case 'POST':
			dopost($data);
			break;
		case 'DELETE':
			dodelete($data);
			break;
		case 'PUT':
			doput($data);
			break;
		case 'GET':
			doget($data);
			break;
	}
}
function doget($data){
	if (isset($data['type']) && !empty($data['type'])) {
		switch ($data['type']) {
			case '1':
				getByAPIId($data['api_id']);
				break;
			case '2':
				getByHeadId($data['head_id']);
				break;
			default:
				# code...
				break;
		}
	}

}

function getByAPIId($apiid){
	$select_sql = "select * from `request_head` where `api_id` = ?";

	$myarray = array($apiid);

	$result = array();
	$result['resultList']=array();

	$mysqlpdo = new MySqlPDO();
	$mysqlpdo->prepare($select_sql);

	if ($mysqlpdo->executeArr($myarray) ) {
		while($rs = $mysqlpdo->fetch()){
			$tmp = array();
			if (is_array($rs)) {
				foreach ($rs as $key => $value) {
					$tmp[$key] = $value;
				}
			}
			$result['resultList'][] = $tmp;
		}
		$result['result'] = 1;
	}else{
		$result['result'] = 0;
		$result['msg']  = "查询信息错误";
	}

	echo json_encode($result);
}

function getByHeadId($head_id){
	$select = "select * from `request_head` where `id` = ?";
	$mysqlpdo =new MySqlPDO();
	$mysqlpdo->prepare($select);
	$myarray = array($head_id);
	if ($mysqlpdo->executeArr($myarray)) {
		$rs = $mysqlpdo->fetch();
		if (is_array($rs)) {
			foreach ($rs as $key => $value) {
				$result[$key] = $value;
			}
			$result['result']=1;
		}else{
			$result['result']=0;
			$result['msg'] = "该数据不存在";
		}
	}else{
		$result['result']=0;
		$result['msg'] = "查询出现错误";

	}
	echo json_encode($result);
}



function doput($data){

	$update_sql = "update `request_head` set `head` = ?,`name`=? where `id` = ?";
	$mysqlpdo = new MySqlPDO();
	$issuccess = 1;
	for ($i=0; $i < count($data['heads']); $i++) {
		$myarray = array($data['heads'][$i]['head'],
						 $data['heads'][$i]['name'],
						 $data['heads'][$i]['id']);
		$mysqlpdo->prepare($update_sql);
		if ($mysqlpdo->executeArr($myarray)) {

		}else{
			$issuccess = 0;
		}
	}
	$result = array();
	if ($issuccess == 0) {
		$result['result'] = 0;
		$result['msg'] ="更新数据失败";
	}else{
		$result["result"] = 1;
	}
	echo json_encode($result);
}

function dodelete($data){
	if (isset($data['type']) && !empty($data['type'])) {
		switch ($data['type']) {
			case '1':
				deleteByApiId($data);
				break;
			case '2':
				deleteByHeadId($data);
				break;
			default:
				# code...
				break;
		}
	}
}

function deleteByHeadId($data){
	$delete_sql = "delete from `request_head` where `id`= ?";
	$mysqlpdo = new MySqlPDO();
	$myarray  = array($data['head_id']);
	$mysqlpdo->prepare($delete_sql);
	if ($mysqlpdo->executeArr($myarray)) {
		$result['result'] = 1;
	}else{
		$result['result'] =0;
		$resut['msg'] = "插入信息错误";
	}
	echo json_encode($result);
}

function deleteByApiId($data){
	$delete_sql = "delete from `request_head` where `api_id`= ?";
	$mysqlpdo = new MySqlPDO();
	$myarray  = array($data['api_id']);
	$mysqlpdo->prepare($delete_sql);
	if ($mysqlpdo->executeArr($myarray)) {
		$result['result'] = 1;
	}else{
		$result['result'] =0;
		$resut['msg']  = "插入信息错误";
	}
	echo json_encode($result);
}
function dopost($data){
	$data['heads'] = json_decode($data['heads'],true);
	$result = array();

	$delete_sql = "delete from `request_head` where `api_id` =?";

	$mysqlpdo = new MySqlPDO();
	$mysqlpdo->prepare($delete_sql);
	if (empty($data['heads'])) {
		$result['result']= 1;
		echo json_encode($result);
		return ;
	}

	$myarray = array($data['heads'][0]['api_id']);
	if ( $mysqlpdo->executeArr($myarray) ) { //删除之前的数据
	}else{
		$result['result']= 0;
		$result['msg']="信息更新错误";
		echo json_encode($result);
		return ;
	}


	$mysql_insert = "insert into `request_head` (`head`,`name`,`api_id`) values";
	$myarray = array();
	for ($i=0; $i < count($data['heads']); $i++) {
		$myarray[] = $data['heads'][$i]['head'];
		$myarray[] = $data['heads'][$i]['name'];
		$myarray[] = $data['heads'][$i]['api_id'];
		$mysql_insert = $mysql_insert."(?,?,?),";
	}
	$mysql_insert = substr($mysql_insert,0,strlen($mysql_insert)-1);
	$mysqlpdo->prepare($mysql_insert);
	if ($mysqlpdo->executeArr($myarray)) {
		$result['result']=1;
	}else{
		$result['result']=0;
		$result['msg']="插入数据库库错误";
	}
	echo json_encode($result);
}

?>
