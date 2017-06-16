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
		case 'GET':
			doget($data);
			break;
		
		default:
			# code...
			break;
	}
}


function doget($data){
	if (isset($data['docsid']) && !empty($data['docsid'])) {
		$docsid = $data['docsid'];
		$page = $data['page'];
		$pagesize = $data['pagesize'];
		$begin  = ($page-1)*$pagesize;

		$myarray = array($docsid);
		$mysqlpdo = new MySqlPDO();

		$select_num = "select count(*) as num from `comment` where `docsid` = ?";
		$mysqlpdo->prepare($select_num);
		if ($mysqlpdo->executeArr($myarray)) {
			$rs_num = $mysqlpdo->fetch();
			if ($rs_num['num'] >= 0) {
				$result['total'] =$rs_num['num'];
				$select_sql = "select * from `comment` where `docsid` = ? limit $begin,$pagesize";

				$mysqlTemp = new MySqlPDO();

				$mysqlpdo->prepare($select_sql);
				if ($mysqlpdo->executeArr($myarray)) {
					$result['resultList'] = array();
					while($rs = $mysqlpdo->fetch()){
						$temp = array();
						foreach ($rs as $key => $value) {
							if ($key == 'fromuser') {
								$select_name = "select `name` from `user` where `id`=?";
								$myarray_name=array($value);
								$mysqlTemp->prepare($select_name);
								if($mysqlTemp->executeArr($myarray_name)){
									$rs = $mysqlTemp->fetch();
									$temp['name']=$rs['name'];
								}else{
									$result['result']=0;
									$result['msg'] = "查询数据错误";
									echo json_encode($result);
									return;
								}
							}
							$temp[$key]=$value;
						}
						$result['resultList'][] = $temp;
					}
				}
			}
		}
	}else{
		$result['result']=0;
		$result['msg'] = "传输数据错误";
	}
	
	echo json_encode($result);

}

function dopost($data){
	$docsid = $data['docsid'];
	$content = $data['content'];
	$preview = $data['preview'];
	$from = $_SESSION['id'];
	$datetime = date("Y-m-d H:i:s");
	$comment_id = $data['comment_id'];

	if (!isset($comment_id) ||empty($comment_id)) {
		$insert_sql  = "insert into comment (docsid,fromuser,content,preview,time) values(?,?,?,?,?)";
		$myarray = array($docsid,$from,$content,$preview,$datetime);
	}else{
		$insert_sql  = "insert into comment (docsid,fromuser,comment_id,content,preview,time) values(?,?,?,?,?,?)";
		$myarray = array($docsid,$from,$comment_id,$content,$preview,$datetime);
	}

	$mysqlpdo = new MySqlPDO();
	$mysqlpdo->prepare($insert_sql);
	if ($mysqlpdo->executeArr($myarray)) {
		$result['result']= 1;
		$result['id']$mysqlpdo->lastInsertId();
	}else{
		$result['result']= 0;
		$result['msg']="插入数据失败";
	}
	echo json_encode($result);
}


?>