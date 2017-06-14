<?php

include $_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/src/MySqlPDO.class.php';

api_info();

function api_info(){

	session_start();
	include $_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/src/request.php';

	switch ($request) {
		case 'POST':
			dopost($data);
			break;
		case 'GET':
			doget($data);
			break;
		
		default:
			# code...
			break;
	}
	
}
function doget($data){
	if (isset($data['api_id'])) {
		$mysqlpdo = new MySqlPDO();
		$select_list = "select count(*) as num from `api_info` where `api_id` =?";
		$myarray = array($data['api_id']);
		$mysqlpdo->prepare($select_list);
		if ($mysqlpdo->executeArr($myarray)) {
			$num_rs =$mysqlpdo->fetch();
			if ($num_rs['num']>0) {
				# code...
			}else{
				$result['result']=0;
				$result['msg']="您还没有添加参数";
			}
		}

	}else{
		$result['result']=0;
		$result['msg']="数据传输错误";
	}
}

function dopost($data){
	global $json_to_array;
	global $rank;

	$json_to_array = array();
	$rank=0;
	analyze_data($data);

	$mysqlpdo = new MySqlPDO();
	$parent = -1;

	$issuccess = 0;

	

	for ($i=count($json_to_array)-1; $i >=0 ; $i--) { 
		$insert_sql = "insert into `api_info`(`key`,`desc`,`type`,`required`,`rank`,`api_id`,`parent`) values (?,?,?,?,?,?,?)";
		if ($parent == -1) {

			$select_issame = "select count(*) as num from `api_info` where `parent` IS NULL AND `key`=? AND `api_id`=?";
			$issamearray = array($json_to_array[$i]['key'],
								 $json_to_array[$i]['api_id']);
			$mysqlpdo->prepare($select_issame);
			if ($mysqlpdo->executeArr($issamearray)) {
				$rs = $mysqslpdo->fetch();
				if ($rs['num']>0) {
					$result['result'] = 0;
					$result['msg'] = "此参数已经存在";
					echo json_encode($result);
				}
			}
			$myarray= array($json_to_array[$i]['key'],
							$json_to_array[$i]['desc'],
							$json_to_array[$i]['type'],
							$json_to_array[$i]['required'],
							$json_to_array[$i]['rank'],
							$json_to_array[$i]['api_id'],
							null);
		}else{
			$myarray= array($json_to_array[$i]['key'],
							$json_to_array[$i]['desc'],
							$json_to_array[$i]['type'],
							$json_to_array[$i]['required'],
							$json_to_array[$i]['rank'],
							$json_to_array[$i]['api_id'],
							$parent);
		}
		$mysqlpdo->prepare($insert_sql);
		if ( $mysqlpdo->executeArr($myarray) ) {
			$parent = $mysqlpdo->lastInsertId();
		}else{
			$issuccess = 0;
		}
		
	}


	if ($issuccess == 0) {
		$result['result'] = 0;
		$result['msg'] = "数据存储失败";
	}else{
		$result["result"] = 1;
	}

	echo json_encode($result);
}

function analyze_data($data){
	$array_row= array();
	global $rank;
	if ( isset($data['child']) && !empty($data['child']) ) {
		
		foreach ($data as $key => $value) {
			if ($key!='child') {
				$array_row[$key] = $value;
			}
		}
		$array_row['rank'] = $rank;
		$rank++;
		analyze_data($data['child']);
	}else{
		foreach ($data as $key => $value) {
			$array_row[$key] = $value;
		}
		$array_row['rank'] = $rank;
		$rank++;
	}
	global $json_to_array;
	$json_to_array[] = $array_row;
	
}


?>