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
		
		default:
			# code...
			break;
	}

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

		$insert_sql = "insert into group_user (groupid,userid) values ";
		$myarray = array();
		for ($i=0; $i < count($ids); $i++) { 
			$insert_sql = $insert_sql."(?,?),";
			$myarray[] = $lastid;
			$myarray[] = $ids[$i];
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