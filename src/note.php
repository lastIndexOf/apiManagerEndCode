<?php

include $_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/src/MySqlPDO.class.php';
note();

function note(){

	session_start();
	include $_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/src/request.php';
	switch ($request) {
		case 'POST':
			dopost($data);
			break;
		case 'PUT':
			doput($data);
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
	
}

function dodelete($data){
	if (isset( $data['type'] )) {
		switch ($data['type']) {
			case '1':
				deleteById($data);
				break;
			
			default:
				# code...
				break;
		}
	}else{
		$result['result'] = '0';
		$result['msg']="传输数据错误";
	}
	
}

function deleteById($data){
	$id = $data['id'];
	$delete_sql ="delete from `note` where `id` =?";
	$myarray = array($id);
	$mysqlpdo = new MySqlPDO();

	$mysqlpdo->prepare($delete_sql);
	if ($mysqlpdo->executeArr($myarray)) {
		$result['result']=1;
	}else{
		$result['result']=0;
		$result['msg']="删除数错误";
	}
	echo json_encode($result);

}


function doput($data){
	$id = $data['id'];
	$content = $data['content'];
	$title = $data['title'];
	$mtitle = $data['m_title'];
	$preview = $data['preview'];
	$updata_sql ="update note set `content` =?,`title`=?,`m_title`=?,`preview`=? where id=?";

	$myarray = array($content,$title,$mtitle,$preview,$id);

	$mysqlpdo = new MySqlPDO();

	$mysqlpdo->prepare($updata_sql);

	if ($mysqlpdo->executeArr($myarray)) {
		$result['result'] = 1;
	}else{
		$result['result']=0;
		$result['msg'] = "更新数据失败";
	}

	echo json_encode($result);


}

function dopost($data){
	$userid = $data['userid'];
	$content = $data['content'];
	$title = $data['title'];
	$mtitle = $data['m_title'];
	$preview = $data['preview'];
	$time = date('Y-m-d H:i:s');
	$insert_sql="insert into `note` (`time`,`content`,`title`,`mtitle`,`userid`,`preview`) values (?,?,?,?,?,?)";
	$myarray = array($time,$content,$title,$mtitle,$userid,$preview);

	$mysqlpdo = new MySqlPDO();

	$mysqlpdo->prepare($insert_sql);

	if ($mysqlpdo->executeArr($myarray)) {
		$lastid = $mysqlpdo->lastInsertId();
		$result['result'] = 1;
		$result['id'] = $lastid;
	}else{
		$result['result'] = '0';
		$result['msg']="插入数据失败";
	}
	echo json_encode($result);
}


?>