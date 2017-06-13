<?php

include $_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/src/MySqlPDO.class.php';

group();
function group(){
	session_start();
	include $_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/src/request.php';
	switch ($request) {
		case 'POST':
			dopost($data);
			break;
		case 'UPDATE':
			doupdate($data);
			break;
		case 'DELETE':
			dodelete($data);
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
	if (isset($data['type']) && !empty($data['type'])) {
		switch ($data['type']) {
			case '1':
				getbyid($data);
				break;
			case '2':
				getbyname($data);
				break;
			
			default:
				# code...
				break;
		}
	};
}

function getbyid($data){
	$groupid = $data['id'];
	$result = array();
	$mypdo = new MySqlPDO();
	$sql = "select count(*) as num from `group` where `id` = ?";
	$mypdo->prepare($sql);
	$myarray = array($groupid);
	if ($mypdo->executeArr($myarray)) {
		$rs = $mypdo->fetch();
		$result_num = $rs['num'];
		if ($result_num >0 ) {
			$mysql = "select * from `group` where `id`=?";
			$mypdo->prepare($mysql);
			$myarray = array($groupid);
			if ($mypdo->executeArr($myarray)) {
				$rs = $mypdo->fetch();
				foreach ($rs as $key => $value) {
					$result['group'][$key] = $value;
				}

			}else{
				$result['result'] = 0;
				$result['msg']='查询错误数据库错误';
			}
		}else{
			$result['result'] = 0;
			$result['msg']='查找不到这个组';
		}
	}
	echo json_encode($result);
}


function getbyname($data){
	$page = $data['page'];
	$pagesize = $data['pagesize'];
	$name = '%'.$data['name'].'%';

	$begin = ($page-1)*$pagesize;

	$result=array();

	$mysqlpdo= new MySqlPDO();
	$sql_count = "select count(*) as num from `group` where `name` like ?";
	
	$mysqlpdo->prepare($sql_count);
	$myarray = array($name);
	if ($mysqlpdo->executeArr($myarray)) {
		$rs_num = $mysqlpdo->fetch();
		$result_num = $rs_num['num'];
		if ($result_num>0) {

			if ($result_num<$pagesize) {
				$pagesize = $result_num; 
			}
			$result['total'] = $result_num;
			$sql_resultlist = "select * from `group` where `name` like ? limit $begin,$pagesize";
			$myarray = array($name);
			$mysqlpdo->prepare($sql_resultlist);
			$result['resultList'] = array();
			if ($mysqlpdo->executeArr($myarray)) {
				
				while($rs_resultlist = $mysqlpdo->fetch()){
					$temp = array();
					foreach ($rs_resultlist as $key => $value) {
						
						$temp[$key] = $value;
					}
					$result['resultList'][] = $temp;
				}

			}
		}else{
			$result['result']=0;
			$result['msg']="没有这个名称的组";
		}

	}
	echo json_encode($result);

}

function dodelete($data){
	$result = array();
	$mypdo= new MySqlPDO();

	$userid = $_SESSION['id'];

	$groupid = $data['groupid'];

	$select_group = "select `headman` from `group` where `id`=?";
	$mypdo->prepare($select_group);
	$myarray = array($groupid);
	if ($mypdo->executeArr($myarray)) {
		$rs_headman = $mypdo->fetch();
		$result_headman = $rs_headman['headman'];
		if ($result_headman == $userid) {
			$delete_user_group = "delete from `group_user` where `groupid`=?";
	 		$mypdo->prepare($delete_user_group);
	 		$myarray = array($groupid);
	 		if ($mypdo->executeArr($myarray)) {
	 			$delete_group = "delete from `group` where `id` = ?";
			 	$mypdo->prepare($delete_group);
			 	$myarray = array($groupid);
			 	if ($mypdo->executeArr($myarray)) {
	 				$result['result'] = 1;
			 	}else{
			 		$result['result']=0;
			 		$result['msg']="删除组失败";
			 	}

	 		}else{
	 			$result['result']=0;
	 			$result['msg']="删除组和用户失败";
	 		}
		}else{
				$result['result']=0;
		 		$result['msg']="您不是组长不能删除组";
		}
	}else{
		$result['result']=0;
		$result['msg']="组的id错误";
	}

	echo json_encode($result);
}

function dopost($data){

	$result = array();
	if (!isset($data['ids']) || !isset($data['name'])) {
		 $result["result"] = '0';
		 $result['msg'] ="数据传输错误";
		echo json_encode($result);
		return;
	}
	$ids = explode("+",$data['ids']);
	$name = $data['name'];
	$mypdo= new MySqlPDO();

	$headman = $_SESSION['id'];
	$insert_group_name="insert into `group` (`name`,`headman`) values (?,?)";

	$mypdo->prepare($insert_group_name);
	$myarray = array($name,$headman);
	if ($mypdo->executeArr($myarray)) {
		$lastid = $mypdo->lastInsertId();
		$result['result']='1';
		$result['id'] = $lastid;
		$time = date('Y-m-d H:i:s');
		$insert_sql = "insert into group_user (groupid,userid,time) values ";
		$myarray = array();
		for ($i=0; $i < count($ids); $i++) { 
			$insert_sql = $insert_sql."(?,?,?),";
			$myarray[] = $lastid;
			$myarray[] = $ids[$i];
			$myarray[] = $time;
		}
		$insert_sql =substr($insert_sql,0,strlen($insert_sql)-1);
		$mypdo->prepare($insert_sql);
		$mypdo->executeArr($myarray);
	}
	echo json_encode($result);
}



function doupdate($data){
	$result = array();

	$groupid = $data['id'];
	$name = $data['name'];
	$mypdo = new MySqlPDO();
	$sql_update = "update `group` set `name` =? where `id` = ?";
	$mypdo->prepare($sql_update);
	$myarray = array($name,$groupid);
	if ($mypdo->executeArr($myarray)) {
		$result['result']=1;
	}else{
		$result['result']=0;
		$result['msg']="更新数据库错误";
	}
	echo json_encode($result);
}

?>