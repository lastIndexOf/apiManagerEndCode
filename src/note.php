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
	if (isset( $data['type'] )) {
		switch ($data['type']) {
			case '1':
				selectById($data);
				break;
			case '2':
				selectByTitle($data);
				break;
			case '3':
				selectBymTitle($data);
				break;
			case '4':
				selectByContent($data);
				break;
			case '5':
				getlist($data);
				break;
			
			default:
				# code...
				break;
		}
	}else{
		$result['result'] = '0';
		$result['msg']="传输数据错误";
		echo json_encode($result);
	}
}
function getlist($data){
	$page = $data['page'];
	$pagesize = $data['pagesize'];
	$begin  = ($page-1)*$pagesize;
	$userid = $_SESSION['id'];
	$select_content = "select count(*) as num from `note` where `userid`=? limit $begin,$pagesize";

	$mysqlpdo = new MySqlPDO();
	$mysqlpdo->prepare($select_content);

	$like_content = "%".$data['content']."%";
	$myarray = array($userid);

	if ($mysqlpdo->executeArr($myarray)) {
		$rs_num = $mysqlpdo->fetch();
		$result['total'] = $rs_num['num'];
		if ($rs_num['num'] >0 ) {
			
			$select_list = "select count(*) as num from `note` where `userid`=? limit $begin,$pagesize";
			$mysqlpdo->prepare($select_list);

			if ($mysqlpdo->executeArr($myarray)) {
				$result['result']=1;
				$result['notes'] = array();
				while( $rs_list = $mysqlpdo->fetch() ){
					$temp = array();
					foreach ($rs_list as $key => $value) {
						$temp[$key]=$value;
					}
					$result['notes'][]=$temp;
				}

			}

		}else{
			$result['result']=1;
			$result['notes'] = array();
		}
	}
	echo json_encode($result);
}


function selectByContent($data){
	$page = $data['page'];
	$pagesize = $data['pagesize'];
	$begin  = ($page-1)*$pagesize;
	$userid = $_SESSION['id'];
	$select_content = "select count(*) as num from `note` where `userid`=? and `content` like ? limit $begin,$pagesize";

	$mysqlpdo = new MySqlPDO();
	$mysqlpdo->prepare($select_content);

	$like_content = "%".$data['content']."%";
	$myarray = array($userid,$like_content);

	if ($mysqlpdo->executeArr($myarray)) {
		$rs_num = $mysqlpdo->fetch();
		if ($rs_num['num'] >0 ) {
			$result['total'] = $rs_num['num'];

			$select_list = "select count(*) as num from `note` where `userid`=? and `content` like ? limit $begin,$pagesize";
			$mysqlpdo->prepare($select_list);

			if ($mysqlpdo->executeArr($myarray)) {
				$result['result']=1;
				$result['notes'] = array();
				while( $rs_list = $mysqlpdo->fetch() ){
					$temp = array();
					foreach ($rs_list as $key => $value) {
						$temp[$key]=$value;
					}
					$result['notes'][]=$temp;
				}

			}

		}else{
			$result['result']=0;
			$result['msg'] ="查找不到与此内容相关的备忘录";
		}
	}
	echo json_encode($result);
}


function selectBymTitle($data){
	$page = $data['page'];
	$pagesize = $data['pagesize'];
	$begin  = ($page-1)*$pagesize;
	$userid = $_SESSION['id'];
	$select_mtotal = "select count(*) as num from `note` where `userid`=? and `mtitle` like ? limit $begin,$pagesize";

	$mysqlpdo = new MySqlPDO();
	$mysqlpdo->prepare($select_mtotal);

	$like_title = "%".$data['m_title']."%";
	$myarray = array($userid,$like_title );

	if ($mysqlpdo->executeArr($myarray)) {
		$rs_num = $mysqlpdo->fetch();
		if ($rs_num['num'] >0 ) {
			$result['total'] = $rs_num['num'];

			$select_list = "select count(*) as num from `note` where `userid`=? and `mtitle` like ? limit $begin,$pagesize";
			$mysqlpdo->prepare($select_list);

			if ($mysqlpdo->executeArr($myarray)) {
				$result['result']=1;
				$result['notes'] = array();
				while( $rs_list = $mysqlpdo->fetch() ){
					$temp = array();
					foreach ($rs_list as $key => $value) {
						$temp[$key]=$value;
					}
					$result['notes'][]=$temp;
				}

			}



		}else{
			$result['result']=0;
			$result['msg'] ="查找不到与此小标题相关的备忘录";
		}
	}

	echo json_encode($result);
}



function selectByTitle($data){
	$page = $data['page'];
	$pagesize = $data['pagesize'];
	$begin  = ($page-1)*$pagesize;
	$userid = $_SESSION['id'];
	$select_total = "select count(*) as num from `note` where `userid`=? and `title` like ? limit $begin,$pagesize";

	$mysqlpdo = new MySqlPDO();
	$mysqlpdo->prepare($select_total);

	$like_title = "%".$data['title']."%";
	$myarray = array($userid,$like_title );
	if ($mysqlpdo->executeArr($myarray)) {
		$rs_num = $mysqlpdo->fetch();
		if ($rs_num['num'] >0 ) {
			$result['total'] = $rs_num['num'];
			$select_list = "select count(*) as num from `note` where `userid`=? and `title` like ? limit $begin,$pagesize";

			$mysqlpdo->prepare($select_list);

			if ($mysqlpdo->executeArr($myarray)) {
				$result['result']=1;
				$result['notes'] = array();
				while( $rs_list = $mysqlpdo->fetch() ){
					$temp = array();
					foreach ($rs_list as $key => $value) {
						$temp[$key]=$value;
					}
					$result['notes'][]=$temp;
				}

			}

		}else{
			$result['result']=0;
			$result['msg'] ="查找不到与此标题相关的备忘录";
		}
	}

	echo json_encode($result);

}




function selectById($data){
	$select_byId = "select * from `note` where id = ?";
	$mysqlpdo = new MySqlPDO();
	$mysqlpdo->prepare($select_byId); 
	$myarray = array();
	if ($mysqlpdo->executeArr($myarray)) {
		$rs = $mysqlpdo->fetch();
		$result['result'] = 1;
		$result['note'] = array();
		foreach ($rs as $key => $value) {
			$result['note'][$key] = $value;
		}
	}else{
		$result['result'] = 0;
		$result['msg']="数据查询错误";
	}
	echo json_encode($result);
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
		echo json_encode($result);
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