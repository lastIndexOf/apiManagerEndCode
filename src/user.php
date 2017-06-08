<?php


include $_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/src/MySqlPDO.class.php';
include $_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/src/request.php';

user_operate();

function user_operate(){

	$result = array();

	if(isset($_GET["type"]) && !empty($_GET['type']) ) {
		if ($_GET["type"]=='0') {//注册
			$datareturn['result'] = 1;
			$username = $_POST['username'];
			$password = $_POST['password'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			$regist_time = date('Y-m-d H:i:s');
			$mypdo=new MySqlPDO();
			

			$query_username = "select count(*) as num from user where `username`=?";
			$mypdo->prepare($query_username);
			$myarrayusername = array($username);
			if ($mypdo->executeArr($myarrayusername)) {
				$result_username = $mypdo->fetch();
				$result_user_num = $result_username['num'];
				if ($result_user_num==0) {//没有这个用户名
					$query_phone = "select count(*) as num from user where `phone`=?";
					$mypdo->prepare($query_phone);
					$myarrayphone = array($phone);
					if ($mypdo->executeArr($myarrayphone)) {
						$result_phone = $mypdo->fetch();
						$result_phone_num = $result_phone['num'];
						if ($result_phone_num==0) {//这个手机号码没有被注册
							$query_email = "select count(*) as num from `user` where `email` = ?";
							$mypdo->prepare($query_email);
							$myarrayemail= array($email);
							if ($mypdo->executeArr($myarrayemail)) {
								$result_email = $mypdo->fetch();
								$result_email_num = $result_email['num'];
								if ($result_email_num==0) {//这个邮箱没被注册过
									$_insert = "insert into user (`username`,`phone`,`password`,`email`,`regist_time`)values(?,?,?,?,?)";
									$mypdo->prepare($_insert);
									$myarray_insert = array($username,
															$phone,
															$password,
															$email,
															$regist_time
															);
									$mypdo->executeArr($myarray_insert);
									$datareturn['result']=1;
								}else{
									$datareturn['result']=0;
									$datareturn['msg']="邮箱已经被注册";
								}
							}
						}else{
							$datareturn['result']=0;
							$datareturn['msg']="手机已经被注册";
						}
					}

				}else{
					$datareturn['result']=0;
					$datareturn['msg']="用户名已经被注册";
				}
			}

			$result = $datareturn;

		}else if ($_GET["type"] == '1'){//登录
			$username = $_POST['username'];
			$password = $_POST['password'];

			$type = $_POST['type'];
			$datatemp['result'] = 0;
			$mypdo = new MySqlPDO();
			if ($type==0) {//用户名

				$query_user = "select count(*) as num from user where username= ? and password = ?";
				$mypdo->prepare($query_user);
				$myarray = array($username,$password);
				if ($mypdo->executeArr($myarray) ){
					$result_user = $mypdo->fetch();
					$result_user_num = $result_user['num'];
					if ($result_user_num>0) {

						$query = "select * from user where username=? and password=?";
						$mypdo->prepare($query);
						$myarray = array($username,$password);
						if ($mypdo->executeArr($myarray) ){
							$result_u = $mypdo->fetch();
							$datatemp['result'] = 1;
							foreach ($result_u as $key => $value) {
								$datatemp['user'][$key] = $value;
							}
						}
					}else{
						$datatemp['result'] = 0;
						$datatemp['msg'] = "用户名或者密码错误";
					}
				}
				$result = $datatemp;
			}else if ($type==1) {//手机号码
				$query_user = "select count(*) as num from user where phone= ? and password = ?";
				$mypdo->prepare($query_user);
				$myarray = array($username,$password);
				if ($mypdo->executeArr($myarray) ){
					$result_user = $mypdo->fetch();
					$result_user_num = $result_user['num'];
					if ($result_user_num>0) {
						$query = "select * from user where phone=? and password=?";
						$mypdo->prepare($query);
						$myarray = array($username,$password);
						if ($mypdo->executeArr($myarray)) {
							$result_u = $mypdo->fetch();
							$datatemp['result'] = 1;
							foreach ($result_u as $key => $value) {
								$datatemp['user'][$key] = $value;
							}
						}
					}else{
						$datatemp['result'] = 0;
						$datatemp['msg'] = "手机号码或者密码错误";
					}
				}
				$result = $datatemp;
			}else if ($type==2) {//邮箱号码
				$query_user = "select count(*) as num from user where email= ? and password = ?";
				$mypdo->prepare($query_user);
				$myarray = array($username,$password);
				if ($mypdo->executeArr($myarray) ){
					$result_user = $mypdo->fetch();
					$result_user_num = $result_user['num'];
					if ($result_user_num>0) {
						$query = "select * from user where email=? and password=?";
						$mypdo->prepare($query);
						$myarray = array($username,$password);
						if ($mypdo->executeArr($myarray) ){
							$result_u = $mypdo->fetch();
							$datatemp['result'] = 1;
							foreach ($result_u as $key => $value) {
								$datatemp['user'][$key] = $value;
							}
							session_start(); 
							$_SESSION["id"]=$datatemp['user']['id'];
							$_SESSION["username"]=$datatemp['user']['username'];
						}
					}else{
						$datatemp['result'] = 0;
						$datatemp['msg'] = "邮箱或者密码错误";
					}
				}
				$result = $datatemp;
			}

		}else if ($_GET['type']== '2') {
			$update = "update user set username=?,password=?,email=?,phone=? where id = ?";
			$mypdo = new MySqlPDO();
			$mypdo->prepare($update);
			$myarray = array($_POST['username'],
							$_POST['password'],
							$_POST['email'],
							$_POST['phone'],
							$_POST['userid']);
			if ($mypdo->executeArr($myarray)) {
				$datetemp['result']='1';
			}else{
				$datetemp['result']='0';
				$datetemp['msg']='更新失败';
			}

		}else if ($_GET['type']=='3') {
			unset($_SESSION["id"]);
			unset($_SESSION["username"]);
		}
	}else{
		echo "string";
	}

	echo json_encode($result);
}
?>