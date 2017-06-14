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
		
		default:
			# code...
			break;
	}
	
}

function dopost($data){
	$userid = $data['userid'];
	$content = $data['content'];
	$title = $data['title'];
	$mtitle = $data['m_title'];
	$preview = $data['preview'];
	$time = date('Y-m-d H:i:s');
	$insert_sql="insert into note (time,content,title,mtitle,userid,preview) values (?,?,?,?,?,?)";
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