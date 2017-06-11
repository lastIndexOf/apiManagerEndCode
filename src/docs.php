<?php

include $_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/src/MySqlPDO.class.php';
docs();

function docs(){
	session_start();
	include $_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/src/request.php';

	switch ($request) {
		case 'POST':
			dopost($data);
			break;
		case 'DELETE':
			dodelete($data);
			break;
		case 'GET':
			doget($data);
			break;
		case 'PUT':
			doput($data);
			break;
		
		default:
			# code...
			break;
	}
}
function dodelete($data){
	if (isset($data['type']) ) {
		switch ($data['type']) {
			case '1':
				deleteByGroupid($data);
				break;
			case '2':
				deleteByDocsId($data);
				break;
			default:
				# code...
				break;
		}
	}
}

function deleteByGroupid($data){//docs删除操作时要连同APIs表中的数据一块操作

}


function deleteByDocsId($data){//docs删除操作时要连同APIs表中的数据一块操作

}

function doput($data){
	$result = array();
	$type = $data['type'];
	$docsid = $data['docsid'];
	$title = $data['title'];
	$desc = $data['desc'];

	$mysqlpdo = new MySqlPDO();
	$updata_doscinfo = "update `docs` set `type`=?,`desc`=?,`title`=? where `id` = ?";
	$myarray = array($type,$desc,$title,$docsid);
	$mysqlpdo->prepare($updata_doscinfo);
	if ($mysqlpdo->executeArr($myarray)) {
		$result['result'] = 1;
	}else{
		$result['result'] = 0;
		$result['msg'] = "更新数据失败";
	}

	echo json_encode($result);

}

function doget($data){

	$result = array();
	$pagesize = $data['pagesize'];
	$page = $data['page'];
	$begin = ($page-1)*$pagesize;
	$groupid = $data['groupid'];

	$mysqlpdo = new MySqlPDO();
	$query_num="select count(*) as num from `docs` where `group_id` = ?";
	$mysqlpdo->prepare($query_num);
	$myarray = array($groupid);
	if ($mysqlpdo->executeArr($myarray)) {
		$rs_num = $mysqlpdo->fetch();
		if ($rs_num['num']>0) {
			$result['total'] = $rs_num['num'];
			$result['resultList'] = array();
			$query_resultlist= "select * from `docs` where `group_id`=? limit $begin,$pagesize";
			$mysqlpdo->prepare($query_resultlist);
			$myarray = array($groupid);
			if ($mysqlpdo->executeArr($myarray)) {
				while($rs_resultlist = $mysqlpdo->fetch()){
					$temp =  array();
					foreach ($rs_resultlist as $key => $value) {
						$temp[$key] = $value;
					}
					$result['resultList'][] =$temp;
				}
			}
		}else{
			$result['result'] = 0;
			$result['msg'] = "没有这个组的文档";
		}
	}else{
		$result['result'] = 0;
		$result['msg'] = "查询文档数量错误";	
	}

	echo json_encode($result);
}

function dopost($data){
	$result=array();
	if (   isset($data['type']) 
		&& isset($data['desc']) 
		&& isset($data['title']) 
		&& isset($data['groupid'])) {
		$time_publish = date('Y-m-d H:i:s');
		$mysqlpdo = new MySqlPDO();
		
		$have_groupid = "select count(*) as num from `group` where `id` = ?";
		$myarray = array($data['groupid']);
		$mysqlpdo->prepare($have_groupid);
		if ($mysqlpdo->executeArr($myarray)) {
			$num = $mysqlpdo->fetch();
			if ($num['num']>0) {//说明存在这个groupid
				$insert_sql = "insert into `docs` (`title`,`group_id`,`desc`,`type`,`public_time`) values(?,?,?,?,?)";
				$myarray = array($data['title'],
								$data['groupid'],
								$data['desc'],
								$data['type'],
								$time_publish);
				$mysqlpdo->prepare($insert_sql);
				if ($mysqlpdo->executeArr($myarray)) {
					$lastid = $mysqlpdo->lastInsertId();
					$result['result']=1;
					$result['id']=$lastid;
				}else{
					$result['result'] = 0;
					$result['msg'] ="传输信息错误";
				}

			}else{
				$result['result'] = 0;
				$result['msg'] ="不存在这个组";
			}
		}


		
	}else{
		$result['result'] = 0;
		$result['msg'] ="传输信息不完整";
	}

	echo json_encode($result);

}
