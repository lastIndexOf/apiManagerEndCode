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
		$select_num = "select count(*) as num from `api_info` where `api_id` =?";
		$myarray = array($data['api_id']);
		$mysqlpdo->prepare($select_num);
		if ($mysqlpdo->executeArr($myarray)) {
			$num_rs =$mysqlpdo->fetch();
			if ($num_rs['num']>0) {
				$select_list = "select * from `api_info` where `api_id`=?";
				$mysqlpdo->prepare($select_list);
				if ($mysqlpdo->executeArr($myarray)) {
					$result['resultList'] = array();
					while($rs = $mysqlpdo->fetch()){
						$temp = array();
						foreach ($rs as $key => $value) {
							if ($key=='parent' && $value==null) {
								$temp[$key]="";
							}else{
								$temp[$key]=$value;
							}
							
						}
						$result['resultList'][]= $temp;
					}
				}else{
					$result['result']='0';
					$result['msg']="查询错误";
				}
			}else{
				$result['result']=0;
				$result['msg']="您还没有添加参数";
			}
		}

	}else{
		$result['result']=0;
		$result['msg']="数据传输错误";
	}
	echo json_encode($result);
}

function dopost($data){
	global $json_to_array;
	global $rank;

	global $mysqlpdo;
	$mysqlpdo = new MySqlPDO();

	global $issuccess;
	$issuccess = 1;

	$json_to_array = array();
	$rank=0;

	$data['children'] = decode($data['children'],true);

	$delete_sql = "delete from `api_info` where `api_id` =?";
	$myarray_del = array($data['children'][0]['api_id']);
	$mysqlpdo_del = new MySqlPDO();
	$mysqlpdo_del->prepare($delete_sql);
	if ($mysqlpdo_del->executeArr($myarray_del)) {
		
	}else{
		$result['result']=0;
		$result['msg']="更新数据失败";
		echo json_encode($result);
		return ;
	}

	analyze_data($data,0,"");

	global $issuccess;
	if ($issuccess == 1) {
		$result['result']=1;
	}else{
		$result['result']=0;
		$result['msg']="插入数据有错误";
	}
	echo json_encode($result);
}

function analyze_data($data,$myrank,$parent){
	for ($i=0; $i < count($data['children']); $i++) {
		if ( isset($data['children'][$i]['children']) && 
			count($data['children'][$i]['children']) >0 ) {
			$temp =array();
			foreach ($data['children'][$i] as $key => $value) {
				if ($key!='children') {
					$temp[$key] = $value;
				}
			}
			$temp['rank']=$myrank;
			global $json_to_array;
			$json_to_array[]=$temp;

			if ($parent == "") {
				$insert_sql = "insert into `api_info` (`key`,`desc`,`type`,`rank`,`api_id`,`required`) values(?,?,?,?,?,?)";
				$myarray= array($temp['key'],
								$temp['desc'],
								$temp['type'],
								$temp['rank'],
								$temp['api_id'],
								$temp['required']);
			}else{
				$insert_sql = "insert into `api_info` (`key`,`desc`,`type`,`rank`,`api_id`,`required`,`parent`) values(?,?,?,?,?,?,?)";
				$myarray= array($temp['key'],
								$temp['desc'],
								$temp['type'],
								$temp['rank'],
								$temp['api_id'],
								$temp['required'],
								$parent);
			}
			global $mysqlpdo;
			$mysqlpdo->prepare($insert_sql);
			if ($mysqlpdo->executeArr($myarray)) {
				$parenti = $mysqlpdo->lastInsertId();
			}else{
				global $issuccess;
				$issuccess = 0;
				return ;
			}
			analyze_data($data['children'][$i],$myrank+1,$parenti);

		}else{
			$temp =array();
			$temp = $data['children'][$i];
			$temp['rank']= $myrank;
			global $json_to_array;	
			$json_to_array[]=$temp;

			if ($parent == "") {
				$insert_sql = "insert into `api_info` (`key`,`desc`,`type`,`rank`,`api_id`,`required`) values(?,?,?,?,?,?)";
				$myarray= array($temp['key'],
								$temp['desc'],
								$temp['type'],
								$temp['rank'],
								$temp['api_id'],
								$temp['required']);
			}else{
				$insert_sql = "insert into `api_info` (`key`,`desc`,`type`,`rank`,`api_id`,`required`,`parent`) values(?,?,?,?,?,?,?)";
				$myarray= array($temp['key'],
								$temp['desc'],
								$temp['type'],
								$temp['rank'],
								$temp['api_id'],
								$temp['required'],
								$parent);
			}
			global $mysqlpdo;
			$mysqlpdo->prepare($insert_sql);
			if ($mysqlpdo->executeArr($myarray)) {
				$parenti = $mysqlpdo->lastInsertId();
			}else{
				global $issuccess;
				$issuccess = 0;
				return ;
			}
		}
	}



	
}


?>