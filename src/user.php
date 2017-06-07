<?php

include $_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/src/MySqlPDO.class.php';
include $_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/src/request.php';

user_operate();

function user_operate(){

	$result = array();

	if(isset($_GET["type"]) || !empty($_GET['type'])){
		if ($_GET["type"]=='0') {
			$datareturn['result'] = 1;
			$username = $_POST['username'];
			$password = $_POST['password'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			$regist_time = date('Y-m-d H:i:s');
			$mypdo=new MySqlPDO();
			$query_sql = "select count(*) as count from user where `username`=?";
			$mypdo->prepare($query_sql);
			$myarr=array(
				$username
			);
			$resultCount=0;
			if($mypdo->executeArr($myarr)){
				$result=$mypdo->fetch();
				$resultCount = $result['count'];
			}
			if ($resultCount>0) {
				$datareturn['result'] = 0;
				$datareturn['msg']='已有此用户名';
			}else{
				$insert_pdo = new MySqlPDO();
				$sql0 = "insert into user (`username`,`password`,`email`,`phone`,`regist_time`) values (?,?,?,?,?)";
				$insert_pdo->prepare($sql0);
				$insertarray = array(
						$username,
						$password,
						$email,
						$phone,
						$regist_time
					);

				if ($insert_pdo->executeArr($insertarray)) {
					$datareturn['result'] = 1;
				}

			}
			$result = $datareturn;

		}else if ($_GET["type"] == '1') {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$mysqlpdo= new MySqlPDO();
			$select_username_count = "select count(*) as countnum from `user` where `username`=?";
			$mysqlpdo->prepare($select_username_count);
			$myarray = array($username);
			$query_username_count= 0;
			if ($mysqlpdo->executeArr($myarray)) {
				$query = $mysqlpdo->fetch();
				$query_username_count = $query['countnum'];
			}


			$select_password_count = "select count(*) as countnum from `user` where `username`=? and `password` =?";
			$mysqlpdo->prepare($select_password_count);
			$myarray = array($username,$password);
			$query_password_count = 0;
			if ($mysqlpdo->executeArr($myarray)) {
				$query = $mysqlpdo->fetch();
				$query_password_count = $query['countnum'];
			}
			if ($query_username_count==1) {
				if ($query_password_count==1) {
					$datareturn['result']=1;
					$datareturn['user'] = array();
					$selectinfo = "select * from `user` where `username`=? and `password` =?";
					$mysqlpdo->prepare($selectinfo);
					$myarray = array($username,$password);
					if ($mysqlpdo->executeArr($myarray)) {
						$result = $mysqlpdo->fetch();
						foreach ($result as $key => $value) {
							$datareturn['user'][$key] = $value;
						}
					}
				}else{
					$datareturn['result']=0;
					$datareturn['msg']="密码错误";
				}
			}else{
				$datareturn['result']=0;
				$datareturn['msg']="用户名错误";
			}
			$result = $datareturn;
		}
	}

	echo json_encode($result);
}


?>