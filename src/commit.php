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
	$time = date('Y-m-d H:i:s');

	$insert_sql = "insert into commit (time,content,userid,docsid) values(?,?,?,?)";
	$mysqlpdo = new MySqlPDO();
	$myarray = array($time,$content,$userid,$docsid);
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
	$docsid = $data['docsid'];
	$page = $data['page'];
	$pagesize=$data['pagesize'];
	$begin = ($page-1)*$pagesize;

	$select_num ="select count(*) as num from `commit` where `docsid`=?";
	$mysqlpdo = new MySqlPDO();
	$myarray = array($docsid);
	$mysqlpdo->prepare($select_num);
	if ($mysqlpdo->executeArr($myarray)) {
		$rs_num = $mysqlpdo->fetch();
		$result['total']=$rs_num['num'];
		if ($rs_num['num']>0) {
			$select_list = "select * from `commit` where `docsid`=? limit $begin,$pagesize";
			$mysqlpdo->prepare($select_list);
			if($mysqlpdo->executeArr($myarray)){
				$result['resultList'] = array();
				while($rs = $mysqlpdo->fetch()){
					$temp = array();
					foreach ($rs as $key => $value) {
						if ($key == 'userid') {
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
						$temp[$key] = $value;
					}
					$result['resultList'][]=$temp;
				}
			}
			$result['result']=1;
		}else{
		}
	}else{
		$result['result']=0;
		$result['msg'] = "查询数据数量出现错误";
	}

	echo json_encode($result);
}

?>