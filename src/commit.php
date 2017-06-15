<?php
include $_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/src/MySqlPDO.class.php';
commit();
function commit(){
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
function dopost($data){
	$docsid = $data['docsid'];
	$userid = $data['userid'];
	$content = $data['content'];
	$preview = $data['preview'];
	$time = date('Y-m-d H:i:s');

	$insert_sql = "insert into commit (time,content,preview,userid,docsid) values(?,?,?,?,?)";
	$mysqlpdo = new MySqlPDO();
	$myarray = array($time,$content,$preview ,$userid,$docsid);
	$mysqlpdo->prepare($insert_sql);
	if ($mysqlpdo->executeArr($myarray)) {
		$result['result'] = 1;
	}else{
		$result['result'] = 0;
		$result['msg']="数据插入错误";
	}
	echo json_encode($result);
}


function doget($data){
	
}

?>